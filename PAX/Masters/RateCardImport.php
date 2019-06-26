<?php
namespace PAX\Masters;
use Validator;
use PAX\Models\RateCard;
use PAX\Processor\Excel;

class RateCardImport implements RateCardImportInterface {
    protected $request;
    protected $rows = [];
    protected $errors = [];
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
        if(!Excel::validateExcel($this->request->file('routes'))) {
            $this->errors['file_type'] = 'invalid file, use xls or xslx';
        }

        return $this;
    }
    public function getRows() 
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '1024M');
        $rows = Excel::prepare($this->request->file('routes'))
                ->usingHeaders([
                    'packaging_type', 'weight', 'zone_a', 'zone_b', 'zone_c', 'zone_d',
                     'zone_e', 'zone_f', 'zone_g', 'zone_h', 'zone_i'
                ])->get();
        $this->rows = $rows;
        
        return $this;
    }
    public function import() 
    {
        if(count($this->rows)) {
            foreach ($this->rows as $row) {
                if(@$row['packaging_type'] && @$row['weight'] && @$row['zone_a'] && @$row['zone_b'] && @$row['zone_c']
                     && @$row['zone_d'] && @$row['zone_e'] && @$row['zone_f'] && @$row['zone_g'] && @$row['zone_h']) {

                        $route = Route::updateorCreate(['name' => $row['name'], 'area_code_id' => $areaCode->id]);
                }
            }
        }
        session()->flash('flash_status', 'success');
        session()->flash('flash_message', 'Routes imported successfully');

        return redirect()->route('rate-card.index');
    }
}