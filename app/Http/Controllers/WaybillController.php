<?php

namespace App\Http\Controllers;

use function compact;
use function flash;
use Illuminate\Http\Request;
use PAX\Models\Waybill;
use function redirect;
use function view;

class WaybillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waybill  $waybill
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Waybill $waybill)
    {
        return view('waybills.show')->with('waybill', $waybill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waybill  $waybill
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Waybill $waybill)
    {
        return view('waybills.edit')->with('waybill', $waybill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waybill  $waybill
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Waybill $waybill)
    {
        $waybill->update($request->all());

        flash('Successfully updated waybill.');

        return redirect()->route('waybill.show', $waybill->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waybill  $waybill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waybill $waybill)
    {
        //
    }

    public function changeAgent($waybillId)
    {
        $waybill = Waybill::findOrFail($waybillId);

        if ($waybill->clearance_billed) {
            return redirect('/');
        }

        $waybill->clearing_agent = $waybill->clearing_agent == Waybill::CA_PAX ?
            Waybill::CA_OTHER :
            Waybill::CA_PAX;

        $waybill->clearing_agent_name = $waybill->clearing_agent == Waybill::CA_PAX ?
            Waybill::CA_PAX :
            '';

        $waybill->save();

        flash('Successfully updated agent.');

        return redirect()->route('waybill.show', $waybill->id);
    }

    public function getReleaseOrder($waybillId)
    {
        $waybill = Waybill::with('manifest')->findOrFail($waybillId);

        return view('reports.release-order')
            ->with('manifest', $waybill->manifest)
            ->with('waybills', [$waybill]);
    }
}
