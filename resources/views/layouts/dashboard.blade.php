@extends('layouts.admin')
@section('page-content')
    @php
        $total_student = DB::table('students')->count();
        $active_student = DB::table('students')->where('status', 1)->count();
        $Pending_student = DB::table('students')->where('status', 0)->count();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="{{ route('all.batch') }}">
                        <div class="dash-widget bg-primary align-center">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">Batch Manager</h5>
                            </div>
                        </div>
                    </a> --}}

                    <div class="page-btn">
                        <a style="width: 250px" href="{{ route('all.batch') }}" class="btn btn-primary p-3">Batch Manager</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="{{ route('running.batch') }}">
                        <div class="dash-widget bg-primary">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">Running Batch</h5>
                            </div>
                        </div>
                    </a> --}}
                    <div class="page-btn">
                        <a style="width: 250px" href="{{ route('running.batch') }}" class="btn btn-primary p-3">Running
                            Batch</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="{{ route('student.list') }}">
                        <div class="dash-widget bg-primary">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">Student Manager</h5>
                            </div>
                        </div>
                    </a> --}}
                    <div class="page-btn">
                        <a style="width: 250px" href="{{ route('student.list') }}" class="btn btn-primary p-3">Student
                            Manager</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="{{ route('chose.course') }}">
                        <div class="dash-widget bg-primary">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">Add Student</h5>
                            </div>
                        </div>
                    </a> --}}
                    <div class="page-btn">
                        <a style="width: 250px" href="{{ route('chose.course') }}" class="btn btn-primary p-3">Add
                            Student</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="{{ route('add.payment') }}">
                        <div class="dash-widget bg-primary">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">Add Payment</h5>
                            </div>
                        </div>
                    </a> --}}
                    <div class="page-btn">
                        <a style="width: 250px" href="{{ route('add.payment') }}" class="btn btn-primary p-3">Add
                            Payment</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="{{ route('expense.list') }}">
                        <div class="dash-widget bg-primary">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">Expenses</h5>
                            </div>
                        </div>
                    </a> --}}
                    <div class="page-btn">
                        <a style="width: 250px" href="{{ route('expense.list') }}" class="btn btn-primary p-3">Expenses</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-5">
                    {{-- <a href="">
                        <div class="dash-widget bg-primary">
                            <div class="dash-widgetcontent">
                                <h5 class="text-white">All Dues</h5>
                            </div>
                        </div>
                    </a> --}}
                    <div class="page-btn">
                        <a style="width: 250px" href="" class="btn btn-primary p-3">Expenses</a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $total_student }}</h4>
                            <h5>Total Students</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>{{ $active_student }}</h4>
                            <h5>Active Students</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>{{ $Pending_student }}</h4>
                            <h5>Pending Students</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>105</h4>
                            <h5>Sales Invoice</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
