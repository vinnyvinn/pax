<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaCodeRequest;
use function dd;
use function flash;
use Illuminate\Http\Request;
use PAX\Models\AreaCode;
use PAX\Models\City;
use function redirect;
use function view;

class AreaCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('masters.areacodes.index')->with('codes', AreaCode::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('masters.areacodes.create')->with('accounts', City::getAccounts());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AreaCodeRequest $request)
    {
        AreaCode::create($request->all());

        flash('Successfully added new area code.');

        return redirect()->route('area-code.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AreaCode  $areaCode
     * @return \Illuminate\Http\Response
     */
    public function show(AreaCode $areaCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AreaCode  $areaCode
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AreaCode $areaCode)
    {
        return view('masters.areacodes.edit')
            ->with('code', $areaCode)
            ->with('accounts', City::getAccounts());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AreaCode  $areaCode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, AreaCode $areaCode)
    {
        $areaCode->update($request->all());

        flash('Successfully edited area code.');

        return redirect()->route('area-code.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AreaCode  $areaCode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AreaCode $areaCode)
    {
        $areaCode->delete();

        flash('Successfully deleted area code.');

        return redirect()->route('area-code.index');
    }
}
