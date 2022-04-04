<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'employee_id';
    public $incrementing = false;

    const TABLE = 'employees';

    const _ID                = 'employee_id';
    const _NAME              = 'fullName';
    const _EMAIL             = 'email';
    const _PHONE_NUMBER      = 'phone_number';
    const _DEPARTMENT_ID     = 'department_id';
    const _BASIC_SALARY      = 'basic_salary';
    const _LUNCH_ALLOWANCE   = 'lunch_allowance';
    const _OTHER_ALLOWANCE   = 'other_allowance';
    const _INSURANCE_RATE    = 'insurance_rate';
    const _DEPENDENTS_NUMBER = 'dependents_number';
}
