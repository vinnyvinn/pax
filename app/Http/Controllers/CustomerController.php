<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PAX\Models\Customer;
use App\Http\Requests\CustomerRequest;
use function flash;

class CustomerController extends Controller
{
    //
    public function index() 
    {
        $data = Customer::latest()->get();
        if(request()->has('view')) {
            return response()->json([
                'data' => $data
            ]);
        }
        return view('dispatch.customers.index', ['customers' => $data]);
    }
    public function create() 
    {
        return view('dispatch.customers.create');
    }
    public function store(CustomerRequest $request) 
    {
        Customer::create($request->all());
        if($request->ajax()) {
            return response()->json([
                'message' => 'Customer added successfully',
            ], 200);
        }
        flash('Customer added successfully.');
        
        return redirect()->route('customers.index');
    }
    public function edit($id) 
    {
        return view('dispatch.customers.edit', ['customer' => Customer::find($id)]);
    }
    public function update(CustomerRequest $request, $id) 
    {
        if(!$customer = Customer::find($id)) {
            flash('customer not found in the records');
            
            return redirect()->back();
        }
        $customer->update($request->all());
        flash('customer updated succcessfully');

        return redirect()->route('customers.index');
    }
}
