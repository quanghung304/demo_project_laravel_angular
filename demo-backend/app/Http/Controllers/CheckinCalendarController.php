<?php

namespace App\Http\Controllers;

use App\CheckinCalendar;
use App\SalaryReport;
use Illuminate\Http\Request;

class CheckinCalendarController extends Controller
{
    //
    public function getAllCheckinCalendar(){
        return CheckinCalendar::all();
    }
    public function getCheckinCalByEmployee($id){
        $checkinCal = CheckinCalendar::where(['employee_id' => $id])->get();
        return $checkinCal;
    }
    public function addCheckinCal(Request $req)
    {
        $checkExist = CheckinCalendar::where([
            'thang' => $req['thang'],
            'employee_id' => $req['employee_id']
        ])->count();
//        if($checkExist) {
//            return response()->json(['message' => "Record has been exists"]);
//        }
        $checkinCal = new CheckinCalendar();
        $checkinCal->thang = $req->input('thang');
        $checkinCal->employee_id = $req->input('employee_id');
        $sum = 0;
        $checkinCal->day_1 = $req->input('day_1');
        $sum += $checkinCal->day_1;
        $checkinCal->day_2 = $req->input('day_2');
        $sum += $checkinCal->day_2;
        $checkinCal->day_3 = $req->input('day_3');
        $sum += $checkinCal->day_3;
        $checkinCal->day_4 = $req->input('day_4');
        $sum += $checkinCal->day_4;
        $checkinCal->day_5 = $req->input('day_5');
        $sum += $checkinCal->day_5;
        $checkinCal->day_6 = $req->input('day_6');
        $sum += $checkinCal->day_6;
        $checkinCal->day_7 = $req->input('day_7');
        $sum += $checkinCal->day_7;
        $checkinCal->day_8 = $req->input('day_8');
        $sum += $checkinCal->day_8;
        $checkinCal->day_9 = $req->input('day_9');
        $sum += $checkinCal->day_9;
        $checkinCal->day_10 = $req->input('day10_');
        $sum += $checkinCal->day_10;
        $checkinCal->day_11 = $req->input('day_11');
        $sum += $checkinCal->day_11;
        $checkinCal->day_12 = $req->input('day_12');
        $sum += $checkinCal->day_12;
        $checkinCal->day_13 = $req->input('day_13');
        $sum += $checkinCal->day_13;
        $checkinCal->day_14 = $req->input('day_14');
        $sum += $checkinCal->day_14;
        $checkinCal->day_15 = $req->input('day_15');
        $sum += $checkinCal->day_15;
        $checkinCal->day_16 = $req->input('day_16');
        $sum += $checkinCal->day_16;
        $checkinCal->day_17 = $req->input('day_17');
        $sum += $checkinCal->day_17;
        $checkinCal->day_18 = $req->input('day_18');
        $sum += $checkinCal->day_18;
        $checkinCal->day_19 = $req->input('day_19');
        $sum += $checkinCal->day_19;
        $checkinCal->day_20 = $req->input('day_20');
        $sum += $checkinCal->day_20;
        $checkinCal->day_21 = $req->input('day_21');
        $sum += $checkinCal->day_21;
        $checkinCal->day_22 = $req->input('day_22');
        $sum += $checkinCal->day_22;
        $checkinCal->day_23 = $req->input('day_23');
        $sum += $checkinCal->day_23;
        $checkinCal->day_24 = $req->input('day_24');
        $sum += $checkinCal->day_24;
        $checkinCal->day_25 = $req->input('day_25');
        $sum += $checkinCal->day_25;
        $checkinCal->day_26 = $req->input('day_26');
        $sum += $checkinCal->day_26;
        $checkinCal->day_27 = $req->input('day_27');
        $sum += $checkinCal->day_27;
        $checkinCal->day_28 = $req->input('day_28');
        $sum += $checkinCal->day_28;
        $checkinCal->day_29 = $req->input('day_29');
        $sum += $checkinCal->day_29;
        $checkinCal->day_30 = $req->input('day_30');
        $sum += $checkinCal->day_30;
        $checkinCal->day_31 = $req->input('day_31');
        $sum += $checkinCal->day_31;
        $checkinCal->cong_theo_thang = $sum;
        $checkinCal->save();
        return response()->json(['CheckinCal' => $checkinCal], 201);
    }

    public function updateCheckinCal(Request $req)
    {
        $checkinCal = CheckinCalendar::where([
            'thang' => $req['thang'],
            'employee_id' => $req['employee_id']
        ])->first();
        if(!$checkinCal)
        {
            return response()->json(['message' => "Data not found"], 404);
        }
        $sum = 0;
        $checkinCal->day_1 = $req->input('day_1');
        $sum += $checkinCal->day_1;
        $checkinCal->day_2 = $req->input('day_2');
        $sum += $checkinCal->day_2;
        $checkinCal->day_3 = $req->input('day_3');
        $sum += $checkinCal->day_3;
        $checkinCal->day_4 = $req->input('day_4');
        $sum += $checkinCal->day_4;
        $checkinCal->day_5 = $req->input('day_5');
        $sum += $checkinCal->day_5;
        $checkinCal->day_6 = $req->input('day_6');
        $sum += $checkinCal->day_6;
        $checkinCal->day_7 = $req->input('day_7');
        $sum += $checkinCal->day_7;
        $checkinCal->day_8 = $req->input('day_8');
        $sum += $checkinCal->day_8;
        $checkinCal->day_9 = $req->input('day_9');
        $sum += $checkinCal->day_9;
        $checkinCal->day_10 = $req->input('day10_');
        $sum += $checkinCal->day_10;
        $checkinCal->day_11 = $req->input('day_11');
        $sum += $checkinCal->day_11;
        $checkinCal->day_12 = $req->input('day_12');
        $sum += $checkinCal->day_12;
        $checkinCal->day_13 = $req->input('day_13');
        $sum += $checkinCal->day_13;
        $checkinCal->day_14 = $req->input('day_14');
        $sum += $checkinCal->day_14;
        $checkinCal->day_15 = $req->input('day_15');
        $sum += $checkinCal->day_15;
        $checkinCal->day_16 = $req->input('day_16');
        $sum += $checkinCal->day_16;
        $checkinCal->day_17 = $req->input('day_17');
        $sum += $checkinCal->day_17;
        $checkinCal->day_18 = $req->input('day_18');
        $sum += $checkinCal->day_18;
        $checkinCal->day_19 = $req->input('day_19');
        $sum += $checkinCal->day_19;
        $checkinCal->day_20 = $req->input('day_20');
        $sum += $checkinCal->day_20;
        $checkinCal->day_21 = $req->input('day_21');
        $sum += $checkinCal->day_21;
        $checkinCal->day_22 = $req->input('day_22');
        $sum += $checkinCal->day_22;
        $checkinCal->day_23 = $req->input('day_23');
        $sum += $checkinCal->day_23;
        $checkinCal->day_24 = $req->input('day_24');
        $sum += $checkinCal->day_24;
        $checkinCal->day_25 = $req->input('day_25');
        $sum += $checkinCal->day_25;
        $checkinCal->day_26 = $req->input('day_26');
        $sum += $checkinCal->day_26;
        $checkinCal->day_27 = $req->input('day_27');
        $sum += $checkinCal->day_27;
        $checkinCal->day_28 = $req->input('day_28');
        $sum += $checkinCal->day_28;
        $checkinCal->day_29 = $req->input('day_29');
        $sum += $checkinCal->day_29;
        $checkinCal->day_30 = $req->input('day_30');
        $sum += $checkinCal->day_30;
        $checkinCal->day_31 = $req->input('day_31');
        $sum += $checkinCal->day_31;
        $checkinCal->cong_theo_thang = $sum;
        $checkinCal->save();
        return response()->json(['CheckinCal' => $checkinCal], 201);

    }
}
