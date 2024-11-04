<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feehead;
use Illuminate\Http\Request;

class FeeheadController extends Controller
{
    function AllfeeHead()
    {
        $feeheads = Feehead::all();
        return view('feehead.index', compact('feeheads'));
    }

    function StoreFeehead(Request $request)
    {
        $feehead = new Feehead();
        $feehead->feehead_name = $request->fehead_name;
        $feehead->status = $request->status;

        $feehead->save();

        $notification = array('message' => 'Fee head added', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    function EditFeehead($id)
    {
        $feehead = Feehead::find($id);

        return view('feehead.edit', compact('feehead'));
    }
}
