<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalCharge extends Model
{
    //
    protected $fillable = [
         "client_id", "waybill_id", "invoice_data", 'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'DCLink');
    }
    public function waybill()
    {
        return $this->belongsTo(Waybill::class);
    }
    public function getInvoiceDataAttribute($value)
    {
        return json_decode($value);
    }
    public function scopeNotInvoiced($builder)
    {
        return $builder->where('status', false);
    }
    public function scopeInvoiced($builder)
    {
        return $builder->where('status', true);
    }
}
