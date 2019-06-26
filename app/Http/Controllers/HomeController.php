<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    /**
     * inbound dashboard
     */
    public function inbound()
    {
        return view('dashboard.inbound');
    }
    /**
     * outbound
     */
    public function outbound()
    {
        return view('dashboard.outbound');
    }
    /**
     * domestic dashboard
     */
    public function domestic()
    {
        return view('dashboard.outbound');
    }
    /**
     * non-fedex dashboard
     */
    public function nonfedex()
    {

    }
    public function settings()
    {
        return view('dashboard.setting');
    }
    public function dispatchDashboard()
    {
        return view('dashboard.dispatch');
    }
    public function clearanceDashboard()
    {
        return view('dashboard.inbound.clearance');
    }
    public function operationsDashboard()
    {
        return view('dashboard.inbound.operations');
    }
    public function financeDashboard()
    {
        return view('dashboard.inbound.finance');
    }
    public function notFound()
    {
        abort(404);
    }
}
