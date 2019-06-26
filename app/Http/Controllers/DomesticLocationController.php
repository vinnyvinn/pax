<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomesticLocationRequest;
use Carbon\Carbon;
use function flash;
use Illuminate\Http\Request;
use PAX\Models\City;
use PAX\Models\DomesticLocation;
use PAX\Models\DomesticRate;
use function redirect;
use function view;

class DomesticLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('masters.locations.index')->with('locations', DomesticLocation::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('masters.locations.create')->with('accounts', City::getAccounts());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DomesticLocationRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DomesticLocationRequest $request)
    {
        DomesticLocation::create($request->all());

        flash('Successfully added new location.');

        return redirect()->route('domestic-locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $location = DomesticLocation::findOrFail($id);

        return view('masters.locations.edit')
            ->with('accounts', City::getAccounts())
            ->with('location', $location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DomesticLocationRequest $request
     * @param                           $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DomesticLocationRequest $request, $id)
    {
        DomesticLocation::findOrFail($id)->update($request->all());

        flash('Successfully updated location.');

        return redirect()->route('domestic-locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DomesticLocation::where('id', $id)->delete();

        flash('Successfully deleted location.');

        return redirect()->route('domestic-locations.index');
    }
}
