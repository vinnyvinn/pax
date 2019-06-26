<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomesticWaybillRequest;
use Illuminate\Http\Request;
use PAX\Models\Client;
use PAX\Models\DomesticLocation;
use PAX\Models\DomesticRate;
use PAX\Models\DomesticWaybill;
use PAX\Models\Invoice;
use PAX\Processor\ManifestFactory;
use Picqer\Barcode\BarcodeGeneratorPNG;

class DomesticWaybillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('domestic-waybill.index')
            ->with('domestics', DomesticWaybill::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if(request()->input('req')) {
            return response()->json([
                'locations' => DomesticLocation::all(),
                'clients' => Client::all(),
            ]);
        }
        return view('domestic-waybill.create')
            ->with('locations', DomesticLocation::all())
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
        $data['dim'] = ((int) $data['length'] * (int) $data['width'] * (int) $data['height']) / 5000;

        $waybill = DomesticWaybill::create($request->all());

        flash('Successfully created waybill', 'success');

        session()->flash('print_file', route('domestic.show', $waybill->id));

        return redirect()->route('domestic.index');
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
        $waybill = DomesticWaybill::with(['to', 'from'])->findOrFail($id);

        $waybill->number = str_pad($waybill->id, 12, '0', STR_PAD_LEFT);
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($waybill->number, $generator::TYPE_CODE_128));

        $waybill->number = chunk_split($waybill->number, 3, ' ');

        return view('reports.domestic')
            ->with('barcode', $barcode)
            ->with('domestic', $waybill);
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
        $data = DomesticWaybill::findOrFail($id);
        if(request()->input('ajax')) {

            return response()->json(['waybill' => $data]);
        }

        return view('domestic-waybill.edit')
            ->with('locations', DomesticLocation::all())
            ->with('clients', Client::all(['DCLink', 'Name', 'Account']))
            ->with('domestic', $data)
            ->with('id', $id);
    }


        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         * @param DomesticWaybill           $domestic
         *
         * @return \Illuminate\Http\Response
         * @internal param DomesticWaybill $domesticwaybill
         *
         */
    public function update(Request $request, $id)
    {
        $waybill = Domesticwaybill::findOrFail($id);

        $data = $request->all();
        $waybill->fill($data);

        if ($request->get('finalize') == 'true') {
            $data['status'] = DomesticWaybill::STATUS_FINAL;
            $data['value'] = $data['shipment_value'];
            $data['waybill_number'] = 'DOM-' . str_pad($waybill->id, 12, '0', STR_PAD_LEFT);
            $data['currency'] = '';
            $data['project_id'] = ManifestFactory::createProject($data);
            Invoice::createDomestic($waybill);
        }

        $waybill->update($data);

        flash('Successfully edited the waybill');

        session()->flash('print_file', route('domestic.show', $waybill->id));

        return redirect()->route('domestic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DomesticWaybill::where('id', $id)->delete();

        flash('Successfully deleted the waybill');

        return redirect()->route('domestic.index');
    }
}
