<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データのクリア
        DB::table('employees')->truncate();

        DB::table('employees')->insert([
            'employee_id'       => '0001',
            'role'              => '0',
            'department'        => '0',
            'email'             => 'test@test.com',
        ]);
    }
}
