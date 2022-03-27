<?php

namespace App\Http\Controllers;

use App\Employee;
use App\FinanceReport;
use App\SalaryReport;
use App\Services\CandBPolicy;
use App\Services\TaxPolicy;
use Illuminate\Http\Request;

class SalaryReportController extends Controller
{
    //
    public function getAllSalaryReport(){
        return SalaryReport::all();
    }
     public function getSalReportByEmployee($id){
        $salReports = SalaryReport::where(['employee_id' => $id])->get();
        return $salReports;
     }
    public function addSalReport(Request $req, CandBPolicy $cAndBPolicy, TaxPolicy $taxPolicy)
    {
        $checkExist = SalaryReport::where([
            'thang' => $req['thang'],
            'employee_id' => $req['employee_id']
        ])->count();
        if($checkExist) {
            return response()->json(['message' => "Record has been exists"]);
        }
        $salReport = new SalaryReport();
        $salReport->thang = $req->input('thang');
        $salReport->employee_id = $req->input('employee_id');
        $salReport->ngay_cong_chuan = $req->input('ngay_cong_chuan');
        $salReport->ngay_cong_OT = $req->input('ngay_cong_OT');
        $salReport->cong_tac_phi = $req->input('cong_tac_phi');
        $salReport->thuong = $req->input('thuong');
        $salReport->phut_di_muon = $req->input('phut_di_muon');
        $salReport->khoan_tru_khac = $req->input('khoan_tru_khac');
        $checkinInfo = Employee::join('checkin_calendars', 'employees.employee_id', '=', 'checkin_calendars.employee_id')
                        ->select('cong_theo_thang')
                        ->where([
                            'checkin_calendars.thang' => $req['thang'],
                            'checkin_calendars.employee_id' => $req['employee_id']
                        ])->first();
        $salReport->ngay_cong_tinh_luong = $checkinInfo->cong_theo_thang ?? null;
        $salaryInfo = Employee::where(['employee_id' => $req['employee_id']])->first();
        $salReport->luong_theo_ngay_cong = round($salaryInfo->basic_salary / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong);
        $salReport->luong_OT = round($salaryInfo->basic_salary / $salReport->ngay_cong_chuan * $salReport->ngay_cong_OT);
        $salReport->phu_cap_khac = round($salaryInfo->other_allowance / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong);
        $salReport->tru_di_muon = $cAndBPolicy->truDiMuon($salReport->phut_di_muon);
        $salReport->phu_cap_an_trua = round($salaryInfo->lunch_allowance / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong) - $salReport->tru_di_muon;
        $salReport->bao_hiem = $salaryInfo->basic_salary * $salaryInfo->insurance_rate;
        $salReport->tong_thu_nhap = $salReport->luong_theo_ngay_cong + $salReport->luong_OT + $salReport->phu_cap_an_trua + $salReport->phu_cap_khac +  $salReport->cong_tac_phi
                                    + $salReport->thuong -  $salReport->khoan_tru_khac;
        $salReport->tien_an_duoc_mien_thue = $taxPolicy->tienAnMienThue($salReport->phu_cap_an_trua);
        $salReport->luong_OT_duoc_mien_thue = $salReport->luong_OT / 2;
        $salReport->giam_tru_gia_canh = $taxPolicy->giamTruGiaCanh($salaryInfo->dependents_number);
        $salReport->thu_nhap_tinh_thue = $salReport->tong_thu_nhap - $salReport->tien_an_duoc_mien_thue - $salReport->bao_hiem - $salReport->luong_OT_duoc_mien_thue - $salReport->giam_tru_gia_canh;
        $salReport->thue_TNCN = $taxPolicy->thueTNCN($salReport->thu_nhap_tinh_thue);
        $salReport->luong_thuc_nhan = $salReport->tong_thu_nhap - $salReport->thue_TNCN;
        $salReport->save();
//        $financeReport = FinanceReport::where('thang', $req->thang)->first();
//        $financeReport->chi_luong_thang += $salReport->tong_thu_nhap;
//        $financeReport->save();
        return response()->json(['salReport' => $salReport], 201);
    }

    public function updateSalReport(Request $req, CandBPolicy $cAndBPolicy, TaxPolicy $taxPolicy)
    {
        $salReport = SalaryReport::where([
            'thang' => $req['thang'],
            'employee_id' => $req['employee_id']
        ])->first();
        if(!$salReport)
        {
            return response()->json(['message' => "Salary report not found"], 404);
        }
        $salReport->ngay_cong_chuan = $req->input('ngay_cong_chuan');
        $salReport->ngay_cong_OT = $req->input('ngay_cong_OT');
        $salReport->cong_tac_phi = $req->input('cong_tac_phi');
        $salReport->thuong = $req->input('thuong');
        $salReport->phut_di_muon = $req->input('phut_di_muon');
        $salReport->khoan_tru_khac = $req->input('khoan_tru_khac');
        $checkinInfo = Employee::join('checkin_calendars', 'employees.employee_id', '=', 'checkin_calendars.employee_id')
            ->select('cong_theo_thang')
            ->where([
                'checkin_calendars.thang' => $req['thang'],
                'checkin_calendars.employee_id' => $req['employee_id']
            ])->first();
        $salReport->ngay_cong_tinh_luong = $checkinInfo->cong_theo_thang ?? null;
        $salaryInfo = Employee::where(['employee_id' => $req['employee_id']])->first();
        $salReport->luong_theo_ngay_cong = round($salaryInfo->basic_salary / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong);
        $salReport->luong_OT = round($salaryInfo->basic_salary / $salReport->ngay_cong_chuan * $salReport->ngay_cong_OT);
        $salReport->phu_cap_khac = round($salaryInfo->other_allowance / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong);
        $salReport->tru_di_muon = $cAndBPolicy->truDiMuon($salReport->phut_di_muon);
        $salReport->phu_cap_an_trua = round($salaryInfo->lunch_allowance / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong) - $salReport->tru_di_muon;
        $salReport->bao_hiem = $salaryInfo->basic_salary * $salaryInfo->insurance_rate;
        $salReport->tong_thu_nhap = $salReport->luong_theo_ngay_cong + $salReport->luong_OT + $salReport->phu_cap_an_trua + $salReport->phu_cap_khac - $salReport->bao_hiem;
        $salReport->tien_an_duoc_mien_thue = $taxPolicy->tienAnMienThue($salReport->phu_cap_an_trua);
        $salReport->luong_OT_duoc_mien_thue = $salReport->luong_OT / 2;
        $salReport->giam_tru_gia_canh = $taxPolicy->giamTruGiaCanh($salaryInfo->dependents_number);
        $salReport->thu_nhap_tinh_thue = $salReport->tong_thu_nhap - $salReport->tien_an_duoc_mien_thue - $salReport->luong_OT_duoc_mien_thue - $salReport->giam_tru_gia_canh;
        $salReport->thue_TNCN = $taxPolicy->thueTNCN($salReport->thu_nhap_tinh_thue);
        $salReport->luong_thuc_nhan = $salReport->tong_thu_nhap - $salReport->thue_TNCN;
        $salReport->save();
//        $financeReport = FinanceReport::where('thang', $req->thang)->first();
//        $financeReport->chi_luong_thang += $salReport->tong_thu_nhap;
//        $financeReport->save();
        return response()->json(['salReport' => $salReport], 201);
    }
}
