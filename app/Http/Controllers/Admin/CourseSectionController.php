<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class CourseSectionController extends Controller
{
    function CourseSectionIndex()
    {
        $course = Course::where('status', 1)->get();
        return view('course_section.index', compact('course'));
    }


    //Section list method

    function SearchSection(Request $request)
    {
        $course_id = $request->course_id;

        $course = Course::where('status', 1)->get();

        $section = Section::with('course')->where('course_id', $course_id)->get();

        // return response()->json($section);

        return view('course_section.index', compact('section', 'course', 'course_id'));
    }

    function SectonStore(Request $request)
    {
        $section = new Section();
        $section->course_id = $request->section_id;
        $section->section_name = $request->section_name;
        $section->schedule_day = $request->schedule_day;
        $section->schedule_time = $request->schedule_time;
        $section->status = $request->status;

        $section->save();

        $notification = array('message' => 'Section Added', 'alert-type' => 'success');

        return redirect()->route('course.section.index')->with($notification);
    }


    // section edit 
    function SectionEdit($id)
    {
        $section = Section::with('course')->where('id', $id)->first();

        return view('course_section.edit', compact('section'));
    }


    //section update 

    function SectionUpdate(Request $request)
    {
        $section = Section::find($request->id);
        $section->course_id = $request->course_id;
        $section->section_name = $request->section_name;
        $section->schedule_day = $request->schedule_day;
        $section->schedule_time = $request->schedule_time;
        $section->status = $request->status;

        $section->save();

        $notification = array('message' => 'Section Updated Successlly', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //section delete

    function SectionDelete($id)
    {
        $section  = Section::find($id);

        $section->delete();

        $notification = array('message' => 'Section Deleted Successlly', 'alert-type' => 'success');

        return redirect()->route('course.section.index')->with($notification);
   
    }
}
