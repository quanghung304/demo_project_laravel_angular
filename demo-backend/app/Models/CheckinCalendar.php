<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinCalendar extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'record_code';

    const TABLE = 'checkin_calendars';

    const _ID             = 'id';
    const _MONTH          = 'month';
    const _EMPLOYEE_ID    = 'employee_id';
    const _DAY            = 'day';
    const _CHECKIN_STATUS = 'checkin_status';
}
