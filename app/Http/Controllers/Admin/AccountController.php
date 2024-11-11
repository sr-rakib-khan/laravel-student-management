<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    function StudentAccountDetails($id)
    {
        $student = DB::table('students')->where('id', $id)->first();
        return view('payment.student_account', compact('student'));
    }
}
