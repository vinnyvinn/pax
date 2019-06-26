<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function json_decode;
use PAX\Models\Client;
use PAX\Models\Invoice;
use PAX\Models\Quote;
use PAX\Models\Setting;
use PAX\Models\Waybill;
use Response;
use function view;
use PAX\Models\RateCardZone;
use PAX\Models\RateCard;
use PAX\Models\Courier;
use PAX\Models\Manifest;

class InboundFreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('freight.index')
            ->with('currency', '')
            ->with('invoices', Invoice::with(['client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            }])->inbound()->freightProforma()->get());
    }

    public function invoice()
    {
        return view('freight.index')
            ->with('currency', '')
            ->with('invoices', Invoice::inbound()->freightActual()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (request('fill')) {
            $waybills = Waybill::inbound()
                ->billed()
                ->where('current_status', '<=', 65)
                ->where('status', Manifest::POD)
                ->where('clearing_agent', Waybill::CA_PAX)
                ->get()
                ->keyBy('id');

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'waybills' => $waybills,
                'clients' => Client::all('DCLink', 'Name', 'Account')
            ]);
        }

        return view('freight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = Invoice::createFreightProforma($request->all());

        flash('Successfully generated new invoice.');

        session()->flash('print_file', route('freight.show', $invoice->id));

        return redirect()->route('freight.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->invoiceData = json_decode($invoice->proforma_data);
        $invoice->actualTotal = $invoice->proforma_total;
        $invoice->agentVat = $invoice->agency_fees * ($invoice->vat_rate/100);
        if ($invoice->type == Invoice::ACTUAL_FREIGHT) {
            $invoice->actualTotal = $invoice->invoice_total;
            $invoice->invoiceData = json_decode($invoice->invoice_data);
        }

        $invoice->fuel_levy = ($invoice->freight * $invoice->invoiceData->fuel_levy)/100;
        $invoice->subFuel = $invoice->freight + $invoice->fuel_levy;
        $invoice->insurance = ($invoice->freight * $invoice->invoiceData->insurance_rate)/100;
        $invoice->vat_amount = ($invoice->subFuel * $invoice->invoiceData->vat_rate)/100;

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

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'zones' => RateCardZone::all(),
                'rates' => RateCard::all(),
                'couriers' => Courier::select('id', 'name')->get(),
                'fedex_account' => config('pax.FEDEX_ACCOUNT'),
                'invoice' => $invoice
            ]);
        }

        return view('freight.edit', [
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
        $invoice = Invoice::findOrFail($id);
        $setCategory = true;
        if ($invoice->category == Invoice::CATEGORY_NON_OUTBOUND) {
            $setCategory = false;
        }
        $invoice->updateFreightProforma($request->all(), $setCategory);

        $message = 'Successfully amended invoice.';

        if ($request->get('finalize') == 'true') {
            $this->updateQuote($invoice);
            $message = 'Successfully finalized invoice.';
        }

        flash($message);

        session()->flash('print_file', route('freight.show', $invoice->id));

        if (strlen($request->get('route')) > 5) {
            return redirect()->away($request->get('route'));
        }

        return redirect()->route('freight.index');
    }

    public function processPODScan()
    {
        if(request()->input('ajax')) {

            return response()->json([
                'waybills' => Waybill::inbound()->where('pod_set', false)->where('clearing_agent', Waybill::CA_PAX)->get(),
                'couriers' => Courier::select('id', 'name', 'fedex_id')->get(),
                ]);
        }

        return view('inbound-manifest.process-pod');
    }

    public function processPOD(Request $request)
    {
        $waybill = Waybill::findOrFail($request->input('waybill_id'));

        $data = $request->all();

        $data['pod_set'] = true;
        $data['status'] = Manifest::POD;
        $data['current_status'] = Manifest::POD;

        $waybill->update($data);

        return response()->json(['message' => 'POD processed successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::where('id', $id)->delete();

        flash('Successfully deleted invoice.');

        return redirect()->route('freight.index');
    }

    private function updateQuote($invoice)
    {
        Quote::where('invoice_id', $invoice->id)->update([
            'invoice_total' => $invoice->invoice_total,
        ]);
        \DB::statement('UPDATE quotes SET variance = invoice_total - proforma_total');
    }
}
