@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Edit Expense</h2>
                </div>

                <div class="page-title">
                    <a class="btn btn-primary" href="{{ route('expense.list') }}" type="button">Expense list</a>
                </div>
            </div>
            @php
                $expensecategory = DB::table('expense_categories')->get();
            @endphp
            <div class="card">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="card-body col-md-6">
                        <form action="{{ route('update.expense') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $expense->id }}">
                            <div class="mb-3">
                                <label for="validationCustom01">Expense Head</label>
                                <select name="expensecategory_id" class="form-control form-small select">
                                    @foreach ($expensecategory as $item)
                                        <option @if ($item->id == $expense->expensecategory_id) selected @endif
                                            value="{{ $item->id }}">
                                            {{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Title <span class="text-danger">*</span></label>
                                <input value="{{ $expense->title }}" type="text" name="title" class="form-control" />
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Comment <span class="text-danger">(Optional)</span></label>
                                <input value="{{ $expense->comment }}" type="text" name="comment" class="form-control" />
                                @if ($errors->has('comment'))
                                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Date <span class="text-danger">*</span></label>
                                <input value="{{ $expense->date }}" type="date" name="date" class="form-control" />
                                @if ($errors->has('date'))
                                    <span class="text-danger">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="validationCustom01">Amount <span class="text-danger">*</span></label>
                                <input value="{{ $expense->amount }}" type="text" name="amount" class="form-control" />
                                @if ($errors->has('amount'))
                                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                                @endif
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--expense category add modal -->
    <div class="modal fade" id="categoryaddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New expense category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('expensecategory.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" class="form-control" required />
                            @if ($errors->has('category_name'))
                                <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Category Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control form-small select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
