<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryReport;
use App\Services\CandBPolicy;
use App\Services\TaxPolicy;
use App\Repositories\SalaryReportRepository;
use Illuminate\Http\Request;

class SalaryReportController extends Controller
{
    private $salReportRepo;

    /**
     * @param $salReportRepo
     */
    public function __construct(SalaryReportRepository $salReportRepo)
    {
        $this->salReportRepo = $salReportRepo;
    }

    public function getAllSalaryReport()
    {
        return $this->salReportRepo->getAllSalReport();
    }

     public function getSalReportByEmployee($id)
     {
        return $this->salReportRepo->getSalReportById($id);
     }

    public function addSalReport(Request $request, CandBPolicy $cAndBPolicy, TaxPolicy $taxPolicy)
    {
        $checkExist = $this->salReportRepo->checkIfExist($request);
        if ($checkExist) {
            return response()->json(['message' => "Record has been exists"], 404);
        } else {
//        $salaryReport = $this->salReportRepo->addsalaryReport($request, $cAndBPolicy, $taxPolicy);
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
                    'checkin_calendars.month' => substr($request->input('month'), 0, 7)
                ])->first();
            $salaryReport->{SalaryReport::_NGAY_CONG_TINH_LUONG} = $checkinInfo->cong_theo_thang;
            $salaryInfo = Employee::where(['employee_id' => $request['employee_id']])->first();
            $salaryReport->{SalaryReport::_LUONG_THEO_NGAY_CONG} = round($salaryInfo->basic_salary / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_tinh_luong);
            $salaryReport->{SalaryReport::_LUONG_OT}             = round($salaryInfo->basic_salary / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_OT);
            $salaryReport->{SalaryReport::_PHU_CAP_KHAC}         = round($salaryInfo->other_allowance / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_tinh_luong);
            $salaryReport->{SalaryReport::_TRU_DI_MUON}          = $cAndBPolicy->truDiMuon($salaryReport->phut_di_muon);
            $salaryReport->{SalaryReport::_PHU_CAP_AN_TRUA}      = round($salaryInfo->lunch_allowance / $salaryReport->ngay_cong_chuan * $salaryReport->ngay_cong_tinh_luong) - $salaryReport->tru_di_muon;
            $salaryReport->{SalaryReport::_BAO_HIEM}             = $salaryInfo->basic_salary * $salaryInfo->insurance_rate;
            $salaryReport->{SalaryReport::_TONG_THU_NHAP}        = $salaryReport->luong_theo_ngay_cong + $salaryReport->luong_OT + $salaryReport->phu_cap_an_trua + $salaryReport->phu_cap_khac + $salaryReport->cong_tac_phi
                + $salaryReport->thuong - $salaryReport->khoan_tru_khac;
            $salaryReport->{SalaryReport::_PHU_CAP_MIEN_THUE}    = $taxPolicy->tienAnMienThue($salaryReport->phu_cap_an_trua);
            $salaryReport->{SalaryReport::_LUONG_OT_MIEN_THUE}   = $salaryReport->luong_OT / 2;
            $salaryReport->{SalaryReport::_GIAM_TRU_GIA_CANH}    = $taxPolicy->giamTruGiaCanh($salaryInfo->dependents_number);
            $salaryReport->{SalaryReport::_THU_NHAP_TINH_THUE}   = $salaryReport->tong_thu_nhap - $salaryReport->tien_an_duoc_mien_thue - $salaryReport->bao_hiem - $salaryReport->luong_OT_duoc_mien_thue - $salaryReport->giam_tru_gia_canh;
            $salaryReport->{SalaryReport::_THUE_TNCN}            = $taxPolicy->thueTNCN($salaryReport->thu_nhap_tinh_thue);
            $salaryReport->{SalaryReport::_LUONG_THUC_NHAN}      = $salaryReport->tong_thu_nhap - $salaryReport->thue_TNCN;
            $salaryReport->save();

            return response()->json(['salReport' => $salaryReport], 201);
        }
    }

//    public function updateSalReport(Request $req, CandBPolicy $cAndBPolicy, TaxPolicy $taxPolicy)
//    {
//        $salReport = SalaryReport::where([
//            'thang' => $req['thang'],
//            'employee_id' => $req['employee_id']
//        ])->first();
//        if (!$salReport)
//        {
//            return response()->json(['message' => "Salary report not found"], 404);
//        }
//        $salReport->ngay_cong_chuan = $req->input('ngay_cong_chuan');
//        $salReport->ngay_cong_OT = $req->input('ngay_cong_OT');
//        $salReport->cong_tac_phi = $req->input('cong_tac_phi');
//        $salReport->thuong = $req->input('thuong');
//        $salReport->phut_di_muon = $req->input('phut_di_muon');
//        $salReport->khoan_tru_khac = $req->input('khoan_tru_khac');
//        $checkinInfo = Employee::join('checkin_calendars', 'employees.employee_id', '=', 'checkin_calendars.employee_id')
//            ->select('cong_theo_thang')
//            ->where([
//                'checkin_calendars.thang' => $req['thang'],
//                'checkin_calendars.employee_id' => $req['employee_id']
//            ])->first();
//        $salReport->ngay_cong_tinh_luong = $checkinInfo->cong_theo_thang ?? null;
//        $salaryInfo = Employee::where(['employee_id' => $req['employee_id']])->first();
//        $salReport->luong_theo_ngay_cong = round($salaryInfo->basic_salary / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong);
//        $salReport->luong_OT = round($salaryInfo->basic_salary / $salReport->ngay_cong_chuan * $salReport->ngay_cong_OT);
//        $salReport->phu_cap_khac = round($salaryInfo->other_allowance / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong);
//        $salReport->tru_di_muon = $cAndBPolicy->truDiMuon($salReport->phut_di_muon);
//        $salReport->phu_cap_an_trua = round($salaryInfo->lunch_allowance / $salReport->ngay_cong_chuan * $salReport->ngay_cong_tinh_luong) - $salReport->tru_di_muon;
//        $salReport->bao_hiem = $salaryInfo->basic_salary * $salaryInfo->insurance_rate;
//        $salReport->tong_thu_nhap = $salReport->luong_theo_ngay_cong + $salReport->luong_OT + $salReport->phu_cap_an_trua + $salReport->phu_cap_khac - $salReport->bao_hiem;
//        $salReport->tien_an_duoc_mien_thue = $taxPolicy->tienAnMienThue($salReport->phu_cap_an_trua);
//        $salReport->luong_OT_duoc_mien_thue = $salReport->luong_OT / 2;
//        $salReport->giam_tru_gia_canh = $taxPolicy->giamTruGiaCanh($salaryInfo->dependents_number);
//        $salReport->thu_nhap_tinh_thue = $salReport->tong_thu_nhap - $salReport->tien_an_duoc_mien_thue - $salReport->luong_OT_duoc_mien_thue - $salReport->giam_tru_gia_canh;
//        $salReport->thue_TNCN = $taxPolicy->thueTNCN($salReport->thu_nhap_tinh_thue);
//        $salReport->luong_thuc_nhan = $salReport->tong_thu_nhap - $salReport->thue_TNCN;
//        $salReport->save();
////        $financeReport = FinanceReport::where('thang', $req->thang)->first();
////        $financeReport->chi_luong_thang += $salReport->tong_thu_nhap;
////        $financeReport->save();
//
//        return response()->json(['salReport' => $salReport], 201);
//    }
}
