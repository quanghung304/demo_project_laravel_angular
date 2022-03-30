<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkin_calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('thang');
            $table->string('employee_id')->nullable();
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('set null');
            $table->double('cong_theo_thang', $precision = 3, $scale = 1)->default('00.0');
            $table->double('day_1', $precision = 2, $scale = 1)->nullable();
            $table->double('day_2', $precision = 2, $scale = 1)->nullable();
            $table->double('day_3', $precision = 2, $scale = 1)->nullable();
            $table->double('day_4', $precision = 2, $scale = 1)->nullable();
            $table->double('day_5', $precision = 2, $scale = 1)->nullable();
            $table->double('day_6', $precision = 2, $scale = 1)->nullable();
            $table->double('day_7', $precision = 2, $scale = 1)->nullable();
            $table->double('day_8', $precision = 2, $scale = 1)->nullable();
            $table->double('day_9', $precision = 2, $scale = 1)->nullable();
            $table->double('day_10', $precision = 2, $scale = 1)->nullable();
            $table->double('day_11', $precision = 2, $scale = 1)->nullable();
            $table->double('day_12', $precision = 2, $scale = 1)->nullable();
            $table->double('day_13', $precision = 2, $scale = 1)->nullable();
            $table->double('day_14', $precision = 2, $scale = 1)->nullable();
            $table->double('day_15', $precision = 2, $scale = 1)->nullable();
            $table->double('day_16', $precision = 2, $scale = 1)->nullable();
            $table->double('day_17', $precision = 2, $scale = 1)->nullable();
            $table->double('day_18', $precision = 2, $scale = 1)->nullable();
            $table->double('day_19', $precision = 2, $scale = 1)->nullable();
            $table->double('day_20', $precision = 2, $scale = 1)->nullable();
            $table->double('day_21', $precision = 2, $scale = 1)->nullable();
            $table->double('day_22', $precision = 2, $scale = 1)->nullable();
            $table->double('day_23', $precision = 2, $scale = 1)->nullable();
            $table->double('day_24', $precision = 2, $scale = 1)->nullable();
            $table->double('day_25', $precision = 2, $scale = 1)->nullable();
            $table->double('day_26', $precision = 2, $scale = 1)->nullable();
            $table->double('day_27', $precision = 2, $scale = 1)->nullable();
            $table->double('day_28', $precision = 2, $scale = 1)->nullable();
            $table->double('day_29', $precision = 2, $scale = 1)->nullable();
            $table->double('day_30', $precision = 2, $scale = 1)->nullable();
            $table->double('day_31', $precision = 2, $scale = 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkin_calendars');
    }
}
