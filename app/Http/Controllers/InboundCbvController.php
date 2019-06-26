<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PAX\Models\InCbv;
use PAX\Models\Manifest;

class InboundCbvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inbound-cbv.index')->with('cbvs', InCbv::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inbound-cbv.create')
            ->with('manifests', Manifest::all(['flight_number', 'flight_date', 'id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'invoices' => 'required|file'
        ]);

        $data = $request->all();
        $data['cbv_date'] = Carbon::parse($data['cbv_date']);

        $data['invoices'] = $this->getUpload($request);

        InCbv::create($data);

        flash('Successfully entered new cbv details.');

        return redirect()->back();
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
        return view('inbound-cbv.edit')->with('cbv', InCbv::findOrFail($id));
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
        $cbv = InCbv::findOrFail($id);
        $data = $request->all();
        $data['cbv_date'] = Carbon::parse($data['cbv_date']);
        $data['invoices'] = $this->getUpload($request, $cbv);
        $cbv->fill($data);
        $cbv->save();

        flash('Successfully updated cbv details.');

        return redirect()->away($request->get('ref'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InCbv::where('id', $id)->delete();

        flash('Successfully deleted cbv details.');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param InCbv $cbv
     * @return string
     */
    protected function getUpload(Request $request, InCbv $cbv = null)
    {
        if (!is_dir(public_path('invoices/in'))) {
            mkdir(public_path('invoices/in'), 0755, true);
        }

        if (! $file = $request->file('invoices')) {
            if ($cbv) {
                return $cbv->invoices;
            }

            return '';
        }

        $filename = time() . str_random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('invoices/in'), $filename);

        if ($cbv && $cbv->invoices) {
            unlink(public_path($cbv->invoices));
        }

        return 'invoices/in/' . $filename;
    }
}
