<?php

namespace App\Http\Controllers;

use DB;
use function foo\func;
use Illuminate\Http\Request;
use PAX\Models\City;
use PAX\Models\Invoice;
use PAX\Models\NonFedexWaybill;
use PAX\Models\Quote;
use PAX\Models\Setting;
use PAX\Models\Waybill;
use PAX\Support\Currencies;
use Swap;

class NonFedexInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with([
            'client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            },
            'quote' => function ($query) {
                return $query->select('id', 'invoice_id');
            }
        ])
            ->when(request('type') == 1, function ($builder) {
                return $builder->nonInbound();
            })
            ->when(request('type') == 2, function ($builder) {
                return $builder->nonOutbound();
            })
            ->when(\request('final'), function ($builder) {
                return $builder->freightActual();
            })
            ->when(! \request('final'), function ($builder) {
                return $builder->with(['nonWaybill' => function ($query) {
                    return $query->select('id', 'current_status');
                }])->freightProforma();
            })
            ->get();

        return view('non-invoice.index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (! $request->has('from')) {
            abort(404);
        }

        $quote = Quote::findOrFail($request->get('from'));

        return view('quotes.waybill')
            ->with('cities', City::all())
            ->with('waybill', $quote);
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
        $mainQuote = Quote::findOrFail($request->get('quote_id'));
        $quote = $mainQuote->toArray();

        $data['category'] = $quote['category'] == Quote::CATEGORY_INBOUND ?
            NonFedexWaybill::CATEGORY_INBOUND : NonFedexWaybill::CATEGORY_OUTBOUND;
        $data['actual_weight'] = Waybill::getKGs($data['weight']);
        $data['conversion_rate'] = 1;
        try {
            if ($data['currency'] != 'USD') {
                $base = Currencies::getBase($data['currency']);
                $rate = Swap::latest($base . '/USD');
                $data['conversion_rate'] = $rate->getValue();
            }
        } catch (\Exception $ex) {
        }

        $data['usd_value'] = $data['value'] * $data['conversion_rate'];
        $data['project_id'] = self::createProject($data);

        $waybill = NonFedexWaybill::create($data);

        $quote['waybill_id'] = $waybill->id;
        $quote['category'] = $quote['category'] == Quote::CATEGORY_INBOUND ?
            Invoice::CATEGORY_NON_INBOUND: Invoice::CATEGORY_NON_OUTBOUND;

        $quote['type'] = Invoice::PROFORMA_FREIGHT;

        $invoice = Invoice::create($quote);
        $mainQuote->update(['invoice_id' => $invoice->id, 'waybill_id' => $waybill->id]);
        $invoice->waybill = $waybill;

        InvoiceController::handleMail($invoice, $invoice->client_id);

        flash('Successfully created proforma invoice.');

        session()->flash('print_file', route('non-invoice.show', $invoice->id));

        $type = $mainQuote->category == Quote::CATEGORY_OUTBOUND ? 2 : 1;

        return redirect()->route('non-invoice.index', ['type' => $type]);
    }

    public static function createProject($attributes)
    {
        return DB::table('Project')->insertGetId(self::mapSAGEProjectFields($attributes));
    }

    private static function mapSAGEProjectFields($fields)
    {
        $masterProject = config('pax.main_project', 1);
	$masterProject = 591;
        $master = DB::table('Project')->where('ProjectLink', $masterProject)->first();

        if (! $master) {
            abort(404);
        }

        return [
            'SubProjectOfLink' => $masterProject,
            'ActiveProject' => 1,
            'ProjectLevel' => 2,
            'Project_iBranchID' => 0,
            'ProjectCode' => $fields['waybill_number'],
            'ProjectName' => $fields['waybill_number'],
            'ProjectDescription' => $fields['waybill_number'] . ' of value ' .
                $fields['currency'] . $fields['value'],
            'MasterSubProject' => $master->ProjectCode . '>' . $fields['waybill_number'],
        ];
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

        if ($invoice->category == Invoice::CATEGORY_NON_OUTBOUND) {
            $invoice = $this->mapNonOutbound($invoice);
        }

        if ($invoice->category == Invoice::CATEGORY_NON_INBOUND) {
            $invoice = $this->mapNonInbound($invoice);
        }

        $invoice->waybill = $invoice->nonWaybill;

        return view('reports.invoice')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);

        $view = $invoice->category == Invoice::CATEGORY_NON_INBOUND ?
            'freight.edit' : 'outbound-freight.edit';

        $type = $invoice->category == Invoice::CATEGORY_NON_INBOUND ? 1 : 2;

        return view($view, [
            'id' => $id,
            'route' => route('non-invoice.index', ['type' => $type])
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
        $invoice->updateFreightProforma($request->all());

        $message = 'Successfully amended invoice.';

        if ($request->get('finalize') == 'true') {
            $message = 'Successfully finalized invoice.';
        }

        flash($message);

        session()->flash('print_file', route('freight.show', $invoice->id));

        return redirect()->route('freight.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();

        flash('Successfully deleted proforma invoice.');

        return redirect()->back();
    }

    private function mapNonOutbound($invoice)
    {
        $invoice->invoiceData = json_decode($invoice->proforma_data);
        $invoice->actualTotal = $invoice->proforma_total;
        $invoice->agentVat = $invoice->agency_fees * ($invoice->vat_rate/100);
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

        $invoice->fuel_levy = ($invoice->discountFreight * $invoice->invoiceData->fuel_levy)/100;
        $invoice->subFuel = $invoice->discountFreight + $invoice->fuel_levy;
        $invoice->insurance = ($invoice->invoiceData->declared_value * $invoice->invoiceData->insurance_rate)/100;
        $invoice->vat_amount = (($invoice->subFuel + $invoice->insurance) * $invoice->invoiceData->vat_rate)/100;

        return $invoice;
    }

    private function mapNonInbound($invoice)
    {
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

        return $invoice;
    }
}
