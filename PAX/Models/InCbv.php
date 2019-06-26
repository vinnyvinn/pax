<?php

namespace PAX\Models;

class InCbv extends PAXModel
{
    protected $fillable = [
        'manifest_id', 'cbv_date', 'cbv_number', 'cbv_rate', 'consignment_weight', 'handlers', 'invoices'
    ];

    public function manifest()
    {
        return $this->belongsTo(Manifest::class);
    }
}
