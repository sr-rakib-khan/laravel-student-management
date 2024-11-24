<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Batch;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sms;
use App\Models\Student;

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

            if ($request->sms == 1) {
                $student = DB::table('students')->where('id', $request->student_id)->first();

                $student_due = DB::table('student_dues')->where('student_id', $request->student_id)->first();

                $sms_settings = Sms::where('id', 1)->first();

                $number = $student->sms_mobile;

                $text = "Dear " . $student->student_name . " Your payment successfull. Amount tk " . $request->pay_amount - $extra_discount . $sms_settings->footer_text;

                $url = "http://bulksmsbd.net/api/smsapi";

                $api_key = $sms_settings->sms_key;
                $senderid = $sms_settings->sender_id;
                $message = $text;

                $data = [
                    "api_key" => $api_key,
                    "senderid" => $senderid,
                    "number" => $number,
                    "message" => $message
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);

                $resposedata = json_decode($response, true);
            }
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

            if ($request->sms == 1) {
                $student = DB::table('students')->where('id', $request->student_id)->first();

                $student_due = DB::table('student_dues')->where('student_id', $request->student_id)->first();

                $sms_settings = Sms::where('id', 1)->first();

                $number = $student->sms_mobile;

                $text = "Dear " . $student->student_name . " Your payment successfull. Amount tk " . $request->pay_amount - $extra_discount . $sms_settings->footer_text;

                $url = "http://bulksmsbd.net/api/smsapi";

                $api_key = $sms_settings->sms_key;
                $senderid = $sms_settings->sender_id;
                $message = $text;

                $data = [
                    "api_key" => $api_key,
                    "senderid" => $senderid,
                    "number" => $number,
                    "message" => $message
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);

                $resposedata = json_decode($response, true);
            }
        }

        $notification = array('message' => 'Fees Collected', 'alert-type' => 'success');

        return back()->with($notification);
    }


    //no dues students list
    function NoduesStudents($course_id, $batch_id)
    {
        $students = DB::table('students')
            ->leftJoin('student_dues', 'students.id', '=', 'student_dues.student_id')
            ->where('students.course_id', $course_id)
            ->where('students.batch_id', $batch_id)
            ->where('student_dues.due_amount', 0.00)
            ->select('students.*')
            ->get();

        return view('payment.nodues_list', compact('students'));
    }


    function DuesStudents($course_id, $batch_id)
    {
        $students = DB::table('students')
            ->leftJoin('student_dues', 'students.id', '=', 'student_dues.student_id')
            ->where('students.course_id', $course_id)
            ->where('students.batch_id', $batch_id)
            ->where('student_dues.due_amount', '>', 0.00)
            ->select('students.*')
            ->get();

        return view('payment.dues_list', compact('students'));
    }

    function AlldueAddPayment()
    {

        $studentsWithDue = DB::table('students')
            ->join('student_dues', 'students.id', '=', 'student_dues.student_id')
            ->where('student_dues.due_amount', '>', 0)
            ->select('students.*', 'student_dues.due_amount')
            ->get();

        $duestudents_count = DB::table('students')
            ->join('student_dues', 'students.id', '=', 'student_dues.student_id')
            ->where('student_dues.due_amount', '>', 0)
            ->select('students.*', 'student_dues.due_amount')
            ->count();

        return view('payment.all_due_list', compact('studentsWithDue', 'duestudents_count'));
    }

    //search pay by courseid batchid section id date to date
    function Paysearch()
    {
        return view('payment.search_pay');
    }
}
