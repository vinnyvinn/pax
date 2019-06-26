<?php
namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;

class RecurrentPickup extends Model
{
    //
    protected $fillable = ['pickup_id', 'sun', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat'];
}
