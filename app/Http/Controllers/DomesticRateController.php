<?php

namespace App\Http\Controllers;

use function flash;
use Illuminate\Http\Request;
use PAX\Models\DomesticRate;
use function redirect;
use function view;

class DomesticRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rates = DomesticRate::with(['from', 'to'])->get();

        return view('masters.rates.index')->with('rates', $rates);
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
        $rate = DomesticRate::with(['from', 'to'])->findOrFail($id);

        return view('masters.rates.edit')->with('rate', $rate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rate = DomesticRate::findOrFail($id);

        $rate->update($request->all());

        flash('Successfully updated rates.');

        return redirect()->route('domestic-rates.index');
    }
}
