<?php

namespace PAX\Processor;

use Illuminate\Http\Request;
use Excel;
use PAX\Models\Pickup;
use Carbon\Carbon;

class PickupReport {
    protected $request;

    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    public function generate() 
    {
        $data = new Pickup;
        
        if($this->request->date_from && $this->request->date_to) {
            
            $dates = [
                Carbon::parse($this->request->date_from)->format('Y-m-d'),
                Carbon::parse($this->request->date_to)->addDays(1)->format('Y-m-d')
            ];
            $data = $data->whereBetween('created_at', $dates);
        }

        if($this->request->type && $this->request->type == Pickup::TYPE_tnt) {
            $data = $data->where('type', Pickup::TYPE_tnt);
        }

        if($this->request->type && $this->request->type == Pickup::TYPE_fedex) {
            $data = $data->where('type', Pickup::TYPE_fedex);
        }

        if($this->request->type && $this->request->type == Pickup::TYPE_recurrent) {
            $data = $data->where('recurrent', true);
        }

        if($this->request->status && $this->request->status) {
            
            $data = $data->where('status', (int) $this->request->status);
        }
        
        $data = $data->get();
        
        return Excel::create('Pick_report'.time(), function($excel) use($data) {

            $excel->sheet('New sheet', function($sheet) use($data) {
        
                $sheet->loadView('dispatch.reports.pickups', ['data' => $data]);
        
            });
        })->download('xls');
    }
}