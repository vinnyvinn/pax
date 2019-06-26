<?php

namespace App\Http\Controllers;

use function count;
use Illuminate\Http\Request;
use PAX\Models\CBV;
use PAX\Models\City;
use PAX\Models\Manifest;
use PAX\Processor\Excel;
use PAX\Processor\ManifestFactory;
use function redirect;

class OutboundManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        return view('outbound-manifest.index')->with('manifests', Manifest::outbound()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $cbv = CBV::unused()->get();

        if (!count($cbv)) {
            flash('You do not have any unused CBVs left', 'error');

            return redirect()->route('cbv.index');
        }

        return view('outbound-manifest.create')
            ->with('cbvs', $cbv)
            ->with('cities', City::all(['id', 'name']));
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

        if (! ManifestFactory::importManifest($request, true)) {
            flash('An error occurred. Please try again or contact support.', 'error');

            return redirect()->back()->withInput($request->all());
        }

        flash('Successfully imported manifest.');

        return redirect()->route('outbound.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function show($id)
    {
        $manifest = Manifest::findOrFail($id);

        return view('outbound-manifest.show')->with('manifest', $manifest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $manifest = Manifest::findOrFail($id);

        return view('outbound-manifest.edit')->with('manifest', $manifest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @param                           $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $manifest = Manifest::findOrFail($id);

        $data = $request->all();
        $data['flight_number'] = strtoupper($data['flight_number']);

        $manifest->update($data);

        flash('Successfully updated manifest.');

        return redirect()->route('outbound.show', $manifest->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $manifest = Manifest::findOrFail($id);

        $manifest->waybills()->delete();
        $manifest->delete();

        flash('Successfully deleted manifest.');

        return redirect()->route('outbound.index');
    }

    public function getImportForm($type)
    {
        $manifests = Manifest::all(['id', 'flight_number', 'flight_date']);

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
            default:
                break;
        }

        if (! $complete) {
            flash('An error occurred. Please try again or contact support.', 'error');

            return redirect()->back()->withInput($request->all());
        }

        flash("Successfully updated {$type} scan");

        return redirect()->route('outbound.index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function getFlightDates()
    {
        return Response::json([
            'dates' => Manifest::where('is_complete', false)
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
            'manifests' => Manifest::where('flight_date', request('flight_date'))
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
}
