<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use PAX\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Create Inbound Shipments', 'View Inbound Shipments', 'Edit Inbound Shipments', 'Delete Inbound Shipments',
            'Create Inbound Waybills', 'View Inbound Waybills', 'Edit Inbound Waybills', 'Delete Inbound Waybills',
            'Import Scan 65', 'Import Scan 71', 'Import Scan 72', 'Import Van Scan', 'Import POD Scan',
            'Import DEX Scan', 'Generate Release Orders',
            'Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice',
            'Delete Clearance Invoice', 'Finalize Clearance Invoice',
            'Create Agent Clearance Invoice', 'View Agent Clearance Invoice', 'Edit Agent Clearance Invoice',
            'Delete Agent Clearance Invoice', 'Finalize Agent Clearance Invoice',
            'Create Inbound Freight Invoice', 'View Inbound Freight Invoice', 'Edit Inbound Freight Invoice',
            'Delete Inbound Freight Invoice', 'Finalize Inbound Freight Invoice',

            'Create Outbound Shipments', 'View Outbound Shipments', 'Edit Outbound Shipments', 'Delete Outbound Shipments',
            'Create Outbound Waybills', 'View Outbound Waybills', 'Edit Outbound Waybills', 'Delete Outbound Waybills',
            'Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice',
            'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice',

            'Create Domestic Shipments', 'View Domestic Shipments', 'Edit Domestic Shipments', 'Delete Domestic Shipments',
            'Finalize Domestic Shipments',
            'Create Domestic Freight Invoice', 'View Domestic Freight Invoice', 'Edit Domestic Freight Invoice',
            'Delete Domestic Freight Invoice', 'Finalize Domestic Freight Invoice',

            'Create Cities', 'View Cities', 'Edit Cities', 'Delete Cities',
            'Create Area Codes', 'View Area Codes', 'Edit Area Codes', 'Delete Area Codes',
            'Create Routes', 'View Routes', 'Edit Routes', 'Delete Routes',
            'Create Couriers', 'View Couriers', 'Edit Couriers', 'Delete Couriers',
            'Create CBV', 'View CBV', 'Edit CBV', 'Delete CBV',
            'Create Domestic Locations', 'View Domestic Locations', 'Edit Domestic Locations',
            'Delete Domestic Locations', 'Edit Domestic Rates',
            'View Outbound Rate Card', 'Edit Outbound Rate Card',
            'View Outbound Zones', 'Edit Outbound Zones', 'Create Outbound Zones', 'Delete Outbound Zones',
            'Create Users', 'View Users', 'Edit Users', 'Delete Users',
            'View Settings', 'View NFBRK report', 'View ODA report', 'Update clearing agent',
            
            'Create Pickup', 'View Pickups', 'update pickup', 'View TNT Pickups', 'View FEDEX Pickups', 'View Recurrent Pickups',
            'View Not Assigned Pickups', 'View Assigned Pickups', 'View Delayed Pickups',
            'View Done Pickups', 'View Cancelled Pickups', 'Assign Courier Pickup', 'Update Status Pickups',

            'View Non-Fedex Portal', 'View Inbound Non-Fedex', 'View Outbound Non-Fedex', 'Create Inbound Qoute Non-FEDEX',
            'Create Outbound Quote Non-FEDEX', 'Generate Invoice Clearance Non-FEDEX', 'View Proforma Clearance Non-FEDEX',
            'View Invoices Clearance Non-FEDEX', 'Generate Proforma Inbound Freight Non-FEDEX', 'Generate Invoice Inbound Freight Non-FEDEX',
            'Generate Proforma Outbound Freight', 'Generate Invoice Outbound Freight',
        ];
        $permissions = array_map(function ($permission) {
            return [
                'name' => $permission,
                'slug' => str_slug($permission),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $permissions);

        Permission::insert($permissions);
    }
}
