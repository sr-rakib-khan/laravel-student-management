<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sms;

class DuereminderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function SingleReminder($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        $student_due = DB::table('student_dues')->where('student_id', $id)->first();

        $sms_settings = Sms::where('id', 1)->first();

        $number = $student->sms_mobile;

        $text = $student->student_name . " Your dues" . $student_due->due_amount . "tk." . " Kindly clear your due by time. " . $sms_settings->footer_text;

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
        // $successmessage = $resposedata['success_message'];

        if (isset($resposedata['success_message'])) {
            return response()->json([
                'success' => true,
                'message' => $resposedata['success_message']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $resposedata['error_message'] ?? 'SMS sending failed.'
            ], 500);
        }
    }
}
