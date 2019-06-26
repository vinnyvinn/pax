<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use PAX\Models\DiscountRateCard;
use PAX\Models\DiscountRateCardItem;
use App\Http\Controllers\Controller;
use PAX\Models\Client;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DiscountRateCardController extends Controller
{
    //
    public function index()
    {
        if(request()->input('ajax')) {

            return response()->json(DiscountRateCard::with(['rates'])->where('status', true)->latest()->get());
        }
        return view('masters.discounted-rates.index', [
            'data' => DiscountRateCard::with(['client'])->latest()->get()
        ]);
    }
    public function create()
    {
        return view('masters.discounted-rates.create', [
            'clients' => Client::select('Name', 'Account', 'DCLink')->get()
        ]);
    }
    public function store(Request $request)
    {
        DB::transaction(function() use($request) {
            $salesRateCard = DiscountRateCard::create($request->all());

            $this->importRates($salesRateCard->id, $request);
        });

        flash('Discounted sales rate card imported successfully');

        return redirect()->route('discount-rate-card.index');
    }
    public function edit($id)
    {
        $data = DiscountRateCard::findOrFail($id);

        return view('masters.discounted-rates.edit', [
            'data' => $data,
            'clients' => Client::select('Name', 'Account', 'DCLink')->get()
        ]);
    }
    public function show($id)
    {
        $data = DiscountRateCard::with(['rates', 'client'])->findOrFail($id);

        return view('masters.discounted-rates.show', [
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request, $id) {
            $rateCard = DiscountRateCard::with(['rates'])->findOrFail($id);
            $data = $request->all();
            $data['status'] = $request->status ? true : false;
            $rateCard->update($data);

            if($request->hasFile('rates')) {

                $rateCard->rates()->delete();

                $this->importRates($rateCard->id, $request);
            }

        });

        flash('Discounted sales rate card updated successfully');

        return redirect()->route('discount-rate-card.index');
    }
    public function destroy($id)
    {
        $data = DiscountRateCard::findOrFail($id);

        $data->delete();

        flash('Discounted sales rate card deleted successfully');

        return redirect()->route('discount-rate-card.index');
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
                $item['discount_rate_card_id']  = $id;
                DiscountRateCardItem::create($item);
            }

            return true;
        }

        return false;
    }
}
