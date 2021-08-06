<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'user',
            'login_id'          => '12345678',
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
