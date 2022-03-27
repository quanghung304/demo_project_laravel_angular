<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employee_id')->primary();
            $table->string('fullName');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('department_id');
            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->integer('basic_salary')->default('0');
            $table->integer('lunch_allowance')->default('0');
            $table->integer('other_allowance')->default('0');
            $table->decimal('insurance_rate', $precision = 2, $scale = 1)->default('0.0');
            $table->integer('dependents_number')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
