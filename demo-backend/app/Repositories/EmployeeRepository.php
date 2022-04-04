<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeRepository
{
    public function checkExistById($employee_id)
    {
        return Employee::where(Employee::_ID, $employee_id)
            ->first();
    }

    public function getAll()
    {
        return Employee::all();
    }

    public function getEmployeeByID($employee_id)
    {
        return Employee::find($employee_id);
    }

    public function insert(Request $request)
    {
        $employee = new Employee;
        $employee->{Employee::_ID} = $request->input('employee_id');
        return $this->extracted($request, $employee);
    }

    public function update(Request $request)
    {
        $employee = Employee::where(Employee::_ID, $request->input('employee_id'))
            ->first();
        return $this->extracted($request, $employee);
    }

    public function delete($id)
    {
        return Employee::where(Employee::_ID, $id)
            ->delete();
    }

    /**
     * @param Request $request
     * @param Employee $employee
     * @return Employee
     */
    public function extracted(Request $request, Employee $employee): Employee
    {
        $employee->{Employee::_NAME}              = $request->input('fullName');
        $employee->{Employee::_EMAIL}             = $request->input('email');
        $employee->{Employee::_PHONE_NUMBER}      = $request->input('phone_number');
        $employee->{Employee::_DEPARTMENT_ID}     = $request->input('department_id');
        $employee->{Employee::_BASIC_SALARY}      = $request->input('basic_salary');
        $employee->{Employee::_LUNCH_ALLOWANCE}   = $request->input('lunch_allowance');
        $employee->{Employee::_OTHER_ALLOWANCE}   = $request->input('other_allowance');
        $employee->{Employee::_INSURANCE_RATE}    = $request->input('insurance_rate');
        $employee->{Employee::_DEPENDENTS_NUMBER} = $request->input('dependents_number');
        $employee->save();

        return $employee;
    }
}
