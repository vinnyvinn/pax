<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Superuser',
            'email' => 'development@wizag.biz',
            'password' => bcrypt(123456),
            'permissions' => json_encode(['*']),
        ]);
    }
}
