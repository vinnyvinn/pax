<?php
namespace PAX\Masters;

use Excel;
use Validator;
use Carbon\Carbon;
use PAX\Models\GDRRateCard;
use DB;

class GDRRateCardImport {
    protected $request;
    protected $rows = [];

    public function parse($request) 
    {
        $this->request = $request;

        return $this;
    }
    public function validate() 
    {
        $validator = Validator::make($this->request->all(), [
            'routes' => 'required|file',
        ]);
        if($validator->fails()) {
            $this->errors = $validator->errors();
        }

        return $this;
    }
    public function import() 
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '1024M');

        Excel::selectSheetsByIndex(0)->load($this->request->rates, function($reader) {
            $results = $reader->get()->toArray();

            $sanResults = [];

            foreach ($results as  $row) {
                if($row['tariff_code'] == NULL || $row['package_code']  == NULL || $row['package'] == NULL || !$row['start_city'] || !$row['start_country']
                || $row['end_weight'] ==NULL) {
                    continue;
                }

                $row['tarriff_code'] = $row['tariff_code'];

                $sanResults[] = $row;
            }

            foreach ($sanResults as $row) {
                GDRRateCard::create($row);
            }
        });

        session()->flash('flash_status', 'info');
        session()->flash('flash_message', 'Rates imported successfully');
    }
}