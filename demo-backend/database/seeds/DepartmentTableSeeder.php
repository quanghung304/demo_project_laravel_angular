<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            ['department_id' => 'CS',
                'department_name' => 'Dich vu khach hang'],
            ['department_id' => 'EL',
                'department_name' => 'E-Learning'],
            ['department_id' => 'KD',
                'department_name' => 'Kinh doanh'],
            ['department_id' => 'KT',
                'department_name' => 'Ky thuat'],
            ['department_id' => 'MKT',
                'department_name' => 'Marketing'],
            ['department_id' => 'ND',
                'department_name' => 'Noi dung'],
            ['department_id' => 'NS',
                'department_name' => 'Nhan su'],
            ['department_id' => 'TC',
                'department_name' => 'Tai Chinh']
        ]);
    }
}
