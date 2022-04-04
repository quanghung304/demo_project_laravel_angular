<?php

namespace App\Repositories;

use App\Models\CheckinCalendar;
use Illuminate\Http\Request;

class CheckinCalendarRepository
{
    public function checkIfExist(Request $request)
    {
        $checkinCal = CheckinCalendar::where([
            CheckinCalendar::_MONTH       => substr($request['month'], 0, 7),
            CheckinCalendar::_EMPLOYEE_ID => $request['employee_id']
        ])->first();

        return $checkinCal;
    }

    public function getCheckinCalendarById($id)
    {
        return CheckinCalendar::where([
            CheckinCalendar::_EMPLOYEE_ID => $id
        ])->get();
    }

    public function insert(Request $request)
    {
        for ($i = 1; $i <= 31; $i++) {
//            $checkIfExist = CheckinCalendar::where([
//                CheckinCalendar::_MONTH       => $request['month'],
//                CheckinCalendar::_EMPLOYEE_ID => $request['employee_id'],
//                CheckinCalendar::_DAY         => $i
//            ])->count();
//            if ($checkIfExist) {
//                return response()->json(['message' => "Record has been exist"], 404);
//                break;
//            } else {
                $checkinRecord = new CheckinCalendar();
                $checkinRecord->{CheckinCalendar::_EMPLOYEE_ID} = $request->input('employee_id');
                $checkinRecord->{CheckinCalendar::_MONTH} = substr($request->input('month'), 0, 7);
                $checkinRecord->{CheckinCalendar::_DAY} = $i;
                $checkinRecord->{CheckinCalendar::_CHECKIN_STATUS} = $request->input("day_{$i}");
                $checkinRecord->save();
            }

            echo response()->json(['$checkinRecord' => $checkinRecord]);
    }
}
