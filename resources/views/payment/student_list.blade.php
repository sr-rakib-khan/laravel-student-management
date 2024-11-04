@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')->where('id', session('course_id'))->first();
        $batch = DB::table('batches')->where('id', session('batch_id'))->first();
        $students = DB::table('students')
            ->where('course_id', session('course_id'))
            ->where('batch_id', session('batch_id'))
            ->get();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Batch Add Payments</h4>
                </div>
                <div class="page-btn">
                    <a href="addproduct.html" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img"
                            class="me-1" />Add New Product</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body bg-success">
                    <div class="row">
                        <div class="col-12 col-lg-3 text-white"><strong>Course: </strong>{{ $course->course_name }} |
                            {{ $batch->session }}</div>
                        <div class="col-12 col-lg-3 text-white"><strong>Batch: </strong>{{ $batch->batch_name }}</div>
                        <div class="col-12 col-lg-3 text-white"><strong>Monthly Fee: </strong>{{ $batch->monthly_fee }}
                        </div>
                        <div class="col-12 col-lg-3 text-white"><strong>Status: </strong>
                            @if ($batch->status == 1)
                                Running
                            @else
                                Draft
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
                                        alt="img" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Monthly Discount</th>
                                    <th>Ac Status</th>
                                    <th>Discount Amount</th>
                                    <th>Pay Amount</th>
                                    <th>Fee Head</th>
                                    <th>Check</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $item)
                                    @php
                                        $fee_head = DB::table('feeheads')->where('status', 1)->get();
                                        $student_due = DB::table('student_dues')
                                            ->where('student_id', $item->id)
                                            ->first();
                                    @endphp
                                    <tr>
                                        <form action="{{ route('collect.fess') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $item->id }}">

                                            <td>{{ $item->student_id }}</td>
                                            <td>{{ $item->student_name }}</td>
                                            <td><img width="80px" src="{{ asset($item->photo) }}" alt=""></td>
                                            <td>{{ $item->discount }}</td>

                                            @if ($student_due->due_amount <= 0)
                                                <td class ="text-success">
                                                    No Dues: 0
                                                </td>
                                            @else
                                                <td class="text-danger">
                                                    Dues: {{ $student_due->due_amount }}
                                                </td>
                                            @endif

                                            <td>
                                                @if ($student_due->due_amount <= 0)
                                                    <input disabled type="text" class="form-control">
                                                @else
                                                    <input name="extra_discount" type="text" class="form-control">
                                                @endif
                                            </td>

                                            <input name="due_amount" type="hidden" value="{{ $student_due->due_amount }}">

                                            <td><input value="{{ $student_due->due_amount }}" name="pay_amount"
                                                    type="text" class="form-control"></td>
                                            @error('pay_amount')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                            <td style="min-width: 120px">
                                                <select name="feehead" class="select">
                                                    <option disabled selected>select head</option>
                                                    @foreach ($fee_head as $head)
                                                        <option value="{{ $head->feehead_name }}">
                                                            {{ $head->feehead_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('feehead')
                                                    <div class="error text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input name="sms" class="form-check-input" type="checkbox"
                                                    value="1" checked>
                                                <label class="form-check-label">
                                                    Send Sms
                                                </label>
                                                <br>
                                                <input name="receipt" class="form-check-input" type="checkbox"
                                                    value="1">
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Receipt
                                                </label>
                                            </td>
                                            <td>

                                                <button class="btn btn-sm btn-primary" type="submit">
                                                    Update
                                                </button>
                                                <br>
                                        </form>
                                        <a class="btn btn-success btn-sm text-white mt-1"
                                            href="{{ route('student.account', $item->id) }}">
                                            Ac
                                        </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
