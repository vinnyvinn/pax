<?php

namespace PAX\Processor;

use Carbon\Carbon;
use DB;
use PAX\Models\DomesticLocation;
use PAX\Models\NonFedexWaybill;
use PAX\Models\Waybill;
use PAX\Models\Setting;

class Invoicer
{
    public static function createInvoice($attributes, $invoice, $clearance = true, $nonFedex = false)
    {
        return DB::transaction(function () use ($attributes, $invoice, $clearance, $nonFedex) {
            $reference = 'INV-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT);

            $invoiceId = DB::table('InvNum')->insertGetId(self::mapInvoiceFields($attributes, $invoice, $reference, 0, $nonFedex));
            // dd(self::mapInvoiceLineFields($attributes, $invoiceId, $clearance, $invoice, 'inbound', $nonFedex));
            foreach (self::mapInvoiceLineFields($attributes, $invoiceId, $clearance, $invoice, 'inbound', $nonFedex) as $line) {
                DB::table('_btblInvoiceLines')->insert($line);
            }

            return $invoiceId;
        }, 2);
    }

    private static function mapInvoiceFields($attributes, $invoice, $reference, $type = 0, $nonFedex = false)
    {
        $customerAccount = $invoice->client_id ?: config('pax.cash_customer');
        $invoice->load('client');
        $isCashCustomer = $customerAccount == config('pax.cash_customer');
        $transactionDate = Carbon::now()->format('Y-m-d');
        $invoiceAmount = $invoice->client->iCurrencyID == 1 ? $attributes['invoice_total'] : $attributes['invoice_total'] * Setting::where('key', Setting::OUTBOUND_EXCHANGE_RATE)->first()->current_value;
        $invoiceTax = 0;
        $discount = 0;

        if ($nonFedex) {
            $invoice->waybill = $invoice->nonWaybill;
        }

        if (isset($attributes['agency_fees'])) {
            $invoiceTax = floatval($attributes['agency_fees']) > 0 ?
                $attributes['agency_fees'] * 0.16 :
                0;
        }

        return [
            'ProjectID' => intval($invoice->waybill->project_id),
            'iINVNUMAgentID' => 1,
            'DocType' => $type,
            'DocVersion' => 1,
            'DocState' => 1,
            'DocFlag' => 0,
            'OrigDocID' => 0,
            'GrvID' => 0,
            'GrvNumber' => '',
            'InvNumber' => '',
            'OrderNum' => $reference,
            'ExtOrderNum' => $reference,
            'AccountID' => $customerAccount,
            'Description' => 'PAX Invoice',
            'InvDate' => $transactionDate,
            'OrderDate' => $transactionDate,
            'DueDate' => $transactionDate,
            'DeliveryDate' => $transactionDate,
            'TaxInclusive' => 1,
            'Email_Sent' => 1,
            'InvTotExclDEx' => 0,
            'InvTotTaxDEx' => 0,
            'InvTotInclDEx' => $invoiceAmount,
            'InvTotExcl' => $invoiceAmount - $invoiceTax,
            'InvTotTax' => $invoiceTax,
            'InvTotIncl' => $invoiceAmount,
//            'OrdDiscAmnt' => $invoice['totalDiscount'],
            'InvDisc' => $discount,
            'InvDiscAmnt' => 0,
            'OrdDiscAmntEx' => 0,
            'OrdTotExclDEx' => 0,
            'OrdTotTaxDEx' => 0,
            'OrdTotInclDEx' => $invoiceAmount,
            'OrdTotExcl' => 0,
            'OrdTotTax' => 0,
            'OrdTotIncl' => $invoiceAmount,
            'cTaxNumber' => $isCashCustomer ? 0 : null,
            'cAccountName' => $isCashCustomer ? 'Cash Customer' : '',
            'InvTotInclExRounding' => $invoiceAmount,
            'OrdTotInclExRounding' => $invoiceAmount
        ];
    }

    private static function mapInvoiceLineFields($attributes, $invoiceId, $clearance, $invoice, $type = 'inbound', $nonFedex = false)
    {
        if ($type == 'outbound') {
            $lines = self::getOutboundFreight($attributes, $invoice, $nonFedex);
        } elseif ($type == 'domestic') {
            $lines = self::getDomesticFreight($attributes, $invoice);
        } else {
            if ($clearance) {
                $lines = self::getClearance($attributes, $invoice, $nonFedex);
            } else {
                $lines = self::getFreight($attributes, $invoice, $nonFedex);
            }
        }

        $mapped = [];

        $taxRates = DB::table('TaxRate')->get(['idTaxRate', 'TaxRate'])->keyBy('idTaxRate');

        $lineNumber = 0;

        foreach ($lines as $line) {
            $lineNumber++;
            $mapped[] = self::createLineFields($line, $lineNumber, $invoiceId, $taxRates);
        }

        return $mapped;
    }

    private static function getClearance($attributes, $invoice, $nonFedex = false)
    {
        $waybill = $nonFedex ? NonFedexWaybill::with(['city'])->find($invoice->waybill_id) :
            Waybill::with(['city'])->find($invoice->waybill_id);

        config(['pax.IMPORT_DUTY_ACC' => intval($waybill->city->import_duty)]);
        config(['pax.AGENCY_FEE_ACC' => intval($waybill->city->agency_fee)]);

        $accounts = [
            'duty_amount' => 'pax.IMPORT_DUTY_ACC',
            'idf' => 'pax.IDF_ACC',
            'vat_amount' => 'pax.VAT_IMPORT_ACC',
            'rdl' => 'pax.RDL_ACC',
            'gok' => 'pax.GOK_ACC',
            'kaa' => 'pax.KAA_ACC',
            'kebs' => 'pax.KEBS_ACC',
            'agency_fees' => 'pax.AGENCY_FEE_ACC',
        ];

        $lines = [];

        foreach ($accounts as $key => $account) {
            if (isset($attributes[$key])) {
                if (! floatval($attributes[$key])) {
                    continue;
                }

                $line = [
                    'account' => intval(config($account)),
                    'quantity' => 1,
                    'amount' => floatval($attributes[$key]),
                    'tax' => 0,
                    'tax_group' => intval(config('pax.non_tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];

                if ($key == 'agency_fees') {
                    $line['tax'] = ($attributes[$key] * intval($attributes['vat_rate']))/100;
                    $line['amount'] += $line['tax'];
                    $line['tax_group'] = intval(config('pax.tax_group'));
                }

                $lines[] = $line;
            }
        }

        return $lines;
    }

    private static function getFreight($attributes, $invoice, $nonFedex = false)
    {
        $waybill = $nonFedex ?
            NonFedexWaybill::with(['areaCode'])->find($invoice->waybill_id) :
            Waybill::find($invoice->waybill_id);

        config(['pax.FREIGHT_ACC' => intval($waybill->courier->route->areaCode->inbound_freight)]);

        $accounts = [
            'freight' => config('pax.FREIGHT_ACC'),
            'fuel_levy' => config('pax.FUEL_LEVY_ACC'),
            'insurance_rate' => config('pax.INSURANCE_ACC'),
            'cck_levy' => config('pax.CCK_ACC'),
        ];

        $lines = [];

        $freight = 0;

        if (isset($attributes['freight'])) {
            $freight = floatval($attributes['freight']);

            if ($freight) {
                $tax = ($freight * intval($attributes['vat_rate'])) / 100;

                $lines[] = [
                    'account'   => intval($accounts['freight']),
                    'quantity'  => 1,
                    'amount'    => $freight + $tax,
                    'tax'       => $tax,
                    'tax_group' => intval(config('pax.tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        if (! $freight) {
            return [];
        }

        if (isset($attributes['fuel_levy'])) {
            $value = ($freight * floatval($attributes['fuel_levy'])) / 100;
            if ($value) {
                $tax = ($value * intval($attributes['vat_rate'])) / 100;
                $lines[] = [
                    'account'   => intval($accounts['fuel_levy']),
                    'quantity'  => 1,
                    'amount'    => $value + $tax,
                    'tax'       => $tax,
                    'tax_group' => intval(config('pax.tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        if (isset($attributes['insurance_rate'])) {
            $value = ($freight * floatval($attributes['insurance_rate'])) / 100;
            if ($value) {
                $lines[] = [
                    'account'   => intval($accounts['insurance_rate']),
                    'quantity'  => 1,
                    'amount'    => $value,
                    'tax'       => 0,
                    'tax_group' => intval(config('pax.non_tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        if (isset($attributes['cck_levy'])) {
            $value = floatval($attributes['cck_levy']);
            if ($value) {
                $lines[] = [
                    'account'   => intval($accounts['cck_levy']),
                    'quantity'  => 1,
                    'amount'    => $value,
                    'tax'       => 0,
                    'tax_group' => intval(config('pax.non_tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        return $lines;
    }

    private static function createLineFields($line, $lineNumber, $invoiceId, $taxRates)
    {
        $lineTotal = $line['amount'] * $line['quantity'];
        $lineTotalExcl = ($line['amount'] - $line['tax']) * $line['quantity'];

        return [
            'iWarehouseID' => 0,
            'iInvoiceID' => $invoiceId,
            'cDescription' => isset($line['description']) ? $line['description'] : '',
            'iUnitsOfMeasureStockingID' => 0,
            'iUnitsOfMeasureCategoryID' => 0,
            'iUnitsOfMeasureID' => 0,
            'iOrigLineID' => 0,
            'iGrvLineID' => 0,
            'fQtyLastProcess' => 0,
            'fQtyProcessed' => 0,
            'fQtyReserved' => 0,
            'fQtyReservedChange' => 0,
            'cLineNotes' => '',
            'fUnitCost' => 0,
            'fLineDiscount' => 0,
            'fTaxRate' => (float) $taxRates->get($line['tax_group'])->TaxRate,
            'fAddCost' => 0,
            'iJobID' => 0,
            'iPriceListNameID' => 1,
            'fQtyLastProcessLineTotIncl' => 0,
            'fQtyLastProcessLineTotExcl' => 0,
            'fQtyLastProcessLineTotInclNoDisc' => 0,
            'fQtyLastProcessLineTotExclNoDisc' => 0,
            'fQtyLastProcessLineTaxAmount' => 0,
            'fQtyLastProcessLineTaxAmountNoDisc' => 0,
            'fQtyProcessedLineTotIncl' => 0,
            'fQtyProcessedLineTotExcl' => 0,
            'fQtyProcessedLineTotInclNoDisc' => 0,
            'fQtyProcessedLineTotExclNoDisc' => 0,
            'fQtyProcessedLineTaxAmount' => 0,
            'fQtyProcessedLineTaxAmountNoDisc' => 0,
            'fUnitPriceExclForeign' => 0,
            'fUnitPriceInclForeign' => 0,
            'fAddCostForeign' => 0,
            'fQuantityLineTotInclForeign' => 0,
            'fQuantityLineTotExclForeign' => 0,
            'fQuantityLineTotInclNoDiscForeign' => 0,
            'fQuantityLineTotExclNoDiscForeign' => 0,
            'fQuantityLineTaxAmountForeign' => 0,
            'fQuantityLineTaxAmountNoDiscForeign' => 0,
            'fQtyChangeLineTotInclForeign' => 0,
            'fQtyChangeLineTotExclForeign' => 0,
            'fQtyChangeLineTotInclNoDiscForeign' => 0,
            'fQtyChangeLineTotExclNoDiscForeign' => 0,
            'fQtyChangeLineTaxAmountForeign' => 0,
            'fQtyChangeLineTaxAmountNoDiscForeign' => 0,
            'fQtyToProcessLineTotInclForeign' => 0,
            'fQtyToProcessLineTotExclForeign' => 0,
            'fQtyToProcessLineTotInclNoDiscForeign' => 0,
            'fQtyToProcessLineTotExclNoDiscForeign' => 0,
            'fQtyToProcessLineTaxAmountForeign' => 0,
            'fQtyToProcessLineTaxAmountNoDiscForeign' => 0,
            'fQtyLastProcessLineTotInclForeign' => 0,
            'fQtyLastProcessLineTotExclForeign' => 0,
            'fQtyLastProcessLineTotInclNoDiscForeign' => 0,
            'fQtyLastProcessLineTotExclNoDiscForeign' => 0,
            'fQtyLastProcessLineTaxAmountForeign' => 0,
            'fQtyLastProcessLineTaxAmountNoDiscForeign' => 0,
            'fQtyProcessedLineTotInclForeign' => 0,
            'fQtyProcessedLineTotExclForeign' => 0,
            'fQtyProcessedLineTotInclNoDiscForeign' => 0,
            'fQtyProcessedLineTotExclNoDiscForeign' => 0,
            'fQtyProcessedLineTaxAmountForeign' => 0,
            'fQtyProcessedLineTaxAmountNoDiscForeign' => 0,
            'iLineRepID' => 0,
            'iLineProjectID' => 0,
            'iLotID' => 0,
            'cLotNumber' => '',
            'iMFPID' => 0,
            'iLineID' => $lineNumber,
            'iDeliveryMethodID' => 0,
            'iDeliveryStatus' => 0,
            'fPromotionPriceExcl' => 0,
            'fPromotionPriceIncl' => 0,
            'cPromotionCode' => '',
            'fQuantityUR' => $line['quantity'],
            'fQtyChangeUR' => $line['quantity'],
            'fQtyToProcessUR' => $line['quantity'],
            'fQtyLastProcessUR' => 0,
            'fQtyProcessedUR' => 0,
            'fQtyReservedUR' => 0,
            'fQtyReservedChangeUR' => 0,
            'iSalesWhseID' => 0,
            '_btblInvoiceLines_iBranchID' => 0,
            'fQuantity' => $line['quantity'],
            'fQtyChange' => $line['quantity'],
            'fQtyToProcess' => $line['quantity'],
            'fUnitPriceExcl' => $line['amount'] - $line['tax'],
            'fUnitPriceIncl' => $line['amount'],
            'iModule' => 1,
            'iLedgerAccountId' => $line['account'],
            'iStockCodeID' => 0,
            'iTaxTypeID' => $line['tax_group'],
            'fQuantityLineTotIncl' => $lineTotal,
            'fQuantityLineTotExcl' => $lineTotalExcl,
            'fQuantityLineTotInclNoDisc' => $lineTotal,
            'fQuantityLineTotExclNoDisc' => $lineTotalExcl,
            'fQuantityLineTaxAmount' => $line['tax'],
            'fQuantityLineTaxAmountNoDisc' => $line['tax'],
            'fQtyChangeLineTotIncl' => $lineTotal,
            'fQtyChangeLineTotExcl' => $lineTotalExcl,
            'fQtyChangeLineTotInclNoDisc' => $lineTotal,
            'fQtyChangeLineTotExclNoDisc' => $lineTotalExcl,
            'fQtyChangeLineTaxAmount' =>  0,
            'fQtyChangeLineTaxAmountNoDisc' => 0,
            'fQtyToProcessLineTotIncl' =>  $lineTotal,
            'fQtyToProcessLineTotExcl' => $lineTotalExcl,
            'fQtyToProcessLineTotInclNoDisc' => $lineTotal,
            'fQtyToProcessLineTotExclNoDisc' => $lineTotalExcl,
            'fQtyToProcessLineTaxAmount' => 0,
            'fQtyToProcessLineTaxAmountNoDisc' => 0
        ];
    }

    public static function createAgentInvoice($attributes, $invoice)
    {
        return DB::transaction(function () use ($attributes, $invoice) {
            $waybill = Waybill::with(['city'])->find($invoice->waybill_id);
            config(['pax.BREAK_BULK_ACC' => intval($waybill->city->break_bulk)]);
            config(['pax.STORAGE_ACC' => intval($waybill->city->storage_fee)]);

            $reference = 'INV-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT);

            $invoiceId = DB::table('InvNum')->insertGetId(self::mapInvoiceFields($attributes, $invoice, $reference));

            $lines = [];

            $lines[] = [
                'account'   => intval(config('pax.BREAK_BULK_ACC')),
                'quantity'  => 1,
                'amount'    => floatval($attributes['break_bulk_fee']),
                'tax'       => 0,
                'tax_group' => intval(config('pax.non_tax_group')),
                'description' => $invoice->waybill->waybill_number . ' By ' . $attributes['clearing_agent_name']
            ];

            if (floatval($attributes['storage_fee']) > 0) {
                $lines[] = [
                    'account'   => intval(config('pax.STORAGE_ACC')),
                    'quantity'  => 1,
                    'amount'    => floatval($attributes['storage_fee']),
                    'tax'       => 0,
                    'tax_group' => intval(config('pax.non_tax_group')),
                    'description' => $invoice->waybill->waybill_number . ' By ' . $attributes['clearing_agent_name']
                ];
            }

            $lineNumber = 0;

            $taxRates = DB::table('TaxRate')->get(['idTaxRate', 'TaxRate'])->keyBy('idTaxRate');

            foreach ($lines as $line) {
                $lineNumber++;
                DB::table('_btblInvoiceLines')
                    ->insert(self::createLineFields($line, $lineNumber, $invoiceId, $taxRates));
            }

            return $invoiceId;
        }, 2);
    }

    public static function createOutboundInvoice($attributes, $invoice, $something, $nonFedex)
    {
        return DB::transaction(function () use ($attributes, $invoice, $nonFedex) {
            $reference = 'INV-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT);

            $invoiceId = DB::table('InvNum')->insertGetId(self::mapInvoiceFields($attributes, $invoice, $reference, 0, $nonFedex));
            
            foreach (self::mapInvoiceLineFields($attributes, $invoiceId, false, $invoice, 'outbound', $nonFedex) as $line) {
                DB::table('_btblInvoiceLines')->insert($line);
            }

            return $invoiceId;
        }, 2);
    }

    private static function getOutboundFreight($attributes, $invoice, $nonFedex = false)
    {
        $waybill = $nonFedex ? NonFedexWaybill::with(['city'])->find($invoice->waybill_id) :
            Waybill::with(['city'])->find($invoice->waybill_id);

        // config(['pax.FREIGHT_ACC' => intval($waybill->city->outbound_freight)]);

        $accounts = [
            'transport' => config('pax.FREIGHT_ACC_OUTBOUND', 0),
            'fuel_levy' => config('pax.FUEL_LEVY_ACC_OUTBOUND', 0),
            'insurance' => config('pax.INSURANCE_ACC_OUTBOUND', 0),
            'cck_levy' => config('pax.CCK_ACC_OUTBOUND', 0),
            'vat_amount' => config('pax.VAT_OUTBOUND', 0)
        ];

        $lines = [];

        $freight = 0;
        $invoice = $invoice->load('client');

        if (isset($attributes['transport'])) {

            $freight =  $invoice->client->iCurrencyID == 1 ? floatval($attributes['transport']) : floatval($attributes['transport']) * Setting::where('key', Setting::OUTBOUND_EXCHANGE_RATE)->first()->current_value;
            if (isset($attributes['discount'])) {

                $freight -= (floatval($attributes['discount']) * $freight) / 100;
            }
            if ($freight) {
                $tax = ($freight * intval($attributes['vat_rate'])) / 100;
                $lines[] = [
                    'account'   => intval($accounts['transport']),
                    'quantity'  => 1,
                    'amount'    => $freight + $tax,
                    'tax'       => $tax,
                    'tax_group' => intval(config('pax.tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        if (! $freight) {
            return [];
        }

        if (isset($attributes['fuel_levy']) && $waybill->bill_to != 'R') {
            $value = ($freight * floatval($attributes['fuel_levy'])) / 100;
            if ($value) {
                $tax = ($value * intval($attributes['vat_rate'])) / 100;
                $lines[] = [
                    'account'   => intval($accounts['fuel_levy']),
                    'quantity'  => 1,
                    'amount'    => $value + $tax,
                    'tax'       => $tax,
                    'tax_group' => intval(config('pax.tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        if (isset($attributes['insurance']) && $waybill->bill_to != 'R') {
            $value = $attributes['insurance'];
            if ($value) {
                $tax = ($value * intval($attributes['vat_rate'])) / 100;
                $lines[] = [
                    'account'   => intval($accounts['insurance']),
                    'quantity'  => 1,
                    'amount'    => $value + $tax,
                    'tax'       => $tax,
                    'tax_group' => intval(config('pax.non_tax_group')),
                    'description' => $invoice->waybill->waybill_number
                ];
            }
        }

        return $lines;
    }

    public static function createDomesticInvoice($attributes, $invoice)
    {
        return DB::transaction(function () use ($attributes, $invoice) {
            $reference = 'INV-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT);

            $invoiceId = DB::table('InvNum')->insertGetId(self::mapInvoiceFields($attributes, $invoice, $reference));

            foreach (self::mapInvoiceLineFields($attributes, $invoiceId, false, $invoice, 'domestic') as $line) {
                DB::table('_btblInvoiceLines')->insert($line);
            }

            return $invoiceId;
        }, 2);
    }

    private static function getDomesticFreight($attributes, $invoice)
    {
        $location = DomesticLocation::find($invoice->waybill->shipper_city);
        config(['pax.FREIGHT_ACC' => intval($location->freight_account)]);

        $lines = [];

        $freight = 0;

        if (isset($attributes['freight'])) {
            $freight = floatval($attributes['freight']);
            if (isset($attributes['discount'])) {
                $freight -= (floatval($attributes['discount']) * $freight) / 100;
            }
            if ($freight) {
                $tax = ($freight * intval($attributes['vat_rate'])) / 100;
                $lines[] = [
                    'account'   => intval(config('pax.FREIGHT_ACC', 0)),
                    'quantity'  => 1,
                    'amount'    => $freight + $tax,
                    'tax'       => $tax,
                    'tax_group' => intval(config('pax.tax_group')),
                    'description' => str_pad($invoice->waybill_id, 12, '0', STR_PAD_LEFT)
                ];
            }
        }

        if (! $freight) {
            return [];
        }

        return $lines;
    }
}
