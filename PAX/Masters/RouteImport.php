<?php
namespace PAX\Masters;
use PAX\Processor\Excel;
use PAX\Models\AreaCode;
use PAX\Models\Route;
use Validator;
class RouteImport implements RouteInterface {
    protected $errors = [];
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
        if(!Excel::validateExcel($this->request->file('routes'))) {
            $this->errors['file_type'] = 'invalid file, use xls or xslx';
        }

        return $this;
    }
    public function getRows() 
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '1024M');
        $rows = Excel::prepare($this->request->file('routes'))->usingHeaders(['name', 'area_code'])->get();
        $this->rows = $rows;
        
        return $this;
    }
    public function import() 
    {
        if(count($this->rows)) {
            foreach ($this->rows as $row) {
              if(@$row['name'] && @$row['area_code'] && $areaCode = AreaCode::where('code', (string) $row['area_code'])->first()) { 
                 $route = Route::updateorCreate(['name' => $row['name'], 'area_code_id' => $areaCode->id]);
              }
            }
        }
        session()->flash('flash_status', 'success');
        session()->flash('flash_message', 'Routes imported successfully');

        return redirect()->route('route.index');
    }
}