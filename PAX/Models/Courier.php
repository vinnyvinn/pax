<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends PAXModel
{
    use SoftDeletes;

    protected $fillable = ['name', 'national_id', 'fedex_id', 'deleted_at', 'phone', 'route_id'];
    protected $dates = ['deleted_at'];
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
