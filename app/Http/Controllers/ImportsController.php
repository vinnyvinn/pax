<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PAX\Models\Courier;
use PAX\Models\Invoice;
use PAX\Models\NonFedexWaybill;
use PAX\Models\Setting;
use PAX\Models\Waybill;

class ImportsController extends Controller
{
    public function receive($waybillId)
    {
        $waybill = NonFedexWaybill::findOrFail($waybillId);

        return view('non-clearance.receive', ['waybill' => $waybill]);
    }

    public function processReception(Request $request, $waybillId)
    {
        $waybill = NonFedexWaybill::findOrFail($waybillId);
        $waybill->update([
            'type' => $request->get('type'),
            'status' => $request->get('type'),
            'current_status' => $request->get('type')
        ]);

        flash('Successfully received shipment.');

        $type = $waybill->category == Waybill::CATEGORY_INBOUND ? 1 : 2;

        return redirect()->route('quote.index', ['type' => $type]);
    }

    public function releaseOrder($waybillId)
    {
        $waybill = NonFedexWaybill::with('manifest')->findOrFail($waybillId);

        return view('reports.release-order')
            ->with('manifest', $waybill->manifest)
            ->with('waybills', [$waybill]);
    }

    public function clearShipment()
    {
        return view('non-clearance.non-clearance');
    }

    public function editClearance($id)
    {
        return view('non-clearance.non-clearance', [
            'id' => $id
        ]);
    }

    public function clearanceInvoices()
    {
        return view('non-clearance.clearance-index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::with(['client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            }])->nonInbound()->proforma()->get());
    }

    public function actualClearanceInvoices()
    {
        return view('non-clearance.clearance-index')
            ->with('currency', Setting::value(Setting::CURRENCY))
            ->with('invoices', Invoice::with(['client' => function ($query) {
                return $query->select('DCLink', 'Name', 'Account');
            }])->nonInbound()->actual()->get());
    }

    public function dispatchWaybill($waybillId)
    {
        $waybill = NonFedexWaybill::findOrFail($waybillId);
        $waybill->update([
            'type' => NonFedexWaybill::RELEASED,
            'status' => NonFedexWaybill::RELEASED,
            'current_status' => NonFedexWaybill::RELEASED
        ]);

        flash('Successfully dispatched shipment.');

        $type = $waybill->category == Waybill::CATEGORY_INBOUND ? 1 : 2;

        return redirect()->route('quote.index', ['type' => $type]);
    }

    public function loadWaybill($waybillId)
    {
        return view('non-clearance.load', [
            'waybill' => NonFedexWaybill::findOrFail($waybillId),
            'couriers' => Courier::all()
        ]);
    }

    public function processLoading(Request $request, $waybillId)
    {
        $waybill = NonFedexWaybill::findOrFail($waybillId);

        $courier = Courier::with(['route'])->find($request->get('courier_id'));

        $waybill->update([
            'status' => NonFedexWaybill::VAN,
            'current_status' => NonFedexWaybill::VAN,
            'courier_id' => $courier->id,
            'route_id' => $courier->route_id,
            'area_code_id' => $courier->route->area_code_id,
        ]);

        flash('Successfully loaded shipment.');

        $type = $waybill->category == Waybill::CATEGORY_INBOUND ? 1 : 2;

        return redirect()->route('quote.index', ['type' => $type]);
    }

    public function processPOD($waybillId)
    {
        $waybill = NonFedexWaybill::findOrFail($waybillId);

        $waybill->update([
            'status' => NonFedexWaybill::POD,
            'current_status' => NonFedexWaybill::POD,
        ]);

        flash('Successfully delivered shipment.');

        $type = $waybill->category == Waybill::CATEGORY_INBOUND ? 1 : 2;

        return redirect()->route('quote.index', ['type' => $type]);
    }

    public function processDEX($waybillId)
    {
        $waybill = NonFedexWaybill::findOrFail($waybillId);

        $waybill->update([
            'status' => NonFedexWaybill::DEX,
            'current_status' => NonFedexWaybill::DEX,
        ]);

        flash('Successfully marked shipment as Delivery Exception.');

        $type = $waybill->category == Waybill::CATEGORY_INBOUND ? 1 : 2;

        return redirect()->route('quote.index', ['type' => $type]);
    }
}
