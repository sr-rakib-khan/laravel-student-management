<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesController extends Controller
{
    function CreateFee()
    {
        return view('fee.create');
    }

    function FeeAdd(Request $request)
    {
        //validation data
        $validated = $request->validate([
            'fee_head' => 'required',
            'year' => 'required',
            'fee_details' => 'required',
        ]);

        //received month and year from input filed
        $month = $request->input('fee_head');
        $year = $request->input('year');

        //check tusion month already exits
        $fee_month = $month . '-' . $year;

        $check_fee_month = DB::table('fees_months')->where('fees_month', $fee_month)->first();

        if ($check_fee_month) {
            $notification = array('message' => 'The tuition fee for this month has already been added!', 'alert-type' => 'warning');

            return redirect()->back()->with($notification);
        } else {
            // add new month in fees_month table
            DB::table('fees_months')->insert([
                'fees_month' => $fee_month,
            ]);

            // get all active student
            $students = DB::table('students')->where('status', 1)->get();

            foreach ($students as $student) {
                // collect tusion fee from students table
                $tusionFee = $student->tusion_fees;

                $discount = $student->discount;
                $tusionfee_after_discount = $tusionFee - $discount;

                //update student_due table

                $current_due = DB::table('student_dues')->where('student_id', $student->id)->value('due_amount');

                // dd($current_due);

                DB::table('student_dues')->where('student_id', $student->id)->update([
                    'due_amount' => $current_due + $tusionfee_after_discount,
                ]);


                // add student tusion fee
                DB::table('fess')->insert([
                    'student_id' => $student->id,
                    'fees_month' => $fee_month,
                    'tusion_fee' => $tusionFee,
                    'fee_details' => $request->fee_details,
                    'common_fee' => 0,
                    'extra_discount' => 0,
                    'due' => $current_due,
                    'monthly_discount' => $discount,
                    'fee_afterdiscount' => $tusionfee_after_discount,
                    'net_fee' => $current_due + $tusionfee_after_discount,
                    'payment' => 0,
                    'summary' => $current_due + $tusionfee_after_discount,
                    'feehead_id' => 0,
                    'year' => $year,
                    'created_at' => date("Y-m-d"),
                ]);
            }

            $notification = array('message' => 'Successfully Added tusion fee', 'alert-type' => 'success');

            return redirect()->back()->with($notification);
        }
    }
}
