<?php
use PAX\Support\Countries;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    Route::get('inbound-dashboard', 'HomeController@inbound')->name('inbound-dashboard');
    Route::get('outbound-dashboard', 'HomeController@outbound')->name('outbound-dashboard');
    Route::get('setting-dashboard', 'HomeController@settings')->name('setting-dashboard');
    Route::get('dispatch-dashboard', 'HomeController@dispatchDashboard')->name('dispatch-dashboard');
    Route::get('clearance-dashboard', 'HomeController@clearanceDashboard')->name('clearance-dashboard');
    Route::get('operations-dashboard', 'HomeController@operationsDashboard')->name('operations-dashboard');
    Route::get('finance-dashboard', 'HomeController@financeDashboard')->name('finance-dashboard');

    Route::resource('area-code', 'Masters\AreaCodeController');
    Route::resource('route', 'Masters\RouteController');
    Route::post('route-import', 'Masters\RouteController@import')->name('routes.import');
    Route::resource('courier', 'Masters\CourierController');
    Route::resource('hscode', 'Masters\HscodesController');
    Route::resource('cbv', 'Masters\CBVController');
    Route::resource('clients', 'Masters\ClientController');

    Route::resource('sales-rate-card', 'Masters\SalesRateCardController');
    Route::get('active-sales-rate-card', 'Masters\SalesRateCardController@activeRateCard');
    Route::resource('other-charges', 'Masters\OtherChargesController');

    Route::resource('gdr', 'Masters\GDRRateCardController');
    Route::get('active-gdr', 'Masters\GDRRateCardController@activeGdr');

    Route::resource('discount-rate-card', 'Masters\DiscountRateCardController');

    Route::get('manifest/scan/{type}', 'ManifestController@getImportForm')->name('manifest.scan');
    Route::post('manifest/scan/{type}', 'ManifestController@processScan');
    Route::resource('manifest', 'ManifestController');

    Route::get('invoice/invoices', 'InvoiceController@invoice')->name('invoice.invoice');
    Route::resource('invoice', 'InvoiceController');
    Route::get('freight/invoices', 'InboundFreightController@invoice')->name('freight.invoice');
    Route::resource('freight', 'InboundFreightController');
    Route::get('freights/pod-scan', 'InboundFreightController@processPODScan')->name('freight.pod-scan');
    Route::post('freights/pod-scan', 'InboundFreightController@processPOD');

    Route::resource('outbound', 'OutboundManifestController');
    Route::get('waybill/freight/invoices', 'OutboundFreightController@invoices')->name('outbound.freight.invoice');
    Route::name('outbound')->resource('waybill/freight', 'OutboundFreightController');
    Route::resource('waybill', 'WaybillController');
    Route::resource('agent-clearance', 'AgentClearanceController');
    Route::resource('domestic', 'DomesticWaybillController');
    Route::resource('domestic-locations', 'DomesticLocationController');
    Route::resource('domestic-rates', 'DomesticRateController', [
        'only' => ['index', 'edit', 'update']
    ]);
    Route::resource('domestic-freight', 'DomesticFreightController');
    Route::resource('city', 'Masters\CityController');

    Route::get('clearance/change/{id}', 'WaybillController@changeAgent')->name('clearance.change');
    Route::get('clearance/release/{id}', 'WaybillController@getReleaseOrder')->name('clearance.release');
    Route::get('clearance/approve', 'ApprovalController@index')->name('clearance.index');
    Route::post('clearance', 'ApprovalController@store');
    Route::get('clearing-agents', 'ApprovalController@clearingAgents')->name('clearing-agents');
    Route::post('clearing-agents', 'ApprovalController@updateClearingAgents')->name('clearing-agent.update');
    Route::resource('user', 'UserController');
    Route::get('change-password', 'UserController@changePasswordForm');
    Route::post('change-password', 'UserController@changePassword')->name('password.change');

    Route::resource('inbound-cbv', 'InboundCbvController');
    Route::resource('rate-card', 'RateCardController');
    Route::resource('outbound-zones', 'RateCardZoneController');
    Route::get('overage/{manifestId}', 'ManifestController@createWaybill');
    Route::post('overage', 'ManifestController@storeWaybill');
    Route::resource('quote', 'QuoteController');
    Route::resource('non-invoice', 'NonFedexInvoiceController');
    Route::get('non-fedex/receive/{id}', 'ImportsController@receive')->name('non-receive');
    Route::post('non-fedex/receive/{id}', 'ImportsController@processReception');
    Route::get('non-fedex/release-order/{id}', 'ImportsController@releaseOrder')->name('non-release-order');
    Route::get('non-fedex/clear', 'ImportsController@clearShipment')->name('non-clearance');
    Route::get('non-fedex/proforma', 'ImportsController@clearanceInvoices')->name('non-invoices');
    Route::get('non-fedex/invoices', 'ImportsController@actualClearanceInvoices')->name('non-invoices-actual');
    Route::get('non-fedex/invoices/{id}', 'ImportsController@editClearance')->name('non-clearance-invoices.edit');
    Route::get('non-fedex/dispatch/{id}', 'ImportsController@dispatchWaybill')->name('non-dispatch');
    Route::get('non-fedex/load/{id}', 'ImportsController@loadWaybill')->name('non-load');
    Route::post('non-fedex/load/{id}', 'ImportsController@processLoading')->name('non-load.store');
    Route::get('non-fedex/pod/{id}', 'ImportsController@processPOD')->name('non-pod');
    Route::get('non-fedex/dex/{id}', 'ImportsController@processDEX')->name('non-dex');

    Route::resource('settings', 'SettingController');

    Route::resource('additional-charges-outbound', 'AdditionalChargeController');
    Route::get('additional-charges-outbound-invoices', 'AdditionalChargeController@invoices')->name('additional-charges-outbound.invoices');

    Route::get('countries', function() {
        return (array) Countries::COUNTRIES;
    });

    Route::group(['prefix' => 'dispatch'], function() {
        Route::get('/', function() {
            return redirect('/home');
        });
        Route::resource('customers', 'CustomerController');
        Route::resource('pickups', 'PickupController');
        Route::put('pickups-update-status/{id}', 'PickupController@updateStatus')->name('pickups.update-status');
        Route::get('import-pickup', 'PickupController@importPickup')->name('pickups.import');
        Route::post('import-pickups', 'PickupController@importPickups')->name('pickups.imports');
        //assignCourier
        Route::put('pickups-assign-courier', 'PickupController@assignCourier');
        Route::put('pickups-set-recurrent-dates/{id}', 'PickupController@setRecurrent');
        Route::post('generate-report', 'PickupController@genReport')->name('pickups.report');
    });
});
