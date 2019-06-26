<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Waybill extends PAXModel
{
    // use SoftDeletes;

    const CA_PAX = 'PAX';
    const CA_OTHER = '3rd Party';

    const CATEGORY_INBOUND = 'Inbound';
    const CATEGORY_OUTBOUND = 'Outbound';

    const DUTIABLE = 71;
    const NON_DUTIABLE = 72;
    const RELEASED = 65;
    const SIP = 64;
    const VAN = 63;
    const POD = 62;
    const DEX = 61;
    
    protected $fillable = [
        'manifest_id', 'shipped_date', 'waybill_number', 'crn_number', 'origin', 'destination', 'export_city',
        'con_phone', 'con_company', 'con_name', 'con_address', 'con_address_alternate', 'con_city', 'con_state',
        'con_country', 'con_postal', 'shipper_phone', 'shipper_company', 'shipper_name', 'shipper_address',
        'shipper_address_alternate', 'shipper_city', 'shipper_state', 'shipper_country', 'shipper_postal',
        'bill_to', 'bill_duty', 'total', 'weight', 'currency', 'value', 'description', 'created_at', 'updated_at',
        'status', 'conversion_rate', 'usd_value', 'current_status', 'clearing_agent', 'actual_weight', 'package_type',
        'clearing_agent_assigned', 'category', 'clearance_billed', 'freight_billed', 'type', 'clearing_agent_name',
        'project_id', 'city_id', 'initial_billing_time', 'area_code_id', 'route_id', 'courier_id', 'overage',
        'broker_name', 'broker_phone', 'broker_city', 'broker_country', 'broker_customs_id', 'waiting_reason', 'oda',
        'width', 'height', 'length', 'pod_date', 'pod_time', 'pod_name', 'pod_set', 'dims', 'fedex_client_account',
    ];

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function scopeBilled($query)
    {
        return $query->where('clearance_billed', true);
    }

    public function scopeUnbilled($query)
    {
        return $query->where('clearance_billed', false)->where('freight_billed', false);
    }

    public function scopeInbound($query)
    {
        return $query->where('category', self::CATEGORY_INBOUND);
    }

    public function scopeOutbound($query)
    {
        return $query->where('category', self::CATEGORY_OUTBOUND);
    }

    public function manifest()
    {
        return $this->belongsTo(Manifest::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public static function getKGs($amount)
    {
        if (substr($amount, strlen($amount) - 1) == 'L') {
            
            return doubleval($amount) * 0.453592;
        }

        return doubleval($amount);
    }

    public function weightInKgs()
    {
        return self::getKGs($this->weight);
    }

    public function getStatusAttribute($status)
    {
        return $this->getStatusString($status);
    }

    public function getCurrentStatusAttribute($status)
    {
        return $this->getStatusString($status);
    }

    private function getStatusString($status)
    {
        if ($status == 71) {
            return 'Undergoing Clearance';
        }

        if ($status == 72) {
            return 'Non-Dutiable';
        }

        if ($status == 65) {
            return 'Released';
        }

        if ($status == 64) {
            return 'SIP';
        }

        if ($status == 63) {
            return 'Van Scan';
        }

        if ($status == 62) {
            return 'POD';
        }

        if ($status == 61) {
            return 'DEX';
        }

        return 'Awaiting Recovery';
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function areaCode()
    {
        return $this->belongsTo(AreaCode::class, 'area_code_id');
    }
    public function getDimsAttribute($value)
    {
        return !$value ? [] : json_decode($value);
    }

}
