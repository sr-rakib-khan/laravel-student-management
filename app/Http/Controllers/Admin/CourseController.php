<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function AllCourse()
    {
        $course = Course::all();
        return view('course.course_list', compact('course'));
    }

    // course store method

    function CourseStore(Request $request)
    {
        $course = new Course();
        $course->course_name = $request->course_name;
        $course->status = $request->status;
        $course->save();

        return redirect()->back();
    }

    function CourseEdit($id)
    {
        $course = Course::find($id);
        return view('course.edit', compact('course'));
    }


    //course update method
    function CourseUpdate(Request $request)
    {
        $course = Course::find($request->id);
        $course->course_name = $request->course_name;
        $course->status = $request->status;
        $course->save();

        $notification = array('message' => 'Course Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    //course delete method
    function CourseDelete($id)
    {
        $course = Course::find($id);
        $course->delete();

        $notification = array('message' => 'Course deleted', 'alert-type' => 'warning');

        return redirect()->back()->with($notification);
    }
}
