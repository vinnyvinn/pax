<?php

namespace App\Http\Controllers;

use PAX\Models\Setting;
use Illuminate\Http\Request;
use PAX\Processor\Excel;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $settings = Setting::latest()->get();
        if(request()->ajax()) {
            return response()->json([
                'data' => $settings,
                'success' => true,

            ], 200);
        }

        return view('masters.setting.index', ['settings' => $settings ]);
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
        if (! Excel::validateExcel($request->file('uploaded_file'))) {
            flash('Please select a valid Excel manifest file');

            return redirect()->back()->withInput($request->all());
        }
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '1024M');
        $rows = Excel::prepare($request->file('uploaded_file'))
                  ->usingHeaders(['name', 'current_value'])->get();
        foreach ($rows as $row) {
            if($row['name'] && $row['current_value'] && $setting = Setting::where('key', $row['name'])->first()) {
                $setting->update(['current_value' => $row['current_value']]);
            }
        }
        flash('Settings updated successfully');
        
        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
