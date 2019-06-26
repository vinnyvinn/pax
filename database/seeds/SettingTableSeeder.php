<?php

use Illuminate\Database\Seeder;
use PAX\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'key' => Setting::LEVY_RATE,
                'current_value' => '7.5'
            ],
            [
                'key' => Setting::VAT_RATE,
                'current_value' => '16'
            ],
            [
                'key' => Setting::INSURANCE_RATE,
                'current_value' => '1.5'
            ],
            [
                'key' => Setting::PIN_NUMBER,
                'current_value' => 'P051304647Z'
            ],
            [
                'key' => Setting::CURRENCY,
                'current_value' => 'KES'
            ],
            [
                'key' => Setting::PROFORMA_idf,
                'current_value' => '3.5'
            ],
            [
                'key' => Setting::PROFORMA_rdl,
                'current_value' => '0.5'
            ],
            [
                'key' => Setting::PROFORMA_kaa,
                'current_value' => '0.5'
            ],
            [
                'key' => Setting::PROFORMA_vat,
                'current_value' => '16'
            ],
            [
                'key' => Setting::CCK_LEVY,
                'current_value' => '0.3'
            ],
            [
                'key' => Setting::OUTBOUND_DISCOUNT,
                'current_value' => '0'
            ],
            [
                'key' => Setting::OUTBOUND_EXCHANGE_RATE,
                'current_value' => '100'
            ]
        ]);
    }
}
