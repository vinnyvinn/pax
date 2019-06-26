<?php

use Illuminate\Database\Seeder;
use PAX\Models\DomesticLocation;

class DomesticRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['name' => 'Nairobi'],
            ['name' => 'Mombasa'],
            ['name' => 'Kisumu'],
            ['name' => 'Eldoret'],
            ['name' => 'Nakuru'],
            ['name' => 'Kericho'],
            ['name' => 'Naivasha'],
            ['name' => 'Malindi'],
            ['name' => 'Diani'],
            ['name' => 'Voi'],
            ['name' => 'Kisii'],
            ['name' => 'Central Zone'],
            ['name' => 'Eastern Zone'],
            ['name' => 'Rift Valley Zone'],
            ['name' => 'Western Zone'],
            ['name' => 'Rest Of Kenya Zone'],
        ];

        foreach ($locations as $location) {
            DomesticLocation::create($location);
        }
    }
}
