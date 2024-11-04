<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    function ExpenseCategoryList()
    {
        $category = ExpenseCategory::all();
        return view('expense.category', compact('category'));
    }


    function ExpenseCategoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $expcategory = new ExpenseCategory();
        $expcategory->category_name = $request->category_name;
        $expcategory->status = $request->status;

        $expcategory->save();

        $notification = array('message' => 'Expense Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    function ExpenseCategoryEdit($id)
    {
        $expcategory = ExpenseCategory::find($id);

        return view('expense.category_edit', compact('expcategory'));
    }

    function ExpenseCateroyUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $expcategory = ExpenseCategory::find($request->id);

        $expcategory->category_name = $request->category_name;
        $expcategory->status = $request->status;
        $expcategory->save();

        $notification = array('message' => 'Expense Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    function ExpensecatDelete($id)
    {
        $expcategory = ExpenseCategory::find($id);
        $expcategory->delete();

        $notification = array('message' => 'Expense Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
