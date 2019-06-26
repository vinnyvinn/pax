<?php

namespace App\Http\Controllers\Masters;

use App\Http\Requests\CBVRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PAX\Models\CBV;

class CBVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('masters.CBV.index')->with('cbvs', CBV::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.CBV.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CBVRequest $request)
    {
        CBV::create($request->all());

        flash('Successfully saved a new CBV', 'success');

        return redirect()->route('cbv.index');
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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('masters.CBV.edit')->with('cbv', CBV::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @param CBV                       $cbv
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CBVRequest $request, CBV $cbv)
    {
        $data = $request->all();

        $cbv->update($data);

        flash('Successfully edited the CBV', 'success');

        return redirect()->route('cbv.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CBV::where('id', $id)->delete();

        flash('Successfully deleted the CBV', 'success');

        return redirect()->route('cbv.index');
    }
}
