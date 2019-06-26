<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PAX\Models\RateCard;

class RateCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.rate-card.index')->with('rates', RateCard::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RateCard  $rateCard
     * @return \Illuminate\Http\Response
     */
    public function show(RateCard $rateCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $rateCardId
     * @return \Illuminate\Http\Response
     */
    public function edit($rateCardId)
    {
        return view('masters.rate-card.edit')->with('card', RateCard::findOrFail($rateCardId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rateCardId)
    {
        $rateCard = RateCard::findOrFail($rateCardId);
        $rateCard->update($request->all());

        flash('Successfully updated the rate card.');

        return redirect()->route('rate-card.index');
    }
}
