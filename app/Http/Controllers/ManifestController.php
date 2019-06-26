<?php

namespace App\Http\Controllers;

use function abort;
use Carbon\Carbon;
use DB;
use Exception;
use function flash;
use function floatval;
use Illuminate\Http\Request;
use PAX\Models\City;
use PAX\Models\InCbv;
use PAX\Models\Manifest;
use PAX\Models\Waybill;
use PAX\Processor\Excel;
use PAX\Processor\ManifestFactory;
use PAX\Support\Currencies;
use function redirect;
use Response;
use function strtoupper;
use Swap\Laravel\Facades\Swap;
use function view;

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        if (request('dates')) {
            return $this->getFlightDates();
        }

        if (request('manifests')) {
            return $this->getManifests();
        }

        if (request('waybills')) {
            return $this->getWaybills();
        }
        if (request('released')) {
            return $this->getClearedWaybills();
        }
        if(request()->input('page') == 'clearance') {

            return view('manifest.clearance.index')->with('manifests', Manifest::inbound()->get());
        }
        if(request()->input('page') == 'operations') {

            return view('manifest.operations.index')->with('manifests', Manifest::inbound()->get());
        }
        if(request()->input('page') == 'finance') {

            return view('manifest.finance.index')->with('manifests', Manifest::inbound()->get());
        }

        return view('manifest.index')->with('manifests', Manifest::inbound()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('manifest.create')->with('cities', City::all(['id', 'name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return Controller|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $file = $request->file('uploaded_file');

        if (! Excel::validateExcel($file)) {
            flash('Please select a valid Excel manifest file');

            return redirect()->back()->withInput($request->all());
        }

        if (! ManifestFactory::importManifest($request)) {
            flash('An error occurred. Please try again or contact support.', 'error');

            return redirect()->back()->withInput($request->all());
        }

        flash('Successfully imported manifest.');

        return redirect()->route('manifest.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Manifest  $manifest
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Manifest $manifest)
    {
        if(request()->input('page') == 'clearance') {

            return view('manifest.clearance.show')
                    ->with('cbvs', InCbv::where('manifest_id', $manifest->id)->get())
                    ->with('manifest', $manifest);
        }

        if(request()->input('page') == 'operations') {

            return view('manifest.operations.show')
                    ->with('cbvs', InCbv::where('manifest_id', $manifest->id)->get())
                    ->with('manifest', $manifest);
        }
        if(request()->input('page') == 'finance') {

            return view('manifest.finance.show')
                    ->with('cbvs', InCbv::where('manifest_id', $manifest->id)->get())
                    ->with('manifest', $manifest);
        }

        return view('manifest.show')
            ->with('cbvs', InCbv::where('manifest_id', $manifest->id)->get())
            ->with('manifest', $manifest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manifest  $manifest
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Manifest $manifest)
    {
        return view('manifest.edit')->with('manifest', $manifest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manifest  $manifest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Manifest $manifest)
    {
        $data = $request->all();
        $data['flight_number'] = strtoupper($data['flight_number']);

        $manifest->update($data);

        flash('Successfully updated manifest.');

        return redirect()->route('manifest.show', $manifest->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manifest  $manifest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manifest $manifest)
    {
        $manifest->waybills()->delete();
        $manifest->delete();

        flash('Successfully deleted manifest.');

        return redirect()->route('manifest.index');
    }

    public function getImportForm($type)
    {
        $manifests = Manifest::inbound()->get(['id', 'flight_number', 'flight_date']);

        switch ($type) {
            case 'released':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 65)
                    ->with('endpoint', 'released');
                break;
            case 'dutiable':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 71)
                    ->with('endpoint', 'dutiable');
                break;
            case 'non-dutiable':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 72)
                    ->with('endpoint', 'non-dutiable');
                break;
            case 'sip':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 'SIP')
                    ->with('endpoint', 'sip');
                break;
            case 'van':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 'VAN')
                    ->with('endpoint', $type);
                break;
            case 'pod':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 'POD')
                    ->with('endpoint', $type);
                break;
            case 'dex':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 'DEX')
                    ->with('endpoint', $type);
                break;
            case 'oda':
                return view('manifest.update')->with('manifests', $manifests)
                    ->with('scan', 'ODA')
                    ->with('endpoint', $type);
                break;

            default:
                abort(404);
                break;
        }
    }

    public function processScan(Request $request, $type)
    {
        if (! Excel::validateExcel($request->file('uploaded_file'))) {
            flash('Please select a valid Excel manifest file');

            return redirect()->back()->withInput($request->all());
        }

        $complete = false;

        switch ($type) {
            case 'released':
                $complete = ManifestFactory::processScan($request, 65);
                break;
            case 'dutiable':
                $complete = ManifestFactory::processScan($request, 71);
                break;
            case 'non-dutiable':
                $complete = ManifestFactory::processScan($request, 72);
                break;
            case 'sip':
                $complete = ManifestFactory::processScan($request, Manifest::SIP);
                break;
            case 'van':
                $complete = ManifestFactory::processVanScan($request);
                break;
            case 'pod':
                $complete = ManifestFactory::processPODScan($request);
                break;
            case 'dex':
                $complete = ManifestFactory::processDEXScan($request);
                break;
            case 'oda':
                $complete = ManifestFactory::processODAScan($request);
                break;
            default:
                break;
        }

        if (! $complete) {
            flash('An error occurred. Please try again or contact support.', 'error');

            return redirect()->back()->withInput($request->all());
        }

        flash("Successfully updated {$type} scan");

        return redirect()->route('manifest.index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function getFlightDates()
    {
        return Response::json([
            'dates' => Manifest::inbound()->where('is_complete', false)
                ->distinct(['flight_date'])
                ->get(['flight_date'])
                ->map(function ($manifest) {
                    $manifest->formatted_date = Carbon::parse($manifest->flight_date)->format('d F Y');

                    return $manifest;
                })
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function getManifests()
    {
        return Response::json([
            'manifests' => Manifest::inbound()->where('flight_date', request('flight_date'))
                ->get(['id', 'flight_number'])
        ]);
    }

    private function getWaybills()
    {
        return Response::json([
            'waybills' => Waybill::where('manifest_id', request('manifest_id'))
                ->where('current_status', 71)
                ->where('clearing_agent_assigned', false)
                ->get()
        ]);
    }
    private function getClearedWaybills()
    {
        return Response::json([
            'waybills' => Waybill::where('manifest_id', request('manifest_id'))
                ->where('current_status', 71)
                ->where('clearing_agent_assigned', true)
                ->get()
        ]);
    }

    public function createWaybill($manifestId)
    {
        return view('waybills.create')
            ->with('waybill', new Waybill(['manifest_id' => $manifestId]))
            ->with('route', url('/overage'))
            ->with('manifest', $manifestId);
    }

    public function storeWaybill(Request $request)
    {
        $data = $request->all();
        $data['overage'] = true;

        Waybill::create($data);

        flash('Successfully added new waybill.');

        return redirect()->route('manifest.show', $request->get('manifest_id'));
    }
}
