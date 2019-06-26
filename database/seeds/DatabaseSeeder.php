<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PassportSeeder::class);
         $this->call(SettingTableSeeder::class);
         $this->call(DomesticRatesSeeder::class);
         $this->call(PermissionSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(RateCardSeeder::class);
    }
}
