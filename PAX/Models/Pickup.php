<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pickup extends Model
{
    //
    const STATUS_pending = 0;
    const STATUS_booked = 1;
    const STATUS_assigned = 2;
    const STATUS_collected = 3;
    const STATUS_missed = 4;
    const STATUS_done = 5;
    const STATUS_cancelled = 6;
    const STATUS_rescheduled = 7;

    const TYPE_tnt = 'tnt';
    const TYPE_fedex = 'fedex';
    const TYPE_recurrent = 'recurrent';

    const BILL_FEDEX = 4;
    const BILL_TNT = 5;
    const BILL_DOMESTIC = 6;

    protected $fillable = [
        'courier_id', 'pickup_no', 'pickup_date',
        'ready_time', 'close_time', 'no_packages',
        'expected_weight', 'description', 'address',
        'instructions', 'cash_collect', 'status',
        'contact_name', 'contact_phone', 'company_name',
        'client_id', 'bill_company', 'recurrent',
        'done_comment', 'cancel_comment', 'type'
    ];
    /**
     * recurrent days
     */
    public function days() 
    {
        return $this->hasOne(RecurrentPickup::class);
    }
    public function courier() 
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }
    public function client() 
    {
        return $this->belongsTo(Client::class, 'client_id', 'DCLink');
    }
    public function getBillCompanyNameAttribute() 
    {
        $companyName = '';
        if($this->bill_company == self::BILL_FEDEX) {
            $companyName = 'FEDEX';
        }
        if($this->bill_company == self::BILL_TNT) {
            $companyName = 'TNT';
        }
        if($this->bill_company == self::BILL_DOMESTIC) {
            $companyName = 'Domestic';
        }

        return $companyName;
    }
    
    public function getStatusNameAttribute() 
    {
        $status = '-';
        if($this->status == self::STATUS_pending) {
            $status = 'Not Assigned';
        }
        if($this->status == self::STATUS_assigned) {
            $status = 'Assigned';
        }
        if($this->status == self::STATUS_collected) {
            $status = 'Collected';
        }
        if($this->status == self::STATUS_missed) {
            $status = 'Missed';
        }
        if($this->status == self::STATUS_done) {
            $status = 'Done';
        }
        if($this->status == self::STATUS_cancelled) {
            $status = 'Cancelled';
        }
        if($this->status == self::STATUS_rescheduled) {
            $status = 'Rescheduled';
        }

        return $status;
    }
    public function getTypeNameAttribute() 
    {
        $type = '';
        if($this->type == self::TYPE_fedex) {
            $type = 'FEDEX';
        }
        if($this->type == self::TYPE_tnt) {
            $type = 'TNT';
        }
        
        return $type;
    }
    /**
     * scoping missed records
     */
    public function scopeMissed($builder) 
    {
        $today = Carbon::today()->format('Y-m-d');
        $time = date("H:i");
        
        return $this->where('status', self::STATUS_assigned)
                ->where(function($query) use($today, $time) {
                      $query->whereDate('pickup_date', '<', $today)
                       ->orWhere('close_time', '<' , $time);
                    });
    }
    /**
     * scoping records that are
     *  past 40 mins close time
     */
    public function scopeOver40($builder) 
    {
        $today = Carbon::today()->format('Y-m-d');
        $time = date('h:i', strtotime("+40 minutes", strtotime(date("H:i"))));

        return $this->where('status', self::STATUS_assigned)
                ->where(function($query) use($today, $time) {
                      $query->whereDate('pickup_date', '=', $today)
                       ->orWhere('close_time', '<' , $time);
                    });
    }
    /**
     * scoping records that past
     * are 60 mins close time
     */
    public function scopeOver60($builder) 
    {
        $today = Carbon::today()->format('Y-m-d');
        $time = date('h:i', strtotime("+60 minutes", strtotime(date("H:i"))));

        return $this->where('status', self::STATUS_assigned)
                ->where(function($query) use($today, $time) {
                      $query->whereDate('pickup_date', '=', $today)
                       ->orWhere('close_time', '<' , $time);
                    }); 
    }
    /**
     * scoping TNT
     */
    public function scopeTnt($builder) 
    {
        return $builder->where('type', self::TYPE_tnt);
    }
    /**
     * scoping FEDEX
     */
    public function scopeFedex($builder) 
    {
        return $builder->where('type', self::TYPE_fedex);
    }
}
