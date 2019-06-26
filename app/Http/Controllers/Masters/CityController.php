<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\CityRequest;
use PAX\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.cities.index')->with('cities', City::all(['id', 'name']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.cities.create')->with('accounts', City::getAccounts());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        City::create($request->all());

        flash('Successfully added new city.');

        return redirect()->route('city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('masters.cities.edit')
            ->with('accounts', City::getAccounts())
            ->with('city', $city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CityRequest  $request
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());

        flash('Successfully edited city.');

        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        flash('Successfully deleted city.');

        return redirect()->route('city.index');
    }
}
