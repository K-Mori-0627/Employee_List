<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データのクリア
        DB::table('members')->truncate();

        DB::table('members')->insert([
            'member_id'         => '001',
            'role'              => '0',
            'department'        => '0',
            'email'             => 'test@test.com'
        ]);
    }
}
