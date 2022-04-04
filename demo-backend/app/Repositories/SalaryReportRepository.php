<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\SalaryReport;
use App\Services\CandBPolicy;
use App\Services\TaxPolicy;
use Illuminate\Http\Request;

class SalaryReportRepository
{
    public function checkIfExist(Request $request)
    {
        return SalaryReport::where([
            SalaryReport::_EMPLOYEE_ID => $request->input('employee_id'),
            SalaryReport::_MONTH       => substr($request['month'], 0, 7),
        ])->count();
    }

    public function getAllSalReport()
    {
        return SalaryReport::all();
    }

    public function getSalReportById($id)
    {
        return SalaryReport::where([SalaryReport::_EMPLOYEE_ID => $id])->get();
    }

    public function addsalaryReport(Request $request, CandBPolicy $cAndBPolicy, TaxPolicy $taxPolicy)
    {
        $salaryReport = new SalaryReport();
        $salaryReport->{SalaryReport::_EMPLOYEE_ID}     = $request->input('employee_id');
        $salaryReport->{SalaryReport::_MONTH}           = substr($request->input('month'), 0, 7);
        $salaryReport->{SalaryReport::_NGAY_CONG_CHUAN} = $request->input('ngay_cong_chuan');
        $salaryReport->{SalaryReport::_NGAY_CONG_OT}    = $request->input('ngay_cong_OT');
        $salaryReport->{SalaryReport::_CONG_TAC_PHI}    = $request->input('cong_tac_phi');
        $salaryReport->{SalaryReport::_THUONG}          = $request->input('thuong');
        $salaryReport->{SalaryReport::_PHUT_DI_MUON}    = $request->input('phut_di_muon');
        $salaryReport->{SalaryReport::_KHOAN_TRU_KHAC}  = $request->input('khoan_tru_khac');
//        $salaryReport->{SalaryReport::_NGAY_CONG_TINH_LUONG} = Employee::join('checkin_calendars', 'employees.employee_id', '=', 'checkin_calendars.employee_id')
//            ->where([
//                'checkin_calendars.month' => $request['month'],
//                'checkin_calendars.employee_id' => $request['employee_id']
//            ])->sum('checkin_status');
        $checkinInfo = Employee::join('checkin_calendars', 'employees.employee_id', '=', 'checkin_calendars.employee_id')
            ->select('cong_theo_thang')
            ->where([
                'checkin_calendars.month' => substr($request->input('month'), 0, 7),
                'checkin_calendars.employee_id' => $request['employee_id']
            ])->first();
        $salaryReport->{SalaryReport::_NGAY_CONG_TINH_LUONG} = $checkinInfo->cong_theo_thang;
        $salaryInfo = Employee::where(['employee_id' => $request['employee_id']])->first();
        $salaryReport->{SalaryReport::_LUONG_THEO_NGAY_CONG} = round($salaryInfo->basic_salary / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_tinh_luong);
        $salaryReport->{SalaryReport::_LUONG_OT}             = round($salaryInfo->basic_salary / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_OT);
        $salaryReport->{SalaryReport::_PHU_CAP_KHAC}         = round($salaryInfo->other_allowance / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_tinh_luong);
        $salaryReport->{SalaryReport::_TRU_DI_MUON}          = $cAndBPolicy->truDiMuon($salaryReport->phut_di_muon);
        $salaryReport->{SalaryReport::_PHU_CAP_AN_TRUA}      = round($salaryInfo->lunch_allowance / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_tinh_luong) - $salaryReport->tru_di_muon;
        $salaryReport->{SalaryReport::_BAO_HIEM}             = $salaryInfo->basic_salary * $salaryInfo->insurance_rate;
        $salaryReport->{SalaryReport::_TONG_THU_NHAP}        = $salaryReport->luong_theo_ngay_cong + $salaryReport->luong_OT + $salaryReport->phu_cap_an_trua + $salaryReport->phu_cap_khac +  $salaryReport->cong_tac_phi
                                                        + $salaryReport->thuong -  $salaryReport->khoan_tru_khac;
        $salaryReport->{SalaryReport::_PHU_CAP_MIEN_THUE}    = $taxPolicy->tienAnMienThue($salaryReport->phu_cap_an_trua);
        $salaryReport->{SalaryReport::_LUONG_OT_MIEN_THUE}   = $salaryReport->luong_OT / 2;
        $salaryReport->{SalaryReport::_GIAM_TRU_GIA_CANH}    = $taxPolicy->giamTruGiaCanh($salaryInfo->dependents_number);
        $salaryReport->{SalaryReport::_THU_NHAP_TINH_THUE}   = $salaryReport->tong_thu_nhap - $salaryReport->tien_an_duoc_mien_thue - $salaryReport->bao_hiem - $salaryReport->luong_OT_duoc_mien_thue - $salaryReport->giam_tru_gia_canh;
        $salaryReport->{SalaryReport::_THUE_TNCN}            = $taxPolicy->thueTNCN($salaryReport->thu_nhap_tinh_thue);
        $salaryReport->{SalaryReport::_LUONG_THUC_NHAN}      = $salaryReport->tong_thu_nhap - $salaryReport->thue_TNCN;
        $salaryReport->save();

        return $salaryReport;
    }
}
