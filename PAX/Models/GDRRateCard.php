<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;

class GDRRateCard extends Model
{
    //
    protected $fillable = [
        'effective_from', 'effective_to', 'status'
    ];

    public function rates()
    {
        return $this->hasMany(GDRRate::class);
    }
}
