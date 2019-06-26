<?php

namespace PAX\Processor;

use PAX\Processor\Excel;
use PAX\Models\Pickup;
use Carbon\Carbon;

class PickupProcessor {
    public static function process($request) 
    {
        if(!Excel::validateExcel($request->file('pickups'))) {
            session('flash_status', 'error');
            session('flash_message', 'Invalid excel file!');
            return redirect()->back();
        }
        $rows = [];
        if($request->type) {
            $rows = self::mapRows(self::import($request->file('pickups')), $request->type);
        }

        if(count($rows)) {
            Pickup::insert($rows);
        }
        session('flash_status', 'success');
        session('flash_message', 'Pickups imported successfully.');

        return redirect()->route('pickups.index'); 
    }
    public static function import($file) 
    {
        $fields = ['pickup_no', 'pickup_date', 'ready_time', 'close_time', 'no_packages',
        'expected_weight', 'description', 'address', 'instructions', 'cash_collect',
        'contact_name', 'contact_phone', 'company_name', 'bill_company'];

        return Excel::prepare($file)->usingHeaders($fields)->get();
    }
    public static function mapRows($rows, $type) 
    {
        $cleanedRows = [];
        foreach ($rows as $row) {
            foreach ($row as $index => $column) {
                if ($column == '-') {
                    $row[$index] = null;
                }
            }
            if(!$row) {
                continue;
            }
            $row['pickup_no'] = $row['pickup_no'] ?: self::pickupNo();
            $row['bill_company'] = self::billCompany($row['bill_company']);

            if(!$row['pickup_no'] && !$row['pickup_date'] && !$row['ready_time'] && !$row['close_time'] ||
                !$row['no_packages'] && !$row['contact_phone'] && !$row['contact_name'] && !$row['company_name']
                 && !$row['bill_company']) {
                continue;
            }
            if(Pickup::where('pickup_no', $row['pickup_no'])->first()) {
               continue;
            }
            $cleanedRows[] = $row;
        }
        return array_map(function($row) use($type) {
            $row['created_at'] = Carbon::now();
            $row['pickup_date'] = Carbon::parse($row['pickup_date']);
            if($type == Pickup::TYPE_recurrent) {
                $row['recurrent'] = true;
            }
            if($type == Pickup::TYPE_tnt || $type == Pickup::TYPE_fedex) {
                $row['type'] = $type;
            }
            return $row;
        }, $cleanedRows);
    }
    private static function pickupNo() 
    {
       return str_pad(mt_rand(0, 1000000000), 9, '0', STR_PAD_LEFT);
    }
    private static function billCompany($value) 
    {
        $companyName = 3;
        if($value == 'FEDEX') {
            $companyName = Pickup::BILL_FEDEX;
        }
        if($value == 'TNT') {
            $companyName = Pickup::BILL_TNT;
        }
        if($value == 'Domestic') {
            $companyName = Pickup::BILL_DOMESTIC;
        }

        return $companyName;
    }
}
