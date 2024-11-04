<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batchfee;
use App\Models\Course;
use App\Models\Feehead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchfeeController extends Controller
{
    function BatchfeeList($batch_id)
    {
        $batch = DB::table('batches')->join('courses', 'batches.course_id', 'courses.id')->where('batches.id', $batch_id)->select('batches.*', 'courses.course_name')->first();


        $batchfee = DB::table('batchfees')->join('feeheads', 'batchfees.feehead_id', 'feeheads.id')->select('batchfees.*', 'feeheads.feehead_name')->get();
        return view('batchfee.index', compact('batch', 'batchfee'));
    }


    //store batch fee method

    function StoreBatchfee(Request $request)
    {
        $batchfee = new Batchfee();
        $batchfee->course_id = $request->course_id;
        $batchfee->feehead_id = $request->feehead_id;
        $batchfee->fee_name = $request->fee_name;
        $batchfee->fee_amount = $request->fee_amount;
        $batchfee->save();


        $notification = array('message' => 'Batch Fee Added', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    //edit batchfee method
    function EditBatchfee($batchfee_id)
    {
        $batchfee = Batchfee::where('id', $batchfee_id)->first();
        return view('batchfee.edit', compact('batchfee'));
    }

    //update batchfee method
    function UpdateBatchfee(Request $request)
    {
        $batchfee = Batchfee::find($request->fee_id);
        $batchfee->feehead_id = $request->feehead_id;
        $batchfee->fee_name = $request->fee_name;
        $batchfee->fee_amount = $request->fee_amount;
        $batchfee->save();

        $notification = array('message' => 'Batch Fee Updated', 'alert-type' => 'success');

        return redirect()->route('batchfee.list', $batchfee->course_id)->with($notification);
    }

    //delete batchfee method
    function DeleteBatchfee($fee_id)
    {
        $batchfee = Batchfee::find($fee_id)->delete();
        $notification = array('message' => 'Batch Fee Deleted', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
