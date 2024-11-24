@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')->where('id', session('course_id'))->first();
        $batch = DB::table('batches')->where('id', session('batch_id'))->first();

    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="row mb-3">
                <div class="col-md-3">
                    <h4>Batch Add Payments</h4>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-2 text-end">
                    <a href="{{ route('student.fee') }}" class="btn btn-primary btn-sm">Fee</a>
                </div>
                <div class="col-md-2 mr-1">
                    <a href="{{ route('coursewise.student', $course->id) }}" class="btn btn-success btn-sm">Students</a>
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
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a type="button"
                                        href="{{ route('nodues.students', ['course_id' => session('course_id'), 'batch_id' => session('batch_id')]) }}"
                                        class="btn btn-success">No
                                        Dues</a>
                                </li>
                                <li>
                                    <a type="button"
                                        href="{{ route('dues.students', ['course_id' => session('course_id'), 'batch_id' => session('batch_id')]) }}"
                                        class="btn btn-danger">Dues</a>
                                </li>
                            </ul>
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

                                        $sms = DB::table('sms')->where('status', 1)->first();

                                    @endphp
                                    <tr>
                                        <form action="{{ route('collect.fess') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $item->id }}">

                                            <td>{{ $item->student_id }}</td>
                                            <td><a
                                                    href="{{ route('view.student-details', $item->id) }}">{{ $item->student_name }}</a>
                                            </td>
                                            <td><img width="80px" src="{{ asset($item->photo) }}" alt=""></td>
                                            <td>{{ $item->discount }}</td>

                                            @if ($student_due->due_amount <= 0)
                                                <td class ="bg-success text-center">
                                                    <span class="text-white">No Dues: 0</span>
                                                </td>
                                            @else
                                                <td class="text-white bg-danger text-center">
                                                    Dues: {{ $student_due->due_amount }}
                                                    <br>
                                                    <a href="javascript:void(0);"
                                                        data-url="{{ route('due.reminder', $item->id) }}"
                                                        title="{{ $item->student_name }} your dues {{ $student_due->due_amount }} tk. Kindly clear your due by time. {{ $sms->footer_text }}"
                                                        class="btn btn-white send-sms">
                                                        <i class="fa fa-envelope" style="margin-right: 10px;"></i>Reminder
                                                    </a>
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
                                                    @php
                                                        $fee_month = DB::table('fees_months')
                                                            ->orderBy('id', 'DESC')
                                                            ->first();
                                                        $fee_str = $fee_month->fees_month;
                                                        $parts = explode('-', $fee_str);
                                                        $firstPart = $parts[0];
                                                    @endphp
                                                    @foreach ($fee_head as $head)
                                                        <option @if ($firstPart == $head->feehead_name) selected @endif
                                                            value="{{ $head->feehead_name }}">
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
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 mb-3">
                        <a href="javascript:void(0)" data-url="{{ route('coursewise.group.smsreminder', $course->id) }}"
                            class="btn btn-sm btn-danger send-due-reminder">
                            Send All Students Due Reminder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.send-due-reminder').on('click', function(event) {
                event.preventDefault(); // prevent page reload

                let url = $(this).data('url'); // collect url or route

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}" // CSRF token
                    },
                    success: function(response) {
                        toastr.success(response); // success message
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message ||
                            'Failed to send SMS.'); // error message
                    }
                });
            });
        });
    </script>
@endsection
