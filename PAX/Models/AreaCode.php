<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class AreaCode extends PAXModel
{
    use SoftDeletes;

    protected $fillable = ['name', 'code', 'inbound_freight'];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
