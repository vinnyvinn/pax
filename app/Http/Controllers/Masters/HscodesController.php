<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\HscodesRequest;
use Illuminate\Http\Request;
use PAX\Models\Hscode;
use Redirect;

class HscodesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masters.hscodes.index')
            ->withHscodes(Hscode::all()->sortBy('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.hscodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HscodesRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HscodesRequest $request)
    {
        Hscode::create($request->all());

        flash('Successfully created HS Code.');

        return Redirect::route('hscode.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Hscode $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Hscode $id)
    {
        return Redirect::route('couriers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hscode $hscode
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function edit(Hscode $hscode)
    {
        return view('masters.hscodes.edit')
            ->with('code', $hscode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HscodesRequest  $request
     * @param  Hscode $hscode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HscodesRequest $request, Hscode $hscode)
    {
        $hscode->update($request->all());

        flash('Successfully edited HS Code.');

        return Redirect::route('hscode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hscode $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hscode $code)
    {
        $code->delete();

        flash('Successfully deleted HS Code.');

        return Redirect::route('hscode.index');
    }
}
