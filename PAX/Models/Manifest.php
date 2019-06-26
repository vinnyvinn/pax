<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Manifest extends PAXModel
{
    use SoftDeletes;

    const INBOUND = 'Inbound';
    const OUTBOUND = 'Outbound';
    const DOMESTIC = 'Domestic';

    const DUTIABLE = 71;
    const NON_DUTIABLE = 72;
    const RELEASED = 65;
    const SIP = 64;
    const VAN = 63;
    const POD = 62;
    const DEX = 61;
    
    const MANIFEST_air = 'AirFreight';
    const MANIFEST_sea = 'SeaFreight';
    const MANIFEST_courier = 'Courier';

    protected $fillable = [
        'flight_number', 'flight_date', 'arrival_time', 'is_complete',
         'type', 'cbv_id', 'city_id', 'is_open', 'is_tnt', 'manifest_type'
    ];

    protected $dates = ['flight_date'];

    public function scopeInbound($query)
    {
        return $query->where('type', self::INBOUND);
    }

    public function scopeOutbound($query)
    {
        return $query->where('type', self::OUTBOUND);
    }

    public function scopeDomestic($query)
    {
        return $query->where('type', self::DOMESTIC);
    }

    public function waybills()
    {
        return $this->hasMany(Waybill::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function cbvs()
    {
        return $this->hasMany(CBV::class);
    }
}
