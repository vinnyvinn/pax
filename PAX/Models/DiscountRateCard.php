<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountRateCard extends Model
{
    //
    protected $fillable = [
        'client_id', 'effective_from', 'effective_to', 'status'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class,'client_id', 'DCLink');
    }

    public function rates()
    {
        return $this->hasMany(DiscountRateCardItem::class);
    }
}
