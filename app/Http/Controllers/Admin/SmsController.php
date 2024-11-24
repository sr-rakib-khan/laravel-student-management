<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\Smstemplate;
use Illuminate\Http\Request;
use App\Models\Smslog;
use Illuminate\Support\Carbon;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller
{
    function get_balance()
    {
        $sms_settings = Sms::where('id', 1)->first();
    }


    function CreateSms()
    {
        $sms_settings = Sms::where('id', 1)->first();


        //shwo data in view file
        $url = "http://bulksmsbd.net/api/getBalanceApi";
        $api_key = $sms_settings->sms_key; // api key
        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        // process response data
        $blance = json_decode($response, true); // convert jsnon data into array


        //count sms and show view file
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $smsCount = Smslog::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        return view('sms.sms_settings', compact('sms_settings', 'smsCount', "blance"));
    }


    function SettingsStore(Request $request)
    {
        $sms = Sms::where('id', 1)->first();

        $sms->sms_key = $request->key;
        $sms->sms_url = $request->url;
        $sms->helpline = $request->helpline;
        $sms->sender_id = $request->sender_id;
        $sms->footer_text = $request->footer;
        $sms->status = $request->status;

        $sms->save();

        $notification = array('message' => 'Sms Settings Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    function SmsCreate()
    {
        return view('sms.sms_send');
    }

    function SmsSend(Request $request)
    {
        $number = $request->to;
        $sms_settings = Sms::where('id', 1)->first();

        $url = "http://bulksmsbd.net/api/smsapi";

        $api_key = $sms_settings->sms_key;
        $senderid = $sms_settings->sender_id;
        $message = $request->sms;

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
        $successmessage = $resposedata['success_message'];

        $notification = array('message' => $successmessage, 'alert-type' => 'success');

        //store sms log

        $smslog = new Smslog();
        $smslog->recipient = $number;
        $smslog->message = $message;
        $smslog->save();

        return redirect()->back()->with($notification);
    }

    function Deletesmslog($id)
    {
        $smslogdelete = Smslog::find($id);
        $smslogdelete->delete();

        $notification = array('message' => "Sms log Deleted", 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }




    function SmsTemplate()
    {
        $template = Smstemplate::all();
        return view('sms.sms_template', compact('template'));
    }


    function TemplateStore(Request $request)
    {
        $template = new Smstemplate();

        $template->title = $request->title;
        $template->message = $request->message;

        $template->save();

        $notification = array('message' => 'Sms Template Added', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    function TemplateEdit($id)
    {
        $template = Smstemplate::where('id', $id)->first();
        return view('sms.sms_template_edit', compact('template'));
    }


    function TemplateUpdate(Request $request)
    {
        $template = Smstemplate::where('id', $request->id)->first();

        $template->title = $request->title;
        $template->message = $request->message;

        $template->save();


        $notification = array('message' => 'Sms Template Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    function TemplateDelete($id)
    {
        $template = Smstemplate::find($id);
        $template->delete();
        $notification = array('message' => 'Sms Template Deleted', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    function SmsLog()
    {
        $smslog = Smslog::get();
        return view('sms.sms_log', compact('smslog'));
    }

    //send group sms

    function SendgroupSms(Request $request)
    {
        $request->validate([
            'sms_text' => 'required',
        ]);

        $smsText = $request->sms_text;
        $courseId = $request->course_id;

        // search student by course id
        $students = Student::where('course_id', $courseId)->get();

        foreach ($students as $key => $value) {
            $number = $value->sms_mobile;
            $sms_settings = Sms::where('id', 1)->first();

            $url = $sms_settings->sms_url;

            $api_key = $sms_settings->sms_key;
            $senderid = $sms_settings->sender_id;
            $message = $smsText;

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
            $successmessage = $resposedata['success_message'];

            // $notification = array('message' => $successmessage, 'alert-type' => 'success');

            return response()->json($successmessage);
        }
    }


    //send group smsreminder for course wise dues students

    function SendremindCWDStd($course_id)
    {
        $studentsWithDue = Student::join('student_dues', 'students.id', '=', 'student_dues.student_id')
            ->where('students.course_id', $course_id)
            ->where('student_dues.due_amount', '>', 0)
            ->get();

        // dd($studentsWithDue);

        foreach ($studentsWithDue as $key => $value) {
            $number = $value->sms_mobile;
            $sms_settings = Sms::where('id', 1)->first();

            $url = $sms_settings->sms_url;

            $api_key = $sms_settings->sms_key;
            $senderid = $sms_settings->sender_id;
            $message = "Dear " . $value->student_name . " Pay your dues " . $value->due_amount . " tk by time. " . $sms_settings->footer_text;

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
            $successmessage = $resposedata['success_message'];

            // $notification = array('message' => $successmessage, 'alert-type' => 'success');

            return response()->json($successmessage);
        }
    }


    //all dues students send reminder sms

    function AllDuesStudents()
    {

        $studentsWithDue = DB::table('students')
            ->join('student_dues', 'students.id', '=', 'student_dues.student_id')
            ->where('student_dues.due_amount', '>', 0)
            ->get();

        foreach ($studentsWithDue as $key => $value) {
            $number = $value->sms_mobile;
            $sms_settings = Sms::where('id', 1)->first();

            $url = $sms_settings->sms_url;

            $api_key = $sms_settings->sms_key;
            $senderid = $sms_settings->sender_id;
            $message = "Dear " . $value->student_name . " Pay your dues " . $value->due_amount . " tk by time. " . $sms_settings->footer_text;

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
            $successmessage = $resposedata['success_message'];

            // $notification = array('message' => $successmessage, 'alert-type' => 'success');

            return response()->json($successmessage);
        }
    }
}
