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
        // データのクリア
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name_kana'         => 'ユーザー',
            'name_roma'         => 'user',
            'member_id'         => '0001',
            'login_id'          => '12345678',
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
