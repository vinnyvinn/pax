<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PAX\Models\AdditionalCharge;
use PAX\Models\Waybill;
use PAX\Models\Client;
use Carbon\Carbon;
use PAX\Models\Setting;

class AdditionalChargeController extends Controller
{
    //
    public function index()
    {
        return view('additional-charge.index', ['data' => AdditionalCharge::notInvoiced()->latest()->get()]);
    }
    public function invoices()
    {
        return view('additional-charge.invoices', ['data' => AdditionalCharge::invoiced()->latest()->get()]);
    }
    public function create()
    {
        if(request()->input('ajax')) {

            return response()->json([
                'waybills' => Waybill::outbound()->latest()->get(),
                'id' => null,
                'clients' => Client::select('Account', 'DCLink', 'Name')->get(),
            ]);
        }

        return view('additional-charge.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $data['invoice_data'] = json_encode($request->invoice_data);

        AdditionalCharge::create($data);

        return response()->json(['message' => 'Record saved successfully']);
    }
    public function show($id)
    {
        $data = AdditionalCharge::with(['waybill', 'client'])->findOrFail($id);

        return view('additional-charge.show', ['invoice' => $data]);
    }
    public function edit($id)
    {
        $data = AdditionalCharge::findOrFail($id);
        if(request()->input('ajax')) {
            
            return response()->json([
                'waybills' => Waybill::outbound()->latest()->get(),
                'invoice' => $data,
                'id' => $id,
                'clients' => Client::select('Account', 'DCLink', 'Name')->get(),
            ]);
        }

        return view('additional-charge.edit', ['id' => $id]);
    }
    public function update(Request $request, $id)
    {
        $invoice = AdditionalCharge::with(['waybill', 'client'])->findOrFail($id);

        $data = $request->all();

        $data['invoice_data'] = json_encode($request->invoice_data);

        $invoice->update($data);

        if($request->status) {
            $amount = is_array($invoice->invoice_data) ? array_sum(array_map(function($charge)
                { return $charge->value; }, $invoice->invoice_data)) : 0;

            $amount = $invoice->client->iCurrencyID == 1 ? $amount : $amount * Setting::where('key', Setting::OUTBOUND_EXCHANGE_RATE)->first()->current_value;

            $reference = 'INV-AC-' . str_pad($invoice->id, 5, '0', STR_PAD_LEFT);

            $invoiceId = \DB::table('InvNum')->insertGetId(self::mapInvoiceFields($invoice, $reference));

            \DB::table('_btblInvoiceLines')->insert(self::createLineFields($amount, $invoiceId));
        }

        return response()->json(['message' => 'Record updated successfully']);
    }

    private static function mapInvoiceFields($invoice, $reference, $type = 0)
    {

        $customerAccount = $invoice->client_id ?: config('pax.cash_customer');

        $isCashCustomer = $customerAccount == config('pax.cash_customer');

        $transactionDate = Carbon::now()->format('Y-m-d');

        $invoiceAmount = is_array($invoice->invoice_data) ? array_sum(array_map(function($charge)
                { return $charge->value; }, $invoice->invoice_data)) : 0;

        $invoiceAmount = $invoice->client->iCurrencyID == 1 ? $invoiceAmount : $invoiceAmount * Setting::where('key', Setting::OUTBOUND_EXCHANGE_RATE)->first()->current_value;

        $invoiceTax = 0;
        $discount = 0;

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
    private static function createLineFields($amount, $invoiceId)
    {
        $taxRates = \DB::table('TaxRate')->get(['idTaxRate', 'TaxRate'])->keyBy('idTaxRate');
        $taxGroup = config('pax.tax_group');
        $vat = Setting::where('key', 'VAT')->first()->current_value;
        $lineTotal = $amount;
        $tax = ($vat/100)*$amount;
        $lineTotalExcl = ($amount - $tax) * 1;

        return [
            'iWarehouseID' => 0,
            'iInvoiceID' => $invoiceId,
            'cDescription' => '',
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
            'fTaxRate' => (float) $taxRates->get($taxGroup)->TaxRate,
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
            'iLineID' => 1,
            'iDeliveryMethodID' => 0,
            'iDeliveryStatus' => 0,
            'fPromotionPriceExcl' => 0,
            'fPromotionPriceIncl' => 0,
            'cPromotionCode' => '',
            'fQuantityUR' => 1,
            'fQtyChangeUR' => 1,
            'fQtyToProcessUR' => 1,
            'fQtyLastProcessUR' => 0,
            'fQtyProcessedUR' => 0,
            'fQtyReservedUR' => 0,
            'fQtyReservedChangeUR' => 0,
            'iSalesWhseID' => 0,
            '_btblInvoiceLines_iBranchID' => 0,
            'fQuantity' => 1,
            'fQtyChange' => 1,
            'fQtyToProcess' => 1,
            'fUnitPriceExcl' => $amount,
            'fUnitPriceIncl' => $amount,
            'iModule' => 1,
            'iLedgerAccountId' => config('pax.ADDITIONAL_CHARGES_ACC'),
            'iStockCodeID' => 0,
            'iTaxTypeID' => $taxGroup,
            'fQuantityLineTotIncl' => $lineTotal,
            'fQuantityLineTotExcl' => $lineTotalExcl,
            'fQuantityLineTotInclNoDisc' => $lineTotal,
            'fQuantityLineTotExclNoDisc' => $lineTotalExcl,
            'fQuantityLineTaxAmount' => $tax,
            'fQuantityLineTaxAmountNoDisc' => $tax,
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
}
