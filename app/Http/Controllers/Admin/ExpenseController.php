<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    function ExpenseList(Request $request)
    {
        $start_date = date('d-m-y', strtotime($request->start_date));
        $end_date = date('d-m-y', strtotime($request->end_date));



        $query = DB::table('expenses');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        $expenses = $query->get();
        $total_expense = $query->sum('amount');
        
        return view('expense.expense_list', compact('expenses', 'total_expense'));
    }


    function ExpenseStore(Request $request)
    {

        if (empty($request->expensecategory_id) || empty($request->title) || empty($request->date) || empty($request->amount)) {

            $notification = array('message' => 'Filed Must not be empty!', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        } else {
            $expense = new Expense();
            $expense->expensecategory_id = $request->expensecategory_id;
            $expense->title = $request->title;
            $expense->comment = $request->comment;
            $expense->amount = $request->amount;
            $expense->date = date('d-m-y', strtotime($request->date));
            $expense->save();

            $notification = array('message' => 'Expense Added', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    //expense edit
    function ExpenseEdit($id)
    {
        $expense = Expense::find($id);

        return view('expense.expense_edit', compact('expense'));
    }


    function ExpenseUpdate(Request $request)
    {


        $expense = Expense::find($request->id);
        $expense->expensecategory_id = $request->expensecategory_id;
        $expense->title = $request->title;
        $expense->comment = $request->comment;
        $expense->amount = $request->amount;
        $expense->date = date('d-m-y', strtotime($request->date));
        $expense->save();

        $notification = array('message' => 'Expense Updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    function ExpenseDelete($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        $notification = array('message' => 'Expense Deleted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
