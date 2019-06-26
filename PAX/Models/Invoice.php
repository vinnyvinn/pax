<?php

namespace PAX\Models;

use Carbon\Carbon;
use PAX\Processor\Invoicer;

class Invoice extends PAXModel
{
    const PROFORMA = 'Proforma';
    const PROFORMA_FREIGHT = 'Proforma Freight';
    const ACTUAL = 'Actual';
    const ACTUAL_FREIGHT = 'Freight Invoice';
    const PROFORMA_DOMESTIC = 'Domestic Proforma';
    const ACTUAL_DOMESTIC = 'Actual Proforma';
    const QUOTE_DOMESTIC = 'Domestic Quote';

    const CATEGORY_INBOUND = 'Inbound';
    const CATEGORY_OUTBOUND = 'Outbound';
    const CATEGORY_AGENT_CLEARANCE = 'Agent Clearance';
    const CATEGORY_DOMESTIC = 'Domestic';
    const CATEGORY_NON_INBOUND = 'Non-Fedex Inbound';
    const CATEGORY_NON_OUTBOUND = 'Non-Fedex Outbound';

    protected $fillable = [
        'waybill_id', 'client_id', 'proforma_data', 'invoice_data', 'fob', 'conversion_rate', 'local_amount',
        'freight', 'other_charges', 'insurance_rate', 'insurance', 'excise_duty', 'cif', 'duty_rate', 'duty_amount', 'vat_rate',
        'vat_amount', 'idf', 'rdl', 'kaa', 'kebs', 'gok', 'agency_fees', 'proforma_total', 'invoice_total',
        'variance', 'type', 'category', 'break_bulk_fee', 'storage_fee', 'storage_time', 'invoice_id',
        'external_invoice', 'outbound_other_charges', 'client_email', 'email_cc'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'DCLink');
    }
    
    public function getEmailCcAttribute($value)
    {
        return !$value ? [] : explode(",", $value);
    }

    public function waybill()
    {
        return $this->belongsTo(Waybill::class, 'waybill_id');
    }

    public function nonWaybill()
    {
        return $this->belongsTo(NonFedexWaybill::class, 'waybill_id');
    }

    public function domesticWaybill()
    {
        return $this->belongsTo(DomesticWaybill::class, 'waybill_id');
    }

    public function scopeDomesticProforma($query)
    {
        return $query->where('type', self::PROFORMA_DOMESTIC);
    }

    public function scopeDomesticQuote($query)
    {
        return $query->where('type', self::QUOTE_DOMESTIC);
    }

    public function scopeDomesticActual($query)
    {
        return $query->where('type', self::ACTUAL_DOMESTIC);
    }

    public function scopeDomestic($query)
    {
        return $query->where('category', self::CATEGORY_DOMESTIC);
    }

    public function scopeInbound($query)
    {
        return $query->where('category', self::CATEGORY_INBOUND);
    }

    public function scopeAgent($query)
    {
        return $query->where('category', self::CATEGORY_AGENT_CLEARANCE);
    }

    public function scopeOutbound($query)
    {
        return $query->where('category', self::CATEGORY_OUTBOUND);
    }

    public function scopeProforma($query)
    {
        return $query->where('type', self::PROFORMA);
    }

    public function scopeActual($query)
    {
        return $query->where('type', self::ACTUAL);
    }

    public function scopeFreightProforma($query)
    {
        return $query->where('type', self::PROFORMA_FREIGHT);
    }

    public function scopeFreightActual($query)
    {
        return $query->where('type', self::ACTUAL_FREIGHT);
    }

    public function scopeFreight($query)
    {
        return $query->where('type', self::ACTUAL_FREIGHT)->orWhere('type', self::PROFORMA_FREIGHT);
    }
    public function getOutboundOtherChargesAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }

    public static function createProforma($attributes = [])
    {
        $attributes = self::mapInboundClearanceInvoice($attributes);

        return parent::create($attributes);
    }

    public function updateProforma($attributes = [])
    {
        $attributes = self::mapInboundClearanceInvoice($attributes);

        if ($attributes['finalize'] == 'true') {
            $nonFedex = $this->category == self::CATEGORY_NON_INBOUND || $this->category == self::CATEGORY_NON_INBOUND;
            $attributes['type'] = self::ACTUAL;
            $attributes['variance'] = $attributes['invoice_total'] - $this->proforma_total;
            $attributes['invoice_id'] = Invoicer::createInvoice($attributes, $this, true, $nonFedex);
            $this->waybill->update(['clearance_billed' => true]);
        }

        unset($this->waybill);

        return $this->update($attributes);
    }

    public static function mapInboundClearanceInvoice($attributes)
    {
        unset($attributes['_token'], $attributes['_method']);
        
        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['local_amount'] = $attributes['fob'] * $attributes['conversion_rate'];
        $attributes['insurance'] = $attributes['local_amount'] * ($attributes['insurance_rate'] / 100);
        $attributes['cif'] = $attributes['freight'] + $attributes['other_charges'] + $attributes['insurance'] +
            $attributes['local_amount'];
        $attributes['duty_amount'] = ($attributes['duty_rate']/100) * $attributes['cif'];
        $attributes['vat_amount'] = ($attributes['vat_rate']/100) * ($attributes['cif'] + $attributes['duty_amount']);

        $agentVat = ($attributes['vat_rate']/100) * $attributes['agency_fees'];

        $attributes['proforma_total'] = $attributes['idf'] + $attributes['rdl'] + $attributes['kaa'] +
            $attributes['kebs'] + $attributes['gok'] + $agentVat + $attributes['agency_fees'] +
            $attributes['duty_amount'] + $attributes['vat_amount'];

        if ($attributes['finalize'] == 'true') {
            $attributes['invoice_data'] = json_encode($attributes);
            $attributes['invoice_total'] = $attributes['proforma_total'];
            unset($attributes['proforma_data']);
            unset($attributes['proforma_total']);
        }

        return $attributes;
    }

    public static function createOutboundProforma($attributes = [])
    {
        $attributes = self::prepareOutboundFreightFields($attributes);

        return parent::create($attributes);
    }

    public static function createFreightProforma($attributes = [])
    {
        $attributes = self::prepareFreightFields($attributes);
        $attributes['type'] = self::PROFORMA_FREIGHT;

        return parent::create($attributes);
    }

    public static function prepareFreightFields($attributes = [], $setCategory = true)
    {
        unset($attributes['_token'], $attributes['_method']);
        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['insurance'] = $attributes['freight'] * ($attributes['insurance_rate'] / 100);
        $levy = ($attributes['fuel_levy']/100) * $attributes['freight'];
        $afterLevy = $attributes['freight'] + $levy;
        $vat = ($attributes['vat_rate']/100) * $afterLevy;
        $attributes['vat_amount'] = $vat;
        $attributes['proforma_total'] = $attributes['insurance'] + $vat + $afterLevy + $attributes['cck_levy'];

        if ($attributes['finalize'] == 'true') {
            $attributes['invoice_data'] = json_encode($attributes);
            $attributes['invoice_total'] = $attributes['proforma_total'];
            unset($attributes['proforma_data']);
            unset($attributes['proforma_total']);
        }

        return $attributes;
    }

    public static function prepareOutboundFreightFields($attributes = [], $setCategory = true)
    {
        unset($attributes['_token'], $attributes['_method']);
        if ($setCategory) {
            $attributes['category'] = self::CATEGORY_OUTBOUND;
        }
        $attributes['type'] = self::PROFORMA_FREIGHT;
        $attributes['proforma_data'] = json_encode($attributes);

        $attributes['insurance'] = isset($attributes['waybill']) && $attributes['waybill']['bill_to'] == 'R' ?  0 : @$attributes['declared_value'] * @($attributes['insurance_rate'] / 100);
        $discount = ($attributes['discount']/100) * $attributes['transport'];
        $discounted = $attributes['transport'] - $discount;
        $levy = isset($attributes['waybill']) && $attributes['waybill']['bill_to'] == 'R' ?  0 : ($attributes['fuel_levy']/100) * $discounted;

        $attributes['vat_amount'] = isset($attributes['waybill']) && $attributes['waybill']['bill_to'] == 'R' ?  0 : ($attributes['vat_rate']/100) * ($discounted + $levy + $attributes['insurance']);

        $otherCharges = array_sum(array_map(function($charge){ return $charge->value; }, json_decode($attributes['outbound_other_charges'])));

        $attributes['proforma_total'] = $discounted + $attributes['insurance'] + $levy + $attributes['vat_amount'] + $otherCharges;

        if ($attributes['finalize'] == 'true') {
            $attributes['type'] = self::ACTUAL_FREIGHT;
            $attributes['invoice_data'] = json_encode($attributes);
            $attributes['invoice_total'] = $attributes['proforma_total'];
            unset($attributes['proforma_data']);
            unset($attributes['proforma_total']);
        }

        return $attributes;
    }

    public function updateFreightProforma($attributes = [], $setCategory = true)
    {
        $attributes = self::prepareFreightFields($attributes, $setCategory);
        $attributes['type'] = self::PROFORMA_FREIGHT;
        if ($attributes['finalize'] == 'true') {
            $nonFedex = $this->category == self::CATEGORY_NON_INBOUND || $this->category == self::CATEGORY_NON_INBOUND;
            $attributes['type'] = self::ACTUAL_FREIGHT;
            $attributes['variance'] = $attributes['invoice_total'] - $this->proforma_total;
            $attributes['invoice_id'] = Invoicer::createInvoice($attributes, $this, false, $nonFedex);
            $this->waybill->update(['freight_billed' => true]);
        }

        unset($this->waybill);

        return $this->update($attributes);
    }

    public function updateOutboundFreightProforma($attributes = [], $setCategory = true)
    {
        $attributes = self::prepareOutboundFreightFields($attributes, $setCategory);
        $attributes['type'] = self::PROFORMA_FREIGHT;

        if ($attributes['finalize'] == 'true') {
            $nonFedex = $this->category == self::CATEGORY_NON_OUTBOUND;

            $attributes['type'] = self::ACTUAL_FREIGHT;
            $attributes['variance'] = $attributes['invoice_total'] - $this->proforma_total;
            $attributes['invoice_id'] = Invoicer::createOutboundInvoice($attributes, $this, false, $nonFedex);
            $this->waybill->update(['freight_billed' => true]);
        }

        unset($this->waybill);

        return $this->update($attributes);
    }

    public static function createAgentClearance($attributes = [])
    {
        $attributes = self::prepareAgentFields($attributes);

        Waybill::where('id', $attributes['waybill_id'])->update([
            'clearing_agent_name' => $attributes['clearing_agent_name']
        ]);

        return self::create($attributes);
    }

    public function updateAgentClearance($attributes = [])
    {
        $attributes = self::prepareAgentFields($attributes);

        if ($attributes['finalize'] == 'true') {
            $attributes['type'] = self::ACTUAL;
            $attributes['variance'] = $attributes['invoice_total'] - $this->proforma_total;
            $attributes['invoice_id'] = Invoicer::createAgentInvoice($attributes, $this);
            $this->waybill->update(['clearance_billed' => true]);
        }

        Waybill::where('id', $attributes['waybill_id'])->update([
            'clearing_agent_name' => $attributes['clearing_agent_name']
        ]);

        unset($this->waybill);

        return $this->update($attributes);
    }

    private static function prepareAgentFields($attributes)
    {
        unset($attributes['_token'], $attributes['_method']);
        $waybill = Waybill::findOrFail($attributes['waybill_id']);

        $arrival = Carbon::parse($waybill->initial_billing_time);

        $attributes['storage_fee'] = 0;

        if ($arrival->diffInHours(Carbon::now()) > 48) {
            $attributes['storage_time'] = Carbon::parse($waybill->manifest->flight_date)->diffInMinutes(Carbon::now());
            $attributes['storage_fee'] = (0.15 * $attributes['storage_time'] * $waybill->weightInKgs()) / 60;
        }

        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['proforma_total'] = $attributes['storage_fee'] + $attributes['break_bulk_fee'];
        $attributes['type'] = self::PROFORMA;
        $attributes['category'] = self::CATEGORY_AGENT_CLEARANCE;

        if ($attributes['finalize'] == 'true') {
            $attributes['invoice_data'] = json_encode($attributes);
            $attributes['invoice_total'] = $attributes['proforma_total'];
            unset($attributes['proforma_data']);
            unset($attributes['proforma_total']);
        }

        return $attributes;
    }

    public static function createDomestic(DomesticWaybill $waybill)
    {
        $rate = DomesticRate::findRate($waybill->con_city, $waybill->shipper_city);
        $weight = (double) $waybill->weight > (double) $waybill->dim ?
            (double) $waybill->weight : (double) $waybill->dim;
        $attributes = [];
        $attributes['waybill_id'] = $waybill->id;
        $attributes['client_id'] = $waybill->client_id;
        $attributes['freight'] = $rate->amount * $weight;
        $attributes['discount'] = 0;
        $attributes['vat_rate'] = 16;
        $attributes['vat_amount'] = (16 * $attributes['freight'])/100;
        $attributes['total'] = $attributes['freight'] + $attributes['vat_amount'];

        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['proforma_total'] = $attributes['total'];

        $attributes['type'] = self::PROFORMA_DOMESTIC;
        $attributes['category'] = self::CATEGORY_DOMESTIC;

        return self::create($attributes);
    }

    public function updateDomesticProforma($attributes = [])
    {
        unset($attributes['_token'], $attributes['_method']);
        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['vat_amount'] = ($attributes['vat_rate'] * $attributes['freight'])/100;
        $attributes['proforma_total'] = $attributes['freight'] + $attributes['vat_amount'];

        if ($attributes['finalize'] == 'true') {
            $attributes['type'] = self::ACTUAL_DOMESTIC;
            $attributes['invoice_data'] = json_encode($attributes);
            $attributes['invoice_total'] = $attributes['proforma_total'];
            $this->waybill = $this->domesticWaybill;
            $attributes['invoice_id'] = Invoicer::createDomesticInvoice($attributes, $this);
            unset($attributes['proforma_data']);
            unset($attributes['proforma_total']);
        }

        unset($this->waybill);

        return $this->update($attributes);
    }

    public static function createDomesticQuote($attributes = [])
    {
        unset($attributes['_token'], $attributes['_method']);
        $rate = DomesticRate::findRate($attributes['from'], $attributes['to']);
        $attributes['waybill_id'] = 0;
        $attributes['client_id'] = 1;
        $attributes['freight'] = $rate->amount * $attributes['weight'];
        $attributes['withDiscount'] = $attributes['freight'];
        $attributes['freight'] = $attributes['freight'] - $attributes['discount'];

        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['vat_amount'] = ($attributes['vat_rate'] * $attributes['freight'])/100;
        $attributes['proforma_total'] = $attributes['freight'] + $attributes['vat_amount'];

        $attributes['type'] = self::PROFORMA_DOMESTIC;
        $attributes['category'] = self::QUOTE_DOMESTIC;

        return self::create($attributes);
    }

    public function scopeNonInbound($builder)
    {
        return $builder->where('category', self::CATEGORY_NON_INBOUND);
    }

    public function scopeNonOutbound($builder)
    {
        return $builder->where('category', self::CATEGORY_NON_OUTBOUND);
    }

    public function quote()
    {
        return $this->hasOne(Quote::class);
    }
}
