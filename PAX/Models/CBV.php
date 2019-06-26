<?php

namespace PAX\Models;

class CBV extends PAXModel
{
    protected $table = 'cbvs';

    protected $fillable = ['number', 'rate', 'date_issued', 'used', 'used_on', 'handling_rate'];

    public function scopeUnused($query)
    {
        return $query->where('used', false);
    }

    public function manifests()
    {
        return $this->hasMany(Manifest::class, 'cbv_id');
    }

    public function waybills()
    {
        return $this->hasManyThrough(Waybill::class, Manifest::class, 'cbv_id');
    }
}
