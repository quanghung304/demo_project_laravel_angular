<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryReport extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'record_code';

    const TABLE = 'salary_reports';

    const _ID                   = 'id';
    const _MONTH                = 'month';
    const _EMPLOYEE_ID          = 'employee_id';
    const _NGAY_CONG_CHUAN      = 'ngay_cong_chuan';
    const _NGAY_CONG_TINH_LUONG = 'ngay_cong_tinh_luong';
    const _NGAY_CONG_OT         = 'ngay_cong_OT';
    const _CONG_TAC_PHI         = 'cong_tac_phi';
    const _THUONG               = 'thuong';
    const _PHUT_DI_MUON         = 'phut_di_muon';
    const _LUONG_THEO_NGAY_CONG = 'luong_theo_ngay_cong';
    const _LUONG_OT             = 'luong_OT';
    const _PHU_CAP_AN_TRUA      = 'phu_cap_an_trua';
    const _PHU_CAP_KHAC         = 'phu_cap_khac';
    const _TRU_DI_MUON          = 'tru_di_muon';
    const _KHOAN_TRU_KHAC       = 'khoan_tru_khac';
    const _TONG_THU_NHAP        = 'tong_thu_nhap';
    const _LUONG_OT_MIEN_THUE   = 'luong_OT_duoc_mien_thue';
    const _PHU_CAP_MIEN_THUE    = 'tien_an_duoc_mien_thue';
    const _BAO_HIEM             = 'bao_hiem';
    const _GIAM_TRU_GIA_CANH    = 'giam_tru_gia_canh';
    const _THU_NHAP_TINH_THUE   = 'thu_nhap_tinh_thue';
    const _THUE_TNCN            = 'thue_TNCN';
    const _LUONG_THUC_NHAN      = 'luong_thuc_nhan';
}
