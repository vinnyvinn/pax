<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PAX\Models\OtherCharge;

class OtherChargesController extends Controller
{
    //
    public function index()
    {
        $data = OtherCharge::all();

        if(request()->input('ajax')) {
            return response()->json($data);
        }

        $this->authorize('view-settings');

        return view('masters.other-charges.index', ['data' => $data]);
    }
    public function create() 
    {
        $this->authorize('view-settings');

        return view('masters.other-charges.form', ['data' => new OtherCharge]);
    }
    public function store(Request $request)
    {
        $this->authorize('view-settings');

        OtherCharge::create($request->all());

        session()->flash('info', 'Other charge saved successfully');
        
        return redirect()->route('other-charges.index');
    }
    public function edit($id)
    {
        $this->authorize('view-settings');

        $data = OtherCharge::findOrFail($id);

        return view('masters.other-charges.form', ['data' => $data]);
    }
    public function update(Request $request, $id)
    {
        $this->authorize('view-settings');

        $data = OtherCharge::findOrFail($id);

        $data->update($request->all());

        session()->flash('info', 'Oher charges updated successfully');

        return redirect()->route('other-charges.index');
    }
    public function destroy($id) 
    {
        $this->authorize('view-settings');

        $data = OtherCharge::findOrFail($id);

        $data->delete();

        session()->flash('info', 'Oher charges deleted successfully');

        return redirect()->route('other-charges.index');
    }
}
