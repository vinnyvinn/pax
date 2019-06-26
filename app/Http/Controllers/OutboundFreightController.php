<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function intval;
use PAX\Models\Client;
use PAX\Models\Invoice;
use PAX\Models\Quote;
use PAX\Models\RateCard;
use PAX\Models\RateCardZone;
use PAX\Models\Setting;
use PAX\Models\Waybill;
use PAX\Support\Countries;
use Response;
use function view;
use PAX\Models\Courier;
use function GuzzleHttp\Promise\all;

class OutboundFreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('outbound-freight.index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::with(['client'])->outbound()->freightProforma()->get());
    }

    public function invoices()
    {
        return view('outbound-freight.index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::outbound()->freightActual()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (request('fill')) {
            $waybills = Waybill::outbound()
                ->unbilled()
                ->get()
                ->keyBy('id');

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'waybills' => $waybills,
                'clients' => Client::all('DCLink', 'Name', 'Account', 'FedexId', 'Discount'),
                'rates' => RateCard::all(),
                'zones' => RateCardZone::all(),
                'couriers' => Courier::select('id', 'name')->get(),
                'fedex_account' => config('pax.FEDEX_ACCOUNT'),
            ]);
        }

        return view('outbound-freight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::createOutboundProforma($request->all());
        $Waybill = Waybill::findOrFail($request->get('waybill_id'));
        $Waybill->update($request->get('waybill'));
        flash('Successfully generated new invoice.');

        session()->flash('print_file', route('outbound.freight.show', $invoice->id));

        return redirect()->route('outbound.freight.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with('waybill')->findOrFail($id);
        $invoice->invoiceData = json_decode($invoice->proforma_data);
        $invoice->actualTotal = $invoice->proforma_total;
        $invoice->agentVat = $invoice->waybill->bill_to == 'R' ? 0 : $invoice->agency_fees * ($invoice->vat_rate/100);
        if ($invoice->type == Invoice::ACTUAL_FREIGHT) {
            $invoice->actualTotal = $invoice->invoice_total;
            $invoice->invoiceData = json_decode($invoice->invoice_data);
        }

        $invoice->freight = $invoice->invoiceData->transport;
        $invoice->invoiceData->cck_levy = 0;

        $discount = intval($invoice->invoiceData->discount) > 0 ? intval($invoice->invoiceData->discount): 0;
        $discount = ($invoice->freight * $discount) / 100;

        $invoice->discountFreight = $invoice->freight - $discount;
        $invoice->discount = $discount;

        $invoice->fuel_levy = $invoice->waybill->bill_to == 'R' ? 0 : ($invoice->discountFreight * $invoice->invoiceData->fuel_levy)/100;
        $invoice->subFuel = $invoice->waybill->bill_to == 'R' ? 0 : $invoice->discountFreight + $invoice->fuel_levy;
        $invoice->insurance = $invoice->waybill->bill_to == 'R' ? 0 : ($invoice->invoiceData->declared_value * $invoice->invoiceData->insurance_rate)/100;
        $invoice->vat_amount = $invoice->waybill->bill_to == 'R' ? 0 : (($invoice->subFuel + $invoice->insurance) * $invoice->invoiceData->vat_rate)/100;

        if ($invoice->category == Invoice::CATEGORY_NON_INBOUND || $invoice->category == Invoice::CATEGORY_NON_OUTBOUND) {
            unset($invoice->waybill);
            $invoice->waybill = $invoice->nonWaybill;
            unset($invoice->nonWaybill);
        }

        return view('reports.invoice')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (request('fill')) {
            $invoice = Invoice::with(['waybill', 'nonWaybill', 'client'])->find($id);
            if ($invoice->category == Invoice::CATEGORY_NON_INBOUND || $invoice->category == Invoice::CATEGORY_NON_OUTBOUND) {
                unset($invoice->waybill);
                $invoice->waybill = $invoice->nonWaybill;
                unset($invoice->nonWaybill);
            }

            $invoice->proforma_data = json_decode($invoice->proforma_data);

            return response()->json([
                'settings' => Setting::all()->keyBy('key'),
                'couriers' => Courier::select('id', 'name')->get(),
                'invoice' => $invoice,
            ]);
        }

        return view('outbound-freight.edit', [
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->get('waybill'));
        $invoice = Invoice::findOrFail($id);
        $data = $request->all();
        $setCategory = true;
        if ($invoice->category == Invoice::CATEGORY_NON_OUTBOUND) {
            $setCategory = false;
        }
        $waybill = Waybill::findOrFail($request->get('waybill_id'));
        $data = (array) $request->get('waybill');
        $waybill->update($data);
        $invoice->updateOutboundFreightProforma($request->all(), $setCategory);
        
        $message = 'Successfully amended invoice.';

        if ($request->get('finalize') == 'true') {
            $this->updateQuote($invoice);
            $message = 'Successfully finalized invoice.';
        }

        flash($message);

        session()->flash('print_file', route('outbound.freight.show', $invoice->id));

        if (strlen($request->get('route')) > 5) {
            return redirect()->away($request->get('route'));
        }

        return redirect()->route('outbound.freight.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function updateQuote($invoice)
    {
        Quote::where('invoice_id', $invoice->id)->update([
            'invoice_total' => $invoice->invoice_total,
        ]);
        \DB::statement('UPDATE quotes SET variance = invoice_total - proforma_total');
    }
}
