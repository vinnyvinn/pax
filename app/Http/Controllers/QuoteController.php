<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PAX\Models\Client;
use PAX\Models\Quote;
use PAX\Models\RateCard;
use PAX\Models\RateCardZone;
use PAX\Models\Setting;
use Response;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::withCount(['invoice', 'waybill'])
            ->with(['client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            }])
            ->when(\request('type') == 1, function ($builder) {
                return $builder->inbound()
                    ->with(['waybill' => function ($builder) {
                        return $builder->select([
                            'id', 'type', 'current_status', 'clearance_billed', 'freight_billed', 'status'
                        ]);
                    }]);
            })
            ->when(\request('type') == 2, function ($builder) {
                return $builder->outbound();
            })
            ->get();

        return view('quotes.index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', $quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function create()
    {
        if (request('fill')) {
            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'clients' => Client::all('DCLink', 'Name', 'Account'),
                'currencies' => currencies(),
                'countries' => countries(),
            ]);
        }

        if (request('fill-out')) {
            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'clients' => Client::all('DCLink', 'Name', 'Account'),
                'currencies' => currencies(),
                'countries' => countries(),
                'rates' => RateCard::all(),
                'zones' => RateCardZone::all()
            ]);
        }

        if (\request('type') == 2) {
            return view('quotes.create-outbound');
        }

        return view('quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (! isset($data['category'])) {
            $data['category'] = Quote::CATEGORY_INBOUND;
        }

        $fields = $data['category'] == Quote::CATEGORY_INBOUND ?
            Quote::prepareFreightFields($data) :
            Quote::prepareOutboundFreightFields($data);

        $quote = Quote::create($fields);

        $type = $quote->category == Quote::CATEGORY_OUTBOUND ? 2 : 1;

        flash('Successfully generated quote.');

        session()->flash('print_file', route('quote.show', $quote->id));

        return redirect()->route('quote.index', ['type' => $type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        if ($quote->category == Quote::CATEGORY_INBOUND) {
            $quote->invoiceData = json_decode($quote->proforma_data);
            $quote->actualTotal = $quote->proforma_total;
            $quote->agentVat = $quote->agency_fees * ($quote->vat_rate/100);

            $quote->fuel_levy = ($quote->freight * $quote->invoiceData->fuel_levy)/100;
            $quote->subFuel = $quote->freight + $quote->fuel_levy;
            $quote->insurance = ($quote->freight * $quote->invoiceData->insurance_rate)/100;
            $quote->vat_amount = ($quote->subFuel * $quote->invoiceData->vat_rate)/100;

            return view('reports.quote')->with('quote', $quote);
        }


        $quote->invoiceData = json_decode($quote->proforma_data);
        $quote->actualTotal = $quote->proforma_total;
        $quote->agentVat = $quote->agency_fees * ($quote->vat_rate/100);

        $quote->freight = $quote->invoiceData->transport;
        $quote->invoiceData->cck_levy = 0;

        $discount = intval($quote->invoiceData->discount) > 0 ? intval($quote->invoiceData->discount): 0;
        $discount = ($quote->freight * $discount) / 100;

        $quote->discountFreight = $quote->freight - $discount;
        $quote->discount = $discount;

        $quote->fuel_levy = ($quote->discountFreight * $quote->invoiceData->fuel_levy)/100;
        $quote->subFuel = $quote->discountFreight + $quote->fuel_levy;
        $quote->insurance = ($quote->invoiceData->declared_value * $quote->invoiceData->insurance_rate)/100;
        $quote->vat_amount = (($quote->subFuel + $quote->insurance) * $quote->invoiceData->vat_rate)/100;


        return view('reports.quote')->with('quote', $quote);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::with(['client'])->find($id);

        if (request('fill')) {
            $quote->proforma_data = json_decode($quote->proforma_data);

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'quote' => $quote,
                'currencies' => currencies(),
                'countries' => countries(),
            ]);
        }

        if (request('fill-out')) {
            $quote->proforma_data = json_decode($quote->proforma_data);

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'clients' => Client::all('DCLink', 'Name', 'Account'),
                'currencies' => currencies(),
                'countries' => countries(),
                'rates' => RateCard::all(),
                'zones' => RateCardZone::all(),
                'quote' => $quote,
            ]);
        }

        if ($quote->category == Quote::CATEGORY_OUTBOUND) {
            return view('quotes.edit-outbound', [
                'id' => $id
            ]);
        }

        return view('quotes.edit', [
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $data = $request->all();

        if (! isset($data['category'])) {
            $data['category'] = Quote::CATEGORY_INBOUND;
        }

        $fields = $data['category'] == Quote::CATEGORY_INBOUND ?
            Quote::prepareFreightFields($data) :
            Quote::prepareOutboundFreightFields($data);

        $quote->update($fields);

        flash('Successfully updated quote.');

        session()->flash('print_file', route('quote.show', $quote->id));

        $type = $quote->category == Quote::CATEGORY_OUTBOUND ? 2 : 1;

        return redirect()->route('quote.index', ['type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();

        flash('Successfully deleted quote.');

        return redirect()->back();
    }
}
