<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalController extends Controller
{
    function GlobalStudentSearch(Request $request)
    {
        $student = DB::table('students')
            ->where('student_id', 'like', "%{$request->id}%")
            ->first();

        if ($student) {
            return view('student.global_search_student', compact('student'));
        } else {
            $notification = array('message' => 'Enter valid ID', 'alert-type' => 'warning');

            return redirect()->back()->with($notification);
        }
    }
}
