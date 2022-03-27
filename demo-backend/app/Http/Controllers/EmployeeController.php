<?php

namespace App\Http\Controllers;

use App\CheckinCalendar;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function getAllEmmployee(){
        return Employee::all();
    }

    public function addEmployee(Request $req)
    {
        $employee = new Employee;
        $employee->employee_id = $req->input('employee_id');
        $employee->fullName = $req->input('fullName');
        $employee->email = $req->input('email');
        $employee->phone_number = $req->input('phone_number');
        $employee->department_id = $req->input('department_id');
        $employee->basic_salary = $req->input('basic_salary');
        $employee->lunch_allowance = $req->input('lunch_allowance');
        $employee->other_allowance = $req->input('other_allowance');
        $employee->insurance_rate = $req->input('insurance_rate');
        $employee->dependents_number = $req->input('dependents_number');
        $employee->save();
        return response()->json(['employee' => $employee], 201);
    }

    public function updateEmployee(Request $req)
    {
        $employee = Employee::where(['employee_id' => $req['employee_id']])->first();
        if(!$employee)
        {
            return response()->json(['message' => "Employee not found"], 404);
        }
        $employee->fullName = $req->input('fullName');
        $employee->email = $req->input('email');
        $employee->phone_number = $req->input('phone_number');
        $employee->department_id = $req->input('department_id');
        $employee->basic_salary = $req->input('basic_salary');
        $employee->lunch_allowance = $req->input('lunch_allowance');
        $employee->other_allowance = $req->input('other_allowance');
        $employee->insurance_rate = $req->input('insurance_rate');
        $employee->dependents_number = $req->input('dependents_number');
        $employee->save();
        return response()->json(['employee' => $employee], 201);
    }

    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['employee' => 'Employee deleted'], 200);
    }

    public function getAnEmployee($id)
    {
        $employee = Employee::find($id);
        return response()->json(['employee' => $employee], 201);
    }
}
