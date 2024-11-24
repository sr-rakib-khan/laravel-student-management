<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Sms;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\StudentDue;

class StudentmanageController extends Controller
{
    function ChoseCourse()
    {
        return view('student.chose_course');
    }

    function CreateStudent(Request $request)
    {
        $course = $request->course_id;
        $year = $request->year;

        return view('student.create', compact('course', 'year'));
    }

    function StoreStudent(Request $request)
    {


        $sms = 0;
        $status = 0;


        if ($request->sms) {
            $sms = 1;
        } else {
            $sms;
        }

        if ($request->status) {
            $status = 1;
        } else {
            $status;
        }

        //get tusion fee from sections table for students table
        $batch_id = $request->input('batch_id');

        $tusion_fees = DB::table('batches')->where('id', $batch_id)->value('monthly_fee');


        $student_id = str_pad(Student::count() + 1, 5, '0', STR_PAD_LEFT);

        $student = new Student();

        $student->course_id = $request->course_id;
        $student->section_id = $request->section_id;
        $student->batch_id = $request->batch_id;
        $student->student_id = $student_id;
        $student->tusion_fees = $tusion_fees;
        $student->discount = $request->discount;
        $student->note =  $request->note;
        $student->institute_name =  $request->institute_name;
        $student->status =  $status;
        $student->student_name =  $request->student_name;
        $student->date_of_birth =  $request->date_of_birth;
        $student->gender =  $request->gender;
        $student->religion =  $request->religion;
        $student->sms_mobile =  $request->sms_mobile;
        $student->father_name =  $request->father_name;
        $student->mother_name =  $request->mother_name;
        $student->guardian_mobile =  $request->guardian_mobile;
        $student->address =  $request->address;
        $student->sms =  $sms;
        $student->admission_date =  date('d-m-y');

        //working for photo
        if ($request->photo) {
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $photo = $request->photo;
            $photo_name = $slug . "." . $photo->getClientOriginalExtension();
            $photo_read = $manager->read($photo);
            $photo_resize = $photo_read->resize(400, 400)->save('assets/students/' . $photo_name);
            $student->photo = 'assets/students/' . $photo_name;
        }

        $student->save();


        // insert data in student due table 
        $addmission_fee = DB::table('batchfees')->where('course_id', $request->course_id)->first();
        $student_id = $student->id;

        $student_due = new StudentDue();
        $student_due->student_id = $student_id;
        $student_due->due_amount = $addmission_fee->fee_amount;


        $student_due->save();

        //insert data into fees tble
        DB::table('fess')->insert([
            'student_id' => $student_id,
            'feehead_id' => 0,
            'fees_month' => "Addmission",
            'tusion_fee' => 0,
            'monthly_discount' => 0,
            'fee_afterdiscount' => 0,
            'common_fee' =>  $addmission_fee->fee_amount,
            'extra_discount' => 0,
            'net_fee' => $addmission_fee->fee_amount,
            'due' => 0,
            'payment' => 0,
            'fee_details' => "Admission fee",
            'year' => date('Y'),
            'created_at' => date("Y-m-d"),
        ]);
        $successmessage = 0;

        //working with sms
        if ($sms == 1) {
            $sms_settings = Sms::where('id', 1)->first();

            $url = "http://bulksmsbd.net/api/smsapi";

            $api_key = $sms_settings->sms_key;
            $senderid = $sms_settings->sender_id;
            $number = $request->sms_mobile;
            $message = "Dear {$request->student_name}, Add student successfully. {$sms_settings->footer_text}";

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
        }

        if ($successmessage) {
            $notification = array('message' => $successmessage, 'alert-type' => 'success');
        } else {
            $notification = array('message' => "Student Inset Successfully", 'alert-type' => 'success');
        }



        // $notification = array('message' => 'Student Added Successfully', 'alert-type' => 'success');

        return redirect()->route('student.list')->with($notification);
    }



    //student list method
    function StudentList()
    {
        return view('student.student_list');
    }


    //student search for manage
    function SearchStudent(Request $request)
    {
        session([
            'stdmanage_course_id' => $request->course_id,
            'stdmanage_batch_id' => $request->session,
        ]);

        return redirect()->route('stdmanage_list');
    }

    //student list for manage
    function StdmanageList(Request $request)
    {
        return view('student.stdmanage_list');
    }

    function ViewSutdentDetails($id)
    {
        $student = DB::table('students')->where('id', $id)->first();
        return view('student.view', compact('student'));
    }

    function EditStudent($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        return view('student.edit', compact('student'));
    }

    function UpdateStudent(Request $request)
    {

        $status = 0;



        if ($request->status) {
            $status = 1;
        } else {
            $status;
        }

        $student = Student::find($request->id);
        $student->section_id = $request->section_id;
        $student->batch_id = $request->batch_id;
        $student->discount = $request->discount;
        $student->note = $request->note;
        $student->institute_name = $request->institute_name;
        $student->status = $status;
        $student->student_name = $request->student_name;
        $student->date_of_birth = $request->date_of_birth;
        $student->gender = $request->gender;
        $student->religion = $request->religion;
        $student->sms_mobile = $request->sms_mobile;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->guardian_mobile = $request->guardian_mobile;
        $student->address = $request->address;

        //working for photo
        if ($request->photo) {

            if (File::exists($request->old_photo)) {
                unlink($request->old_photo);
            }

            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $photo = $request->photo;
            $photo_name = $slug . "." . $photo->getClientOriginalExtension();
            $photo_read = $manager->read($photo);
            $photo_resize = $photo_read->resize(300, 300)->save('assets/students/' . $photo_name);
            $student->photo = 'assets/students/' . $photo_name;
        } else {
            $student->photo = $request->old_photo;
        }

        $student->save();

        $notification = array('message' => 'Student Info Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    function DeleteStudent($id)
    {
        $student = Student::find($id);
        if (File::exists($student->photo)) {
            unlink($student->photo);
        }

        $student->delete();
        $notification = array('message' => 'Student Info Deleted', 'alert-type' => 'success');
        return redirect()->route('student.list')->with($notification);
    }

    // pending student method 
    function PendingStudents()
    {
        $pending_student = DB::table('students')->where('status', 0)->get();

        $pending_student_count = DB::table('students')->where('status', 0)->count();

        return view('student.pending_student', compact('pending_student', 'pending_student_count'));
    }


    function PendingStudentsDelete($id)
    {
        $pending_student = Student::find($id);
        if (File::exists($pending_student->photo)) {
            unlink($pending_student->photo);
        }
        $pending_student->delete();

        return response()->json('Student Deleted');
    }


    //active student method
    function ActiveStudent($id)
    {
        $student = Student::find($id);
        $student->status = 1;

        $student->save();

        return response()->json('Student Activated Successfully');
    }



    //active studentlist method
    function ActiveStudentList($id)
    {
        $student = Student::find($id);
        $student->status = 1;

        $student->save();
        $notification = array('message' => 'Student Activated', 'alert-type' => 'success');
        return redirect()->route('student.list')->with($notification);
    }


    //active studentlist method

    function InactiveStudentList($id)
    {
        $student = Student::find($id);
        $student->status = 0;

        $student->save();
        $notification = array('message' => 'Student Inactivated', 'alert-type' => 'success');
        return redirect()->route('student.list')->with($notification);
    }

    function PromotionCreate()
    {
        return view('student.chose_student');
    }

    //student promotion search method
    function FindStudent(Request $request)
    {
        $student = DB::table('students')
            ->where('student_id', 'LIKE', "%{$request->id}%")
            ->first();
        $course = DB::table('courses')->get();



        return view('student.promotion_student', compact('student'));
    }



    function GetCourseData(Request $request)
    {
        $course_id = $request->course_id;

        $sections = DB::table('sections')->where('course_id', $course_id)->get();
        $batches = DB::table('batches')->where('course_id', $course_id)->get();

        $sessions = ["2024", "2025"];



        return response()->json([
            'sections' => $sections,
            'batches' => $batches,
            'sessions' => $sessions,
        ]);
    }

    //promotion student in next class
    function PromotionStudent(Request $request)
    {

        if (empty($request->course) || empty($request->session) || empty($request->section) || empty($request->batch)) {

            $notification = array('message' => 'Filed Must not be Empty', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        } else {

            $student = Student::find($request->id);
            $student->course_id = $request->course;
            $student->section_id = $request->section;
            $student->batch_id = $request->batch;
            $student->discount = $request->discount;
            $student->save();

            $notification = array('message' => 'Student Promotion Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    //course wise students

    function CoursewideStudent($course_id)
    {
        $sutdents = Student::where('course_id', $course_id)->get();
        return view('student.course_wise_student', compact('sutdents'));
    }
}
