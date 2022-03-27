<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->string('department_id');
            $table->index('department_id');
            $table->string('department_name');
        });

        $data = [
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
        ];

        DB::table('departments')->insert($data);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
