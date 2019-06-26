<?php

namespace App\Http\Controllers;
use function flash;
use function array_filter;
use function array_keys;
use function array_map;
use function array_values;
use Illuminate\Http\Request;
use function in_array;
use PAX\Models\Manifest;
use PAX\Models\Waybill;
use Response;
use function substr;
use function view;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return Response::json([
                'waybills' => Waybill::inbound()->where('manifest_id', request('manifest_id'))
                    ->where('current_status', 71)
                    ->get()
            ]);
        }

        return view('approval.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $waybillsId = array_map(function($waybill) {
            return $waybill->id;
        }, json_decode($request->get('waybills')));

        Waybill::inbound()->whereIn('id', $waybillsId)->update([
            'clearing_agent_assigned' => true
        ]);

        $waybills = Waybill::inbound()->whereIn('id', $waybillsId)->get([
            'id', 'manifest_id', 'con_name', 'waybill_number', 'total', 'actual_weight', 'description',
            'currency', 'value'
        ]);

        $manifest = Manifest::find($waybills->first()->manifest_id);


        return view('reports.release-order')
            ->with('manifest', $manifest)
            ->with('waybills', $waybills);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function clearingAgents() 
    {
        if (request()->ajax()) {
            return Response::json([
                'waybills' => Waybill::inbound()->where('manifest_id', request('manifest_id'))
                    ->where('current_status', 71)
                    ->get()
            ]);
        }

        return view('clearance.index');
    }
    public function updateClearingAgents(Request $request) 
    {
        $paxClearing = array_keys($request->get('checked'));
        $paxClearing = array_map(function ($item) {
            return substr($item, 6);
        }, $paxClearing);
        $agentClearance = array_filter($request->get('waybills'), function ($item) use ($paxClearing) {
            return ! in_array($item, $paxClearing);
        });
        $agentClearance = array_values($agentClearance);
        Waybill::inbound()->whereIn('id', $agentClearance)->update([
            'clearing_agent' => Waybill::CA_OTHER
        ]);
        flash('Clearing agent updated successfully');

        return redirect()->back();
    }
}
