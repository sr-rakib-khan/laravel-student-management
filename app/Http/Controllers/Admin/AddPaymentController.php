<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Batch;
use Barryvdh\DomPDF\Facade\Pdf;


class AddPaymentController extends Controller
{
    function CreatePayment()
    {
        return view('payment.create');
    }

    function Getbatches(Request $request)
    {
        $batches = Batch::where('course_id', $request->course_id)->get();
        return response()->json($batches);
    }


    function StudentList()
    {
        return view('payment.student_list');
    }

    function SearchStudent(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'batch_id' => 'required',
        ]);

        session([
            'course_id' => $request->course_id,
            'batch_id' => $request->batch_id,
        ]);

        return redirect()->route('paystudent.list');
    }

    function FessCollect(Request $request)
    {
        $request->validate([
            'pay_amount' => 'required',
            'feehead' => 'required',
        ]);

        //get year for unique student for pay
        $year = DB::table('fess')->orderBy('id', 'DESC')->first();

        $feehead = $request->feehead;
        $fees_month = $feehead . '-' . $year->year;

        $student_due = DB::table('student_dues')->where('student_id', $request->student_id)->first();


        $due = 0;
        if ($request->due_amount == $request->pay_amount) {
            $due = 0;
        } elseif ($request->due_amount > $request->pay_amount) {
            $due = $request->due_amount - $request->pay_amount;
        } else {
            $due = 0;
        }


        $fess_collect = 0;

        if ($request->feehead == 'Addmission') {
            $fess_collect = DB::table('fess')->where('student_id', $request->student_id)->where('fees_month', $request->feehead)->first();

            //update fess table
            $extra_discount = 0;
            if ($request->extra_discount == null || $request->extra_discount == 0) {
                $extra_discount = 0;
            } else {
                $extra_discount = $request->extra_discount;
            }

            $fess_collect = DB::table('fess')->where('student_id', $request->student_id)->where('fees_month', $request->feehead)->update([
                'extra_discount' => $extra_discount,
                'payment' => $request->pay_amount - $extra_discount,
                'summary' => 0,
                'updated_at' => date('Y-m-d'),
            ]);

            //update student_due table
            $update_student_due = DB::table('student_dues')->where('student_id', $request->student_id,)->update([
                'due_amount' => $due,
            ]);
        } else {
            $fess_collect = DB::table('fess')->where('student_id', $request->student_id)->where('fees_month', $fees_month)->first();

            //update fess table
            $extra_discount = 0;
            if ($request->extra_discount == null || $request->extra_discount == 0) {
                $extra_discount = 0;
            } else {
                $extra_discount = $request->extra_discount;
            }

            $fess_collect = DB::table('fess')->where('student_id', $request->student_id)->where('fees_month', $fees_month)->update([
                'extra_discount' => $extra_discount,
                'payment' => $request->pay_amount - $extra_discount,
                'summary' => 0,
                'updated_at' => date('Y-m-d'),

            ]);



            //update student_due table
            $update_student_due = DB::table('student_dues')->where('student_id', $request->student_id,)->update([
                'due_amount' => $due,
            ]);
        }


        //update fess table
        // $extra_discount = 0;
        // if ($request->extra_discount == null) {
        //     $extra_discount;
        // } else {
        //     $extra_discount = $request->extra_discount;
        // }

        // $fess_collect = DB::table('fess')->where('student_id', $request->student_id)->where('fees_month', $fees_month)->update([
        //     'extra_discount' => $extra_discount,
        //     'payment' => $request->pay_amount,
        //     'due' => $due,
        // ]);



        //update student_due table
        // $update_student_due = DB::table('student_dues')->where('student_id', $request->student_id,)->update([
        //     'due_amount' => $due,
        // ]);


        $notification = array('message' => 'Fees Collected', 'alert-type' => 'success');

        return back()->with($notification);
    }
}
