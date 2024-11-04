@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Expenses List</h4>
                    <h6>Manage your Expenses</h6>
                </div>
                <div class="page-btn">
                    <a type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addexpensemodal"><img
                            src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1" />Add New
                        Expense</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                                    <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
                                        alt="img" /></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-0" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <form action="{{ route('filter.expense') }}" method="get">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="start_date">
                                                </div>
                                            </div>
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="end_date">
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-filters ms-auto"><img
                                                            src="{{ asset('assets/img/icons/search-whites.svg') }}"
                                                            alt="img" /></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Entry Date</th>
                                    <th>Expenses Head</th>
                                    <th>Title</th>
                                    <th>Comment</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $key => $item)
                                    @php
                                        $expense_head = DB::table('expense_categories')
                                            ->where('id', $item->expensecategory_id)
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $expense_head->category_name }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            <a class="me-3" href="{{ route('expense.edit', $item->id) }}">
                                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                            </a>
                                            <a class="confirm-text delete" href="{{ route('expense.delete', $item->id) }}">
                                                <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-center">
                        <h5>Total Expenses: <span class="text-danger">{{ $total_expense }}.00 tk</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- category add modal -->
    <div class="modal fade" id="addexpensemodal" tabindex="-1" aria-labelledby="addexpensemodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New expense</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    $expensecategory = DB::table('expense_categories')->where('status', 1)->get();
                @endphp
                <form action="{{ route('expense.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Expense Category <span class="text-danger">*</span></label>
                            <select name="expensecategory_id" class="select">
                                <option selected disabled value="">Select Category</option>
                                @foreach ($expensecategory as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Comment <span class="text-danger">(optional)</span></label>
                            <input type="text" class="form-control" name="comment">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date">

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="amount">
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
