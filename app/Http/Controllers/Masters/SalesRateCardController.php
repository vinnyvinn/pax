<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use PAX\Models\SalesRateCard;
use PAX\Models\SalesRateCardItem;
use Illuminate\Support\Facades\DB;

class SalesRateCardController extends Controller
{
    //
    public function index()
    {
        return view('masters.sales-rate-card.index', [
            'data' => SalesRateCard::latest()->get()
        ]);
    }
    public function create()
    {
        return view('masters.sales-rate-card.create');
    }
    public function store(Request $request)
    {

        DB::transaction(function() use($request) {
            $salesRateCard = SalesRateCard::create($request->all());

            $this->importRates($salesRateCard->id, $request);
        });

        flash('Sales rate card imported successfully');

        return redirect()->route('sales-rate-card.index');
    }
    public function show($id)
    {
        $data = SalesRateCard::with(['rates'])->findOrFail($id);

        return view('masters.sales-rate-card.show', ['data' => $data]);
    }
    public function edit($id)
    {
        $data = SalesRateCard::with(['rates'])->findOrFail($id);

        return view('masters.sales-rate-card.edit', ['data' => $data]);
    }
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request, $id) {
            $rateCard = SalesRateCard::with(['rates'])->findOrFail($id);
            $data = $request->all();
            $data['status'] = !$request->status ? false : true;
            $rateCard->update($data);

            if($request->hasFile('rates')) {
                $rateCard->rates()->delete();

                $this->importRates($rateCard->id, $request);
            }

        });

        flash('Sales rate card imported successfully');

        return redirect()->route('sales-rate-card.index');
    }
    public function destroy($id)
    {
        $data = SalesRateCard::with(['rates'])->findOrFail($id);

        $data->delete();

        flash('Sales rate card deleted successfully');

        return redirect()->route('sales-rate-card.index');
    }
    public function activeRateCard()
    {
        $data = SalesRateCard::with(['rates'])->where('status', true)->latest()->first();

        return response()->json($data);
    }
    private function importRates($id, $request)
    {
        if($request->hasFile('rates')) {
            ini_set('max_execution_time', 3600);
            ini_set('memory_limit', '1024M');

           $data = Excel::selectSheetsByIndex(0)->load($request->file('rates'))->get([
                'package_type', 'weight','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i','j', 'k',
                'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z'
            ])->toArray();

            $fData = array_filter($data, function($item) {
                if(!isset($item['package_type']) || !isset($item['weight'])) {

                    return false;
                }

                return true;
            });

            foreach ($fData as $item) {
                $item['sales_rate_card_id']  = $id;
                SalesRateCardItem::create($item);
            }

            return true;
        }

        return false;
    }
}
