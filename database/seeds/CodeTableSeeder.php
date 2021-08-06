<?php

use Illuminate\Database\Seeder;

class CodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データのクリア
        DB::table('code_table')->truncate();

        $params =
        [
            ['code_type' => '役職', 'value' => '0', 'caption' => '社長', 'order' => '0'],
            ['code_type' => '役職', 'value' => '1', 'caption' => '副社長', 'order' => '1'],
            ['code_type' => '役職', 'value' => '2', 'caption' => '取締役', 'order' => '2'],
            ['code_type' => '役職', 'value' => '3', 'caption' => '部長', 'order' => '3'],
            ['code_type' => '役職', 'value' => '4', 'caption' => '課長', 'order' => '4'],
            ['code_type' => '役職', 'value' => '5', 'caption' => '社員', 'order' => '5'],
            ['code_type' => '部署', 'value' => '0', 'caption' => '管理部', 'order' => '0'],
            ['code_type' => '部署', 'value' => '1', 'caption' => '営業部', 'order' => '1'],
            ['code_type' => '部署', 'value' => '2', 'caption' => '関東支部', 'order' => '2'],
            ['code_type' => '部署', 'value' => '3', 'caption' => '関西支部', 'order' => '3'],
        ];

        foreach ($params as $param) {
            DB::table('code_table')->insert($param);
        }
    }
}
