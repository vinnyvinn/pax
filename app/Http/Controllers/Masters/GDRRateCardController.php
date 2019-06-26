<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use PAX\Models\GDRRateCard;
use PAX\Masters\GDRRateCardImport;
use Illuminate\Support\Facades\DB;
use PAX\Models\GDRRate;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GDRRateCardController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        $data = GDRRateCard::latest()->get();

        if(request()->input('ajax')) {
            
            return response()->json($data);
        }

        return view('masters.gdr.index', [
            'data' => $data,
        ]);
    }
    public function activeGdr()
    {
        $data = GDRRateCard::with(['rates'])->where('status', true)->latest()->first();

        return response()->json($data);
    }
    public function create()
    {
        return view('masters.gdr.create');
    }
    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        DB::transaction(function() use($request) {

            $rateCard = GDRRateCard::create($request->all());

            $this->importRates($rateCard->id, $request);
        });

        session()->flash('flash_status', 'info');
        session()->flash('flash_message', 'Rates imported successfully');

        return redirect()->route('gdr.index');
    }
    public function edit($id)
    {
        $data = GDRRateCard::findOrFail($id);

        return view('masters.gdr.edit', ['data' => $data]);
    }
    public function show($id)
    {
        $data = GDRRateCard::with(['rates'])->findOrFail($id);

        return view('masters.gdr.show', ['data' => $data]);
    }
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request, $id) {
            $rateCard = GDRRateCard::with(['rates'])->findOrFail($id);
            $data = $request->all();
            $data['status'] = $request->status ? true : false;
            $rateCard->update($data);

            if($request->hasFile('rates')) {
                $rateCard->rates()->delete();

                $this->importRates($rateCard->id, $request);
            }

        });

        session()->flash('flash_status', 'info');
        session()->flash('flash_message', 'Rates imported successfully');

        return redirect()->route('gdr.index');
    }
    public function destroy($id)
    {
        $data = GDRRateCard::with(['rates'])->findOrFail($id);

        $data->delete();

        session()->flash('flash_status', 'info');
        session()->flash('flash_message', 'Rates deleted successfully');

        return redirect()->route('gdr.index');
    }
    private function importRates($id, $request)
    {
        if($request->hasFile('rates')) {
            ini_set('max_execution_time', 3600);
            ini_set('memory_limit', '1024M');

           $data = Excel::selectSheetsByIndex(0)->load($request->file('rates'))->get([
            'package_type', 'kgs', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z'
            ])->toArray();

            $fData = array_filter($data, function($item) {

                if(!isset($item['package_type']) || !isset($item['kgs'])) {

                    return false;
                }

                return true;
            });

            foreach ($fData as $item) {
                $item['g_d_r_rate_card_id']  = $id;
                $item['weight'] = $item['kgs'];
                GDRRate::create($item);
            }

            return true;
        }

        return false;
    }
}
