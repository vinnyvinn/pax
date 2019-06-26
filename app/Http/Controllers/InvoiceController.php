<?php

namespace App\Http\Controllers;

use App\Mail\ProformaInvoiceGenerated;
use App\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use PAX\Models\Client;
use PAX\Models\Invoice;
use PAX\Models\NonFedexWaybill;
use PAX\Models\Setting;
use PAX\Models\Waybill;
use Response;
use function route;
use function session;
use function view;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('invoices.index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::with(['client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            }])->inbound()->proforma()->get());
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
                ->unbilled()
                ->where('current_status', 71)
                ->where('clearing_agent', Waybill::CA_PAX)
                ->get()->keyBy('id');

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'waybills' => $waybills,
                'clients' => Client::all('DCLink', 'Name', 'Account', 'Email')
            ]);
        }

        if (request('fill-non')) {
            $waybills = NonFedexWaybill::inbound()
                ->unbilled()
                ->where('status', 71)
                ->where('clearing_agent', Waybill::CA_PAX)
                ->get()->keyBy('id');

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'waybills' => $waybills,
                'clients' => Client::all('DCLink', 'Name', 'Account', 'Email')
            ]);
        }

        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! $request->get('client_id')) {
            flash('Please select a client to be billed.', 'error');

            return redirect()->back();
        }

        if (! $request->get('waybill_id')) {
            flash('Please select a waybill.', 'error');

            return redirect()->back();
        }

        $invoice = Invoice::createProforma($request->all());

        self::handleMail($invoice, $invoice->client_id);

        flash('Successfully generated new invoice.');

        session()->flash('print_file', route('invoice.show', $invoice->id));

        return redirect()->route(request('route', 'invoice.index'));
    }

    public static function handleMail($invoice, $clientId)
    {
        
            if ($invoice->category == Invoice::CATEGORY_NON_INBOUND) {
                $waybill = $invoice->nonWaybill;
            } else {
                $waybill = $invoice->waybill;
            }

            $client = Client::where('DCLink', $clientId)->first(['EMail', 'Name']);

            if (! $client) {
                return;
            }

            $user = new User([
                'name' => $client->Name, 'email' => $invoice->client_email
            ]);
            $invoice->actualTotal = $invoice->proforma_total;
            $invoice->agentVat = $invoice->agency_fees * ($invoice->vat_rate/100);
            if ($invoice->type == Invoice::ACTUAL) {
               $invoice->actualTotal = $invoice->invoice_total;
            }
            \Mail::to($invoice->client_email)->cc($invoice->email_cc)->send(new ProformaInvoiceGenerated($invoice, $user));
    }

    /**
     * Display the specified resource.
     *
     * @param  Invoice  $invoice
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Invoice $invoice)
    {
        if ($invoice->category == Invoice::CATEGORY_NON_INBOUND) {
            $invoice->waybill = $invoice->nonWaybill;
        }
        $invoice->actualTotal = $invoice->proforma_total;
        $invoice->agentVat = $invoice->agency_fees * ($invoice->vat_rate/100);
        if ($invoice->type == Invoice::ACTUAL) {
            $invoice->actualTotal = $invoice->invoice_total;
        }

        return view('reports.invoice')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (request('fill')) {
            $invoice = Invoice::with(['waybill', 'client'])->find($id);
            $invoice->proforma_data = json_decode($invoice->proforma_data);

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'waybills' => [],
                'clients' => [],
                'invoice' => $invoice
            ]);
        }

        if (request('fill-non')) {
            $invoice = Invoice::with(['nonWaybill', 'client'])->find($id);
            $invoice->proforma_data = json_decode($invoice->proforma_data);
            $invoice->waybill = $invoice->nonWaybill;
            unset($invoice->nonWaybill);

            return Response::json([
                'settings' => Setting::all()->keyBy('key'),
                'waybills' => [],
                'clients' => [],
                'invoice' => $invoice
            ]);
        }

        return view('invoices.edit', [
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->updateProforma($request->all());
        self::handleMail($invoice, $invoice->client_id);

        session()->flash('print_file', route('invoice.show', $invoice->id));

        flash('Successfully updated invoice.');

        return redirect()->route(request('route', 'invoice.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function invoice()
    {
        return view('invoices.index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::with(['client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            }])->inbound()->actual()->get());
    }
}
