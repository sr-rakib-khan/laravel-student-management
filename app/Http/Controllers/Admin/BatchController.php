<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    function AllBatch(Request $request)
    {
        $batch = DB::table('batches')
            ->join('courses', 'batches.course_id', '=', 'courses.id')->select('batches.*', 'courses.course_name')
            ->get();

        // return response()->json($batch);
        return view('batch.index', compact('batch'));
    }


    function FilterData(Request $request)
    {

        // $batch = 0;

        if ($request->session && $request->course_id && $request->status) {
            $batch = DB::table('batches')
                ->join('courses', 'batches.course_id', '=', 'courses.id')->where('session', $request->session)->where('course_id', $request->course_id)->where('batches.status', $request->status)->select('batches.*', 'courses.course_name')
                ->get();
        } else {
            $batch = DB::table('batches')
                ->join('courses', 'batches.course_id', '=', 'courses.id')->select('batches.*', 'courses.course_name')
                ->get();

            // return response()->json($batch);
            return view('batch.index', compact('batch'));
        }


        // return response()->json($batch);
        return view('batch.index', compact('batch'));
    }

    //batch store
    function BatchStore(Request $request)
    {
        $batch = new Batch();
        $batch->course_id = $request->course_id;
        $batch->session = $request->session;
        $batch->batch_name = $request->batch_name;
        $batch->monthly_fee = $request->fee;
        $batch->status = $request->status;

        $batch->save();

        $notification = array('message' => 'Batch Added', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    //batch edit

    function BatchEdit($id)
    {
        $batch = DB::table('batches')
            ->join('courses', 'batches.course_id', '=', 'courses.id')->where('batches.id', $id)->select('batches.*', 'courses.course_name')
            ->first();

        return view('batch.edit', compact('batch'));
    }

    //batch update method
    function BatchUpdate(Request $request)
    {
        $batch = Batch::find($request->id);

        $batch->course_id = $request->course_id;
        $batch->session = $request->session;
        $batch->batch_name = $request->batch_name;
        $batch->monthly_fee = $request->fee;
        $batch->status = $request->status;

        $batch->save();


        $notification = array('message' => 'Batch Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    //batch delete 

    function BatchDelete($id)
    {
        $batch = Batch::find($id)->delete();

        $notification = array('message' => 'Batch Deleted', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //All running batch

    function RunningBatch()
    {
        $running_batch = DB::table('batches')
            ->join('courses', 'batches.course_id', '=', 'courses.id')->where('batches.status', 1)->select('batches.*', 'courses.course_name')
            ->get();

        return view('batch.running_batch', compact('running_batch'));
    }


    function RunningBatchStudent($id)
    {
        $batch_id = $id;

        $batch_studentlist = Student::where('batch_id', $id)->get();
        return view('batch.batch_students', compact('batch_studentlist', 'batch_id'));
    }


    //BatchActiveStudent

    function BatchActiveStudent($id)
    {
        $batch_id = $id;
        $batch_active_students = DB::table('students')->where('batch_id', $id)->where('status', 1)->get();

        return view('batch.batch_active_students', compact('batch_active_students', 'batch_id'));
    }

    //BatchInactiveStudent
    function BatchInactiveStudent($id)
    {
        $batch_id = $id;
        $inactive_students = DB::table('students')->where('batch_id', $id)->where('status', 0)->get();

        return view('batch.batch_inactive_students', compact('inactive_students', 'batch_id'));
    }

    //SectionStudents
    function SectionStudents($id, $batch_std_id)
    {
        $batch_id = $batch_std_id;

        $section_students = DB::table('students')->where('section_id', $id)->get();
        return view('batch.section_wise_student', compact('batch_id', 'section_students'));
    }
}
