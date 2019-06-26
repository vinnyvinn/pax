<?php

namespace PAX\Models;

class Quote extends PAXModel
{
    const CATEGORY_INBOUND = 'Inbound';
    const CATEGORY_OUTBOUND = 'Outbound';
    const CATEGORY_DOMESTIC = 'Domestic';

    protected $fillable = [
        'client_id', 'proforma_data', 'invoice_data', 'fob', 'conversion_rate', 'local_amount',
        'freight', 'other_charges', 'insurance_rate', 'insurance', 'cif', 'duty_rate', 'duty_amount', 'vat_rate',
        'vat_amount', 'idf', 'rdl', 'kaa', 'kebs', 'gok', 'agency_fees', 'proforma_total', 'invoice_total',
        'variance', 'type', 'category', 'break_bulk_fee', 'storage_fee', 'storage_time', 'invoice_id',
        'origin', 'destination', 'export_city',
        'con_phone', 'con_company', 'con_name', 'con_address', 'con_address_alternate', 'con_city', 'con_state',
        'con_country', 'con_postal', 'shipper_phone', 'shipper_company', 'shipper_name', 'shipper_address',
        'shipper_address_alternate', 'shipper_city', 'shipper_state', 'shipper_country', 'shipper_postal',
        'total', 'weight', 'currency', 'value', 'description',
        'status', 'conversion_rate', 'usd_value', 'current_status', 'clearing_agent', 'actual_weight', 'package_type',
        'clearing_agent_assigned', 'category', 'clearance_billed', 'freight_billed', 'type', 'clearing_agent_name',
        'project_id', 'city_id', 'initial_billing_time', 'area_code_id', 'route_id', 'courier_id', 'overage',
        'waybill_id'
    ];

    public function waybill()
    {
        return $this->belongsTo(NonFedexWaybill::class, 'waybill_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'DCLink');
    }

    public function scopeInbound($query)
    {
        return $query->where('category', self::CATEGORY_INBOUND);
    }

    public function scopeOutbound($query)
    {
        return $query->where('category', self::CATEGORY_OUTBOUND);
    }

    public static function prepareFreightFields($attributes = [])
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

    public static function prepareOutboundFreightFields($attributes = [])
    {
        unset($attributes['_token'], $attributes['_method']);
        $attributes['category'] = self::CATEGORY_OUTBOUND;
        $attributes['proforma_data'] = json_encode($attributes);
        $attributes['insurance'] = $attributes['declared_value'] * ($attributes['insurance_rate'] / 100);
        $discount = ($attributes['discount']/100) * $attributes['transport'];
        $discounted = $attributes['transport'] - $discount;
        $levy = ($attributes['fuel_levy']/100) * $discounted;

        $attributes['vat_amount'] = ($attributes['vat_rate']/100) * ($discounted + $levy + $attributes['insurance']);

        $attributes['proforma_total'] = $discounted + $attributes['insurance'] + $levy + $attributes['vat_amount'];

        if ($attributes['finalize'] == 'true') {
            $attributes['type'] = self::ACTUAL_FREIGHT;
            $attributes['invoice_data'] = json_encode($attributes);
            $attributes['invoice_total'] = $attributes['proforma_total'];
            unset($attributes['proforma_data']);
            unset($attributes['proforma_total']);
        }

        return $attributes;
    }

    public function package()
    {
        switch ($this->package_type) {
            default:
            case 1:
            case 3:
            case 4:
            case 5:
                return 'FEDEX OTHER';
            case 2:
                return 'FEDEX PAK';
            case 6:
                return 'FEDEX ENVELOPE';
        }
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
