<?php
namespace PAX\Processor;
use Carbon\Carbon;
use PAX\Models\RecurrentPickup;
use PAX\Models\Pickup;

class CopyRecurrent {
    protected $daysOfWeek= [
        'sun', 'mon', 'tue', 'wed', 'thur', 'fri', 'sat'
    ];
    public function setTodayPickup() 
    {
        $picks = RecurrentPickup::where($this->daysOfWeek[Carbon::now()->dayOfWeek], true)->select('pickup_id')->get();
        $ids = array_map(function($pick) {
            return $pick['pickup_id'];
        }, $picks->toArray());
        foreach (Pickup::where('recurrent', true)->whereIn('id', $ids)->get() as $pickup) {
            $replicatePick = $pickup->replicate();
            $replicatePick->recurrent = false;
            $replicatePick->status = Pickup::STATUS_booked;
            $replicatePick->save();
        }
    }
}