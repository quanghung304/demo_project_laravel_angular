<?php

namespace App\Http\Controllers;

use App\FinanceReport;
use Illuminate\Http\Request;

class FinanceReportController extends Controller
{
    //
    public function getFinanceReport(){
        return FinanceReport::all();
    }
}
