<?php

namespace PAX\Models;

class Hscode extends PAXModel
{
    protected $fillable = ['code', 'description', 'unit_of_qty', 'rate'];
}
