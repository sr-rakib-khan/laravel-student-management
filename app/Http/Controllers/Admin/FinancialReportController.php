<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    function FinancialReport()
    {
        return view('report.financial');
    }
}
