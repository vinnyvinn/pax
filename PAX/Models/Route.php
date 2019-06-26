<?php

namespace PAX\Models;

class Route extends PAXModel
{
    protected $fillable = ['name', 'area_code_id'];

    public function areaCode()
    {
        return $this->belongsTo(AreaCode::class);
    }
}
