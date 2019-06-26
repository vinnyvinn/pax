<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabulation extends Model
{
    use SoftDeletes;
    protected $fillable = ['freight', 'exchange_rate', 'import_duty_rate',
        'vat_rate', 'kebs_amount', 'other_charges'];
    protected $dates = ['deleted_at'];
}
