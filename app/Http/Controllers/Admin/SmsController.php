<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\Smstemplate;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    function CreateSms()
    {
        $sms_settings = Sms::where('id', 1)->first();
        return view('sms.sms_settings', compact('sms_settings'));
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
        $number = $number;
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

        return redirect()->back()->with($notification);
    }


    // function sms_send()
    // {
    //     $url = "http://bulksmsbd.net/api/smsapi";
    //     $api_key = "your api key";
    //     $senderid = "your sender id";
    //     $number = "88016xxxxxxxx,88019xxxxxxxx";
    //     $message = "test sms check";

    //     $data = [
    //         "api_key" => $api_key,
    //         "senderid" => $senderid,
    //         "number" => $number,
    //         "message" => $message
    //     ];
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     return $response;
    // }


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
        return view('sms.sms_log');
    }
}
