<?php

namespace PAX\Models;

class DomesticWaybill extends PAXModel
{
    const STATUS_FINAL = 'final';
    const STATUS_RAW = 'raw';

    protected $fillable = [
       'waybill_number', 'client_id', 'total_package', 'weight', 'packaging', 'shipment_description', 'shipment_value',
        'con_phone', 'con_company', 'con_name', 'con_address', 'con_address_alternate', 'con_city', 'con_country',
        'shipper_phone', 'shipper_company', 'shipper_name', 'shipper_address', 'shipper_address_alternate',
        'shipper_city', 'shipper_country', 'status', 'project_id', 'bill_duty', 'bill_to', 'special_handling',
        'internal_billing_reference', 'length', 'width', 'height', 'dim'
    ];

    public function to()
    {
        return $this->belongsTo(DomesticLocation::class, 'con_city');
    }

    public function from()
    {
        return $this->belongsTo(DomesticLocation::class, 'shipper_city');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'DCLink');
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
}
