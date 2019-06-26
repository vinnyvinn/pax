<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourierRequest;
use function flash;
use Illuminate\Http\Request;
use PAX\Models\Courier;
use PAX\Models\Route;
use Redirect;

class CourierController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(request()->has('view')) {

            return response()->json([
                'data' => Courier::with(['route.areaCode'])->get()
            ]);
        }

        return view('masters.courier.index')
            ->with('couriers', Courier::all()->sortBy('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masters.courier.create')->with('routes', Route::all(['id', 'name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CourierRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CourierRequest $request)
    {
        Courier::create($request->all());

        flash('Successfully added new courier.');

        return Redirect::route('courier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return Redirect::route('couriers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Courier $courier
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Courier $courier)
    {
        return view('masters.courier.edit')
            ->with('routes', Route::all(['id', 'name']))
            ->with('courier', $courier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourierRequest $request
     * @param Courier        $courier
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CourierRequest $request, Courier $courier)
    {
        $courier->update($request->all());

        flash('Successfully updated courier.');

        return Redirect::route('courier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Courier $courier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();

        flash('Successfully deleted courier.');

        return redirect()->route('courier.index');
    }
}
