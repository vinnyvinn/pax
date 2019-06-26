<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PickupRequest;
use PAX\Models\Pickup;
use PAX\Models\RecurrentPickup;
use PAX\Models\Courier;
use function flash;
use Carbon\Carbon;
use PAX\SMS\SmsInterface;
use PAX\Processor\PickupProcessor;
use Validator;
use PAX\Processor\PickupReport;
use PAX\Models\Client;
use Maatwebsite\Excel\Facades\Excel;

class PickupController extends Controller
{
    //
    protected $smsHelper;
    /**
     * sms helper instance
     */
    public function __construct(SmsInterface $smsHelper) 
    {
        $this->smsHelper = $smsHelper;
    }
    /**
     * pickups dashboard
     */
    public function index() 
    {
        $data = [];
        $data['pickupsAll'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', false)->latest()->get();
        $data['pickupsRecurrent'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 1)->latest()->get();
        $data['pickupsPending'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_pending)->latest()->get();
        $data['pickupsPosted'] =  Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_pending)->latest()->get();
        $data['pickupsAssigned'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_assigned)->latest()->get();
        $data['pickupCollected'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_collected)->latest()->get();
        $data['pickupMissed'] = Pickup::with(['courier', 'days', 'client'])->missed()->latest()->get();
        $data['pickupOver60'] = Pickup::with(['courier', 'days', 'client'])->over60()->latest()->get();
        $data['pickupDone'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_done)->latest()->get();
        $data['pickupCancelled'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_cancelled)->latest()->get();
        $data['pickupTNT'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->tnt()->latest()->get();
        $data['pickupFEDEX'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->fedex()->latest()->get();
        $data['pickupRescheduled'] = Pickup::with(['courier', 'days', 'client'])->where('recurrent', 0)->where('status', \PAX\Models\Pickup::STATUS_rescheduled)->latest()->get();

        return view('dispatch.pickups.index', $data);
    }
    /**
     * create page of the pickup
     */
    public function create() 
    {
        return view('dispatch.pickups.create', ['pickup' => new Pickup, 'clients' => Client::select('account', 'name', 'DCLink')->get() ]);
    }
    /**
     * import pickup
     */
    public function importPickup(Request $request)
    {
        return view('dispatch.pickups.import', ['type' => $request->input('type')]);
    }
    /**
     * store new pickup
     */
    public function store(PickupRequest $request) 
    {
        $data = $request->all();
        $data['pickup_date'] = Carbon::parse($request->get('pickup_date'));
        $data['pickup_no'] = $this->pickupNo();
        $data['cash_collect'] = $data['cash_collect'] ?: 0;
        Pickup::create($data);
        flash('Pick up successfully added');

        return redirect()->route('pickups.index');
    }
    /**
     * show pickup details
     */
    public function show($id) 
    {
        $pickup = Pickup::with(['courier', 'client'])->findOrFail($id);

        return view('dispatch.pickups.show', ['pickup' => $pickup]);
    }
    /**
     * edit page of the pickup
     */
    public function edit($id) 
    {
        $pickup = Pickup::findOrFail($id);
        return view('dispatch.pickups.create', ['pickup' => $pickup, 'clients' => Client::select('account', 'name', 'DCLink')->get() ]);
    }
    /**
     * update the pickup details
     */
    public function update(PickupRequest $request, $id) 
    {
        $data = $request->all();
        $data['pickup_date'] = Carbon::parse($request->get('pickup_date'));
        $data['pickup_no'] = $request->pickup_no ?: $this->pickupNo();
        $data['cash_collect'] = $request->cash_collect ?: 0;
        $pickup = Pickup::findOrfail($id);
        $pickup->update($data);
        flash('Pick up successfully updated');

        return redirect()->route('pickups.index');
    }
    public function destroy($id)
    {
        $data = Pickup::findOrFail($id);

        $data->delete();

        flash('Pick up successfully deleted');

        return redirect()->back();
    }
    /**
     * set the status of the pickup
     */
    public function updateStatus(Request $request, $id) 
    {
        if(!$pickup = Pickup::find($id)) {
            flash('invalid pickup to be updated.');

            return redirect()->route('pickups.index');
        }
        $data = $request->all();
        if($data['status'] == Pickup::STATUS_done && array_key_exists('comment', $data)) {
            $data['done_comment'] = $data['comment'];
        }
        if($data['status'] == Pickup::STATUS_cancelled && array_key_exists('comment', $data)) {
            $data['cancel_comment'] = $data['comment'];
        }
        if ($data['status'] == Pickup::STATUS_rescheduled) {
            $data['pickup_date'] = Carbon::parse($data['pickup_date']);
        }
        $pickup->update($data);
        flash('Status updated successfully.');

        return redirect()->route('pickups.index');
    }
    /**
     * assign courier to the pickup
     */
    public function assignCourier(Request $request) 
    {
        if(!$pickup = Pickup::find($request->get('id'))) {

            return response()->json([
                'message' => 'Invalid pickup, refresh and try again'
            ], 500);
        }
        $courierId = $request->get('courier_id');
        if(!$courier = Courier::find($courierId)) {

            return response()->json([
                'message' => 'No such courier, refresh and try again'
            ], 500);
        }

        $text = $pickup->company_name." - pickup ";
        $text .= $pickup->address."". $pickup->type.".";
        $text .= "Number of packages ".$pickup->no_packages." \n";
        $text .= ", ".$pickup->contact_name." @ ".$pickup->contact_phone.".";

        $this->smsHelper->to($courier->phone)->message($text)->send();
        $pickup->update([
            'courier_id' => $courierId,
            'status' => Pickup::STATUS_assigned
        ]);
        
        return response()->json([
            'message' => 'courier assigned successfully'
        ], 200);
    }
    /**
     * set recurrent days
     * 
     */
    public function setRecurrent(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'ready_time' => 'required'
        ]);
        if($validator->fails()) {
            
            return response()->json([
                'message' => 'ready time is required'
            ], 400);
        }
        if(!$pickup = Pickup::find($id)) {

            return response()->json([
                'message' => 'Invalid pickup, refresh and start again'
            ], 500);
        }
        $days = $request->get('days');
        if(!$days && count($days)) {

            return response()->json([
                'message' => 'Invalid pickup, refresh and start again'
            ], 500);
        }
        $days['pickup_id'] = $id;
        $pickup->update(['ready_time' => $request->get('ready_time')]);
        if(!$recurrentPickup = RecurrentPickup::where('pickup_id', $id)->first()) {
            RecurrentPickup::create($days);
        }
        else {
            $recurrentPickup->update($days);
        }

        return response()->json([
            'message' => 'recurrrent days set successfully'
        ], 201);
    }
    /**
     * import pickups
     */
    public function importPickups(Request $request)
    {
        if($request->type == Pickup::TYPE_tnt) {
            $this->importTNT($request);
            session('flash_status', 'success');
            session('flash_message', 'Pickups imported successfully.');

            return redirect()->route('pickups.index');
        }

        return PickupProcessor::process($request);
    }
    public function genReport(Request $request) 
    {
      return (new PickupReport($request))->generate();
    }
    private function pickupNo() 
    {
        return str_pad(mt_rand(0, 1000000000), 9, '0', STR_PAD_LEFT);
    }
    private function importTNT($request)
    {
       $data = Excel::selectSheetsByIndex(0)->load($request->file('pickups'))->get([
        'order', 'date', 'weight', 'caller_name', 'customer_name', 'city', 'address_line_1', 'items', 'open_1', 'close_1', 'open_2', 'close_2'
        ]);

        $fData = $data->filter(function($item, $key) {
            if(isset($item['order']) && isset($item['date']) && isset($item['weight']) && isset($item['caller_name'])
             && isset($item['customer_name']) && isset($item['open_1']) && isset($item['close_1'])) {

                    return true;
            }
        })->filter(function($item, $key) {
            $pickupNos = array_map(function($pickup) { return $pickup['pickup_no']; },Pickup::select('pickup_no')->get()->toArray());
            if(!in_array($item['order'], $pickupNos)) {

                return true;
            }

        })->toArray();

        foreach ($fData as $pickup) {
            $pickup['pickup_no'] = $pickup['order'];
            $pickup['pickup_date'] = $pickup['date'];
            $pickup['expected_weight'] = $pickup['weight'];
            $pickup['contact_name'] = $pickup['caller_name'];
            $pickup['contact_phone'] = 0;
            $pickup['company_name'] = $pickup['customer_name'];
            $pickup['type'] = Pickup::TYPE_tnt;
            $pickup['bill_company'] = Pickup::BILL_TNT;
            $pickup['no_packages'] = $pickup['items'];
            $pickup['address'] = $pickup['address_line_1'].', '.$pickup['city'];
            $pickup['ready_time'] = $pickup['open_1']->toTimeString();
            $pickup['close_time'] = isset($pickup['close_2']) && $pickup['close_2'] ?  $pickup['close_2']->toTimeString() : $pickup['close_1']->toTimeString();

            Pickup::create($pickup);
        }
    }
}
