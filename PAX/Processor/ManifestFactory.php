<?php

namespace PAX\Processor;

use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use PAX\Models\CBV;
use PAX\Models\Courier;
use PAX\Models\Manifest;
use PAX\Models\Waybill;
use PAX\Support\Currencies;
use function PHPSTORM_META\map;
use Swap\Laravel\Facades\Swap;

class ManifestFactory
{
    public static function importManifest(Request $request, $outbound = false)
    {
        $file = $request->file('uploaded_file');

        try {
            self::processManifest($request, $file, $outbound);
        } catch (Exception $ex) {

            \Log::info('error 2 - '. $ex->getMessage());
            return false;
        }

        return true;
    }

    private static function processManifest(Request $request, $file, $outbound)
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '1024M');

        DB::transaction(function () use ($request, $file, $outbound) {
            $data = $request->all();
            $data['flight_number'] = strtoupper($data['flight_number']);

            if ($outbound) {
                $data['type'] = Manifest::OUTBOUND;
            }

            if (isset($data['cbv_id'])) {
                $cbv = CBV::findOrFail($data['cbv_id']);

                $data['cbv_number'] = $cbv->number;
                $data['cbv_rate'] = $cbv->rate;

                $cbv->used = true;
                $cbv->used_on = Carbon::now();
                $cbv->save();
            }

            $manifest = Manifest::create($data);

            $manifestId = $manifest->id;
            $rows = self::getRows($file, $manifestId);

            $waybill = new Waybill;
            
            foreach ($rows as $row) {
                $row = $waybill->filterFillable($row);
                $row['city_id'] = $data['city_id'];
                $row['actual_weight'] = Waybill::getKGs($row['weight']);
                $row['category'] = $outbound ? Waybill::CATEGORY_OUTBOUND : Waybill::CATEGORY_INBOUND;

                if (! $row['waybill_number'] || ! $row['shipped_date'] ||  ! $row['origin']) {
                    continue;
                }

                $row['conversion_rate'] = 1;
		        $row['waybill_number'] = (string) $row['waybill_number'];
                foreach ($row as $index => $column) {
                    if ($column == '-') {
                        $row[$index] = null;
                    }
                }
                
                try {
                    if ($row['currency'] != 'CAD' && $row['currency'] != 'USD') {
                        $base = Currencies::getBase($row['currency']);
                        $rate = Swap::latest('USD/'.$base);
                        
                        $row['conversion_rate'] = 1/$rate->getValue();
                    }
                    if($row['currency'] == 'CAD') {
                        $row['conversion_rate'] = 0.76;
                    }
                } catch (Exception $ex) {
                    //
                    \Log::info('error --- '. $ex->getMessage());
               }

                $row['usd_value'] = $row['value'] * $row['conversion_rate'];
               
                $row['project_id'] = self::createProject($row);
                Waybill::insert($row);
            }
        });
    }

    /**
     * @param $file
     * @param $manifestId
     *
     * @return array
     */
    private static function getRows($file, $manifestId)
    {
        $rows = Excel::prepare($file)
            ->usingHeaders([
                'waybill_number', 'crn_number', 'origin', 'destination', 'origin_city', 'export_city', 'shipped_date',
                'con_account',
                'con_phone', 'con_company', 'con_name', 'con_address', 'con_address_alternate', 'con_city', 'con_state',
                'con_country', 'con_postal', 'shipper_account',
                'shipper_phone', 'shipper_company', 'shipper_name', 'shipper_address',
                'shipper_address_alternate', 'shipper_city', 'shipper_state', 'shipper_country', 'shipper_postal',
                'broker_name', 'broker_phone', 'broker_city', 'broker_country', 'broker_customs_id', 'service',
                'service_new', 'package_type',
                'bill_to', 'bill_duty', 'total', 'weight', 'currency', 'value', 'ndr', 'description', 'offl_use'
            ])
            ->withDates(['shipped_date'])
            ->includeColumns([
                'manifest_id' => $manifestId,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ])
            ->get();

        return $rows;
    }
    private static function getRows7172($file, $manifestId)
    {
        $rows = Excel::prepare($file)
            ->usingHeaders([
                'tracking_number', 'crn_number', 'origin', 'destination', 'origin_city', 'export_city', 'shipped_date',
                'con_account',
                'con_phone', 'con_company', 'con_name', 'con_address', 'con_address_alternate', 'con_city', 'con_state',
                'con_country', 'con_postal', 'shipper_account',
                'shipper_phone', 'shipper_company', 'shipper_name', 'shipper_address',
                'shipper_address_alternate', 'shipper_city', 'shipper_state', 'shipper_country', 'shipper_postal',
                'broker_name', 'broker_phone', 'broker_city', 'broker_country', 'broker_customs_id', 'service',
                'service_new', 'package_type',
                'bill_to', 'bill_duty', 'total', 'weight', 'currency', 'value', 'ndr', 'description', 'offl_use'
            ])
            ->withDates(['shipped_date'])
            ->includeColumns([
                'manifest_id' => $manifestId,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()
            ])
            ->get();

        return $rows;
    }

    public static function processScan(Request $request, $type)
    {
        $rows = self::getRows7172($request->file('uploaded_file'), $request->get('manifest_id'));

        $existingWB = Waybill::get(['waybill_number'])->toArray();
        $eWB = array_map(function($wb) {

                return $wb['waybill_number'];
        }, $existingWB);
        $overages = collect($eWB)->map(function($e) use($eWB, $rows) {
            foreach ($rows as $row) {
                if($row['tracking_number'] && !in_array($row['tracking_number'], $eWB)) {
                    $data = $row;
                    $data['overage'] = 1;
                    $data['waybill_number'] = $row['tracking_number'];

                    return $data;
                }
            }
        })->reject(function($e) {
            return !$e;
        })->unique();
        $waybill = new Waybill;
        foreach ($overages->toArray() as $row) {
                $row = $waybill->filterFillable($row);
                $row['actual_weight'] = Waybill::getKGs($row['weight']);
                $row['category'] = Waybill::CATEGORY_INBOUND;

                if (! $row['waybill_number'] || ! $row['shipped_date'] ||  ! $row['origin']) {
                    continue;
                }

                $row['conversion_rate'] = 1;

                foreach ($row as $index => $column) {
                    if ($column == '-') {
                        $row[$index] = null;
                    }
                }

                try {
                    if ($row['currency'] != 'CAD' && $row['currency'] != 'USD') {
                        $base = Currencies::getBase($row['currency']);
                        $rate = Swap::latest('USD/'.$base);
                        
                        $row['conversion_rate'] = 1/$rate->getValue();
                    }
                    if($row['currency'] == 'CAD') {
                        $row['conversion_rate'] = 0.76;
                    }
                } catch (Exception $ex) {
                    //
                    \Log::info('error --- '. $ex->getMessage());
                }

                $row['usd_value'] = $row['value'] * $row['conversion_rate'];
                $row['project_id'] = self::createProject($row);

                Waybill::create($row);
        }
        $itemType = Waybill::NON_DUTIABLE;

        $billingDate = null;

        if ($type == 71 || $type == 72) {
            $itemType = $type;
            $billingDate = Carbon::now();
        }

        $toUpdate = [
            'status' => $type,
            'type' => $itemType,
            'current_status' => $type
        ];

        if ($billingDate) {
            $toUpdate['initial_billing_time'] = $billingDate;
        }
        Waybill::where('manifest_id', $request->get('manifest_id'))
            ->whereIn('waybill_number', array_map(function($r) {
                return $r['tracking_number'];
            }, $rows))->update($toUpdate);

        return true;
    }

    public static function processVanScan(Request $request)
    {
        $headers = [
            'waybill_number', 'fedex_id', 'scan_date', 'van_type', 'received_from', 'given_to'
        ];

        $rows = collect(self::getRowsFromFile($request->file('uploaded_file'), $headers))
            ->groupBy('fedex_id');

        foreach ($rows as $user => $row) {
            $courier = Courier::with(['route'])->where('fedex_id', $user)->first();
            if (! $courier) {
                continue;
            }
            $row = $row->map(function ($item) {
                return (int) $item['tracking_number'];
            })->toArray();

            Waybill::where('manifest_id', $request->get('manifest_id'))
                ->whereIn('waybill_number', $row)->update([
                    'status' => Manifest::VAN,
                    'current_status' => Manifest::VAN,
                    'courier_id' => $courier->id,
                    'route_id' => $courier->route_id,
                    'area_code_id' => $courier->route->area_code_id,
                ]);
        }

        return true;
    }

    public static function processDEXScan(Request $request)
    {
        $headers = [
            'tracking_number', 'service_code', 'comment', 'recipient', 'location', 're_attempt', 'scan', 'last_scan'
        ];

        $rows = self::getScanRows($request->file('uploaded_file'), $headers);

        Waybill::where('manifest_id', $request->get('manifest_id'))
            ->whereIn('waybill_number', $rows)->update([
                'status' => Manifest::DEX,
                'current_status' => Manifest::DEX
            ]);

        return true;
    }

    public static function processPODScan(Request $request)
    {
        $rows = Excel::prepare($request->file('uploaded_file'))
            ->withHeaderRow(3)
            ->usingHeaders([
                'empty', 'waybill_number', 'master_number', 'is_master', 'Isipd', 'Ismde', 'Route', 'Pod',
                'Pod', 'Country', 'Location', 'Docnondoc', 'Isec', 'Signature'
            ])
            ->get();

        $rows = array_map(function ($item) {
            return $item['tracking_number'];
        }, $rows);

        Waybill::where('manifest_id', $request->get('manifest_id'))
            ->whereIn('waybill_number', $rows)->update([
                'status' => Manifest::POD,
                'current_status' => Manifest::POD
            ]);

        return true;
    }
    public static function processODAScan(Request $request)
    {
        $rows = Excel::prepare($request->file('uploaded_file'))
            ->usingHeaders([
                'empty', 'tracking_number', 'master_number', 'is_master', 'Isipd', 'Ismde', 'Route', 'Pod',
                'Pod', 'Country', 'Location', 'Docnondoc', 'Isec', 'Signature'
            ])
            ->get();

        $rows = array_map(function ($item) {
            return $item['tracking_number'];
        }, $rows);

        Waybill::where('manifest_id', $request->get('manifest_id'))
            ->whereIn('waybill_number', $rows)->update([
                'oda' => 1
            ]);

        return true;
    }

    private static function getScanRows(UploadedFile $file, $headers = ['tracking_number', 'con_name', 'scan_date', 'last_scan'], $rows = null)
    {
        if (! $rows) {
            $rows = self::getRowsFromFile($file, $headers);
        }
        return array_map(function ($item) {

            return (string) $item['tracking_number'];
        }, $rows);

    }

    private static function getRowsFromFile(UploadedFile $file, $headers = ['waybill_number', 'con_name', 'scan_date', 'last_scan'])
    {
        return Excel::prepare($file)
            ->usingHeaders($headers)
            ->get();
    }

    public static function createProject($attributes)
    {
        $values = implode(',', self::mapSAGEProjectFields($attributes));
        DB::raw('
        SET IDENTITY_INSERT Project ON;
        INSERT INTO Project(ProjectLink, SubProjectOfLink, ActiveProject, ProjectLevel, Project_iBranchID,
        ProjectCode, ProjectName, ProjectDescription, MasterSubProject) VALUES('.$values.');
        SET IDENTITY_INSERT Project OFF;
        ');

        return self::mapSAGEProjectFields($attributes)[0];
    }

    private static function mapSAGEProjectFields($fields)
    {
        $masterProject = config('pax.main_project');

        $master = DB::table('Project')->where('ProjectLink', $masterProject)->first();

        if (! $master) {
            abort(404);
        }

        return [
             $masterProject,
             $masterProject,
             1,
             2,
             0,
            $fields['waybill_number'],
            $fields['waybill_number'],
            $fields['waybill_number'] . ' of value ' .
                $fields['currency'] . $fields['value'],
            $master->ProjectCode . '>' . $fields['waybill_number'],
        ];
    }
}
