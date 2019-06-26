<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PAX\Models\RateCardZone;

class RateCardZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.outbound-zones.index')->with('zones', RateCardZone::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.outbound-zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RateCardZone::create($request->all());

        flash('Successfully added a new location');

        return redirect()->route('outbound-zones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RateCardZone  $rateCardZone
     * @return \Illuminate\Http\Response
     */
    public function show(RateCardZone $rateCardZone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($zoneId)
    {
        $zone = RateCardZone::findOrFail($zoneId);

        return view('masters.outbound-zones.edit')->with('zone', $zone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $zoneId)
    {
        $zone = RateCardZone::findOrFail($zoneId);

        $zone->update($request->all());

        flash('Successfully updated location');

        return redirect()->route('outbound-zones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RateCardZone  $rateCardZone
     * @return \Illuminate\Http\Response
     */
    public function destroy(RateCardZone $rateCardZone)
    {
        //
    }
}
