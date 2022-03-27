<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('thang');
            $table->string('employee_id')->default('NV');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->integer('ngay_cong_chuan')->default('20');
            $table->decimal('ngay_cong_tinh_luong', $precision = 3, $scale = 1);
            $table->integer('ngay_cong_OT')->nullable();
            $table->integer('cong_tac_phi')->nullable();
            $table->integer('thuong')->nullable();
            $table->integer('phut_di_muon')->nullable();
            $table->integer('luong_theo_ngay_cong')->nullable();
            $table->integer('luong_OT')->nullable();
            $table->integer('phu_cap_an_trua')->nullable();
            $table->integer('phu_cap_khac')->nullable();
            $table->integer('tru_di_muon')->nullable();
            $table->integer('khoan_tru_khac')->nullable();
            $table->integer('tong_thu_nhap')->nullable();
            $table->integer('luong_OT_duoc_mien_thue')->nullable();
            $table->integer('tien_an_duoc_mien_thue')->nullable();
            $table->integer('bao_hiem')->nullable();
            $table->integer('giam_tru_gia_canh')->nullable();
            $table->integer('thu_nhap_tinh_thue')->nullable();
            $table->integer('thue_TNCN')->nullable();
            $table->integer('luong_thuc_nhan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_reports');
    }
}
