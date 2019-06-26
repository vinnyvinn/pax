<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\RouteRequest;
use function flash;
use Illuminate\Http\Request;
use PAX\Models\AreaCode;
use PAX\Models\Route;
use function redirect;
use function view;
use PAX\Masters\RouteInterface;

class RouteController extends Controller
{
    protected $routeImport;
    public function __construct(RouteInterface $routeImport) 
    {
        $this->routeImport = $routeImport;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('masters.routes.index')->with('routes', Route::with(['areaCode'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (! AreaCode::count()) {
            flash('Please create area codes first', 'error');

            return redirect()->route('area-code.index');
        }
        return view('masters.routes.create')->with('codes', AreaCode::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RouteRequest $request)
    {
        Route::create($request->all());

        flash('Successfully added new route.');

        return redirect()->route('route.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Route $route)
    {
        return view('masters.routes.edit')
            ->with('codes', AreaCode::all())
            ->with('route', $route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RouteRequest $request, Route $route)
    {
        $route->update($request->all());

        flash('Successfully edited route.');

        return redirect()->route('route.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Route $route)
    {
        $route->delete();

        flash('Successfully deleted route.');

        return redirect()->route('route.index');
    }
    public function import(Request $request) 
    {
        return $this->routeImport->parse($request)->validate()->getRows()->import();
    }
}
