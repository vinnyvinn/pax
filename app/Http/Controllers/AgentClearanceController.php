<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use function json_decode;
use PAX\Models\Client;
use PAX\Models\Invoice;
use PAX\Models\Setting;
use PAX\Models\Waybill;
use function view;

class AgentClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('agent-clearance.index')->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::agent()
                ->with(['client' => function ($query) {
                    return $query->select('DCLink', 'Name', 'Account');
                }])
                ->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $waybills = Waybill::inbound()
            ->unbilled()
            ->where('current_status', 71)
            ->where('clearing_agent', Waybill::CA_OTHER)
            ->get()->keyBy('id');

        return view('agent-clearance.create')
            ->with('waybills', $waybills)
            ->with('clients', Client::all(['DCLink', 'Name', 'Account']));
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
//        $data['break_bulk_fee'] = 0;

        $invoice = Invoice::createAgentClearance($data);

        flash('Successfully generated new invoice.');

        session()->flash('print_file', route('agent-clearance.show', $invoice->id));

        return redirect()->route('agent-clearance.index');
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
        $invoice = Invoice::with(['waybill'])->findOrFail($id);
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
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->proforma_data = json_decode($invoice->proforma_data);

        $waybills = Waybill::inbound()->where('current_status', 71)
            ->where('clearing_agent', Waybill::CA_OTHER)
            ->get()->keyBy('id');

        return view('agent-clearance.edit')
            ->with('invoice', $invoice)
            ->with('waybills', $waybills)
            ->with('clients', Client::all('DCLink', 'Name', 'Account'));
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

        $data = $request->all();
//        $data['break_bulk_fee'] = 0;

        $invoice->updateAgentClearance($data);

        session()->flash('print_file', route('agent-clearance.show', $invoice->id));

        flash('Successfully updated invoice.');

        return redirect()->route('agent-clearance.index');
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

        return redirect()->route('agent-clearance.index');
    }
}
