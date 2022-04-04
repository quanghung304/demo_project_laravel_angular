<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Employee api
Route::post('employees', 'EmployeeController@addEmployee');
Route::get('employees', 'EmployeeController@getAllEmmployee');
Route::get('employees/{id}', 'EmployeeController@getAnEmployee');
Route::put('employees', 'EmployeeController@updateEmployee');
Route::delete('employees/{id}', 'EmployeeController@deleteEmployee');
//Checkin calendar api
Route::get('checkin_calendar', 'CheckinCalendarController@getAllCheckinCalendar');
Route::post('checkin_calendar', 'CheckinCalendarController@addCheckinCal');
Route::get('checkin_calendar/{id}', 'CheckinCalendarController@getCheckinCalById');
Route::put('checkin_calendar', 'CheckinCalendarController@updateCheckinCal');
//Salary report api
Route::post('salary_reports', 'SalaryReportController@addSalReport');
Route::get('salary_reports', 'SalaryReportController@getAllSalaryReport');
Route::get('salary_reports/{id}', 'SalaryReportController@getSalReportByEmployee');
Route::put('salary_reports', 'SalaryReportController@updateSalReport');
//Trancsaction record api
//Route::post('transactions', 'TransactionRecordController@addTransaction');
//Route::get('transactions', 'TransactionRecordController@getAllTransaction');
//Route::put('transactions', 'TransactionRecordController@updateTransaction');
////Balance sheet api
//Route::get('balance_sheet', 'FinanceReportController@getFinanceReport');
