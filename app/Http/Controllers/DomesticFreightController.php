<?php

namespace App\Http\Controllers;

use function flash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use PAX\Models\DomesticWaybill;
use PAX\Models\Invoice;
use PAX\Models\Setting;
use function redirect;
use Response;
use function view;

class DomesticFreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $invoices = Invoice::domestic()->domesticProforma()->get();

        return view('domestic-freight.index')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('domestic-freight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $invoice = Invoice::createDomesticQuote($request->all());

        flash('Successfully created quote.');

        session()->flash('print_file', route('domestic-freight.show', $invoice->id));

        return redirect()->route('domestic-freight.show', 'quote');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        if ($id == 'invoice') {
            return $this->showInvoices();
        }
        
        if ($id == 'quote') {
            return $this->showQuotes();
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->waybill = DomesticWaybill::findOrFail($invoice->waybill_id);
        $invoice->waybill->waybill_number = str_pad($invoice->waybill_id, 12, '0', STR_PAD_LEFT);
        $invoice->waybill->actual_weight = $invoice->waybill->weight;
        $invoice->invoiceData = json_decode($invoice->proforma_data);

        $invoice->actualTotal = $invoice->proforma_total;
        $invoice->agentVat = $invoice->agency_fees * ($invoice->vat_rate/100);
        if ($invoice->type == Invoice::ACTUAL_DOMESTIC) {
            $invoice->actualTotal = $invoice->invoice_total;
        }
        
        $invoice->invoiceData->cck_levy = 0;

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
            $invoice = Invoice::with(['client'])->findOrFail($id);
            $invoice->waybill = DomesticWaybill::findOrFail($invoice->waybill_id);
            $invoice->waybill->waybill_number = str_pad($invoice->waybill_id, 12, '0', STR_PAD_LEFT);
            $invoice->waybill->actual_weight = $invoice->waybill->weight;
            $invoice->proforma_data = json_decode($invoice->proforma_data);
            $invoice->proforma_data->fuel_levy = 0;
            $invoice->proforma_data->cck_levy = 0;
            $invoice->proforma_data->insurance_rate = 0;

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'invoice' => $invoice
            ]);
        }

        return view('domestic-freight.edit', [
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->updateDomesticProforma($request->all());


        $message = 'Successfully amended invoice.';

        if ($request->get('finalize') == 'true') {
            $message = 'Successfully finalized invoice.';
        }

        flash($message);

        session()->flash('print_file', route('domestic-freight.show', $invoice->id));

        return redirect()->route('domestic-freight.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Invoice::where('id', $id)->delete();

        flash('Successfully deleted invoice');

        return redirect()->route('domestic-freight.index');
    }

    private function showInvoices()
    {
        $invoices = Invoice::domestic()->domesticActual()->get();

        return view('domestic-freight.index')->with('invoices', $invoices);
    }

    private function showQuotes()
    {
        $invoices = Invoice::domestic()->domesticQuote()->get();

        return view('domestic-freight.quote')->with('invoices', $invoices);
    }
}
