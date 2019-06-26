<?php

namespace PAX\Models;

class DomesticRate extends PAXModel
{
    protected $fillable = ['from_id', 'to_id', 'amount'];

    public function from()
    {
        return $this->belongsTo(DomesticLocation::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(DomesticLocation::class, 'to_id');
    }

    public static function findRate($locationA, $locationB)
    {
        return self::where(function ($query) use ($locationA, $locationB) {
            return $query->where('from_id', $locationA)->where('to_id', $locationB);
        })
            ->orWhere(function ($query) use ($locationA, $locationB) {
                return $query->where('to_id', $locationA)->where('from_id', $locationB);
            })
            ->first();
    }
}
