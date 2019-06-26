<?php

namespace App\Http\Controllers\Masters;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PAX\Models\Client;
use PAX\Processor\Excel;

class ClientController extends Controller
{
    //
    public function index()
    {
        return view('masters.clients.index', ['clients' => Client::select('DCLink', 'Account', 'Name', 'Discount', 'FedexId')->get()]);
    }
    public function store(Request $request)
    {
        if($request->hasFile('file')) {

           $clients = Excel::prepare($request->file('file'))->usingHeaders(['Account', 'FEDEXID', 'Discount'])->get();
            foreach ($clients as $client) {
                if(isset($client['Account'])) {
                    if(isset($client['FEDEXID'])) {
                        \DB::table('Client')->where('Account', $client['Account'])->update(['FedexId' => $client['FEDEXID']]);
                    }
                    if(isset($client['Discount'])) {
                        \DB::table('Client')->where('Account', $client['Account'])->update(['FedexId' => $client['Discount']]);
                    }
                }
            }

            flash('Clients updated successfully');

            return redirect()->back();
        }
    }
}
