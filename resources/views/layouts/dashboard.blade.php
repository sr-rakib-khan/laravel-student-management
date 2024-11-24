@extends('layouts.admin')
@section('page-content')
    @php
        $total_student = DB::table('students')->count();
        $active_student = DB::table('students')->where('status', 1)->count();
        $Pending_student = DB::table('students')->where('status', 0)->count();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <h2>Welcome to <strong class="text-success">{{ auth()->user()->name }}</strong></h2>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">

                            <div class="page-btn">
                                <a style="width: 250px" href="{{ route('all.batch') }}" class="btn btn-primary p-3">Batch
                                    Manager</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">
                            <div class="page-btn">
                                <a style="width: 250px" href="{{ route('running.batch') }}"
                                    class="btn btn-primary p-3">Running
                                    Batch</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">
                            <div class="page-btn">
                                <a style="width: 250px" href="{{ route('student.list') }}"
                                    class="btn btn-primary p-3">Student
                                    Manager</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">
                            <div class="page-btn">
                                <a style="width: 250px" href="{{ route('chose.course') }}" class="btn btn-primary p-3">Add
                                    Student</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">
                            <div class="page-btn">
                                <a style="width: 250px" href="{{route('all.due.addpayment')}}" class="btn btn-primary p-3">All Due Add Payment</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">
                            <div class="page-btn">
                                <a style="width: 250px" href="{{ route('add.payment') }}" class="btn btn-primary p-3">Add
                                    Payment</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-5">
                            <div class="page-btn">
                                <a style="width: 250px" href="{{ route('expense.list') }}"
                                    class="btn btn-primary p-3">Expenses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-color:" class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 d-flex">
                            <div class="dash-count das3">
                                <div class="dash-counts">
                                    <h4>{{ $total_student }}</h4>
                                    <h5>Total Students</h5>
                                </div>
                                <div class="dash-imgs">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 d-flex">
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

                        <div class="col-lg-4 col-sm-6 col-12 d-flex">
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
                        {{-- <div class="col-lg-4 col-sm-6 col-12 d-flex">
                            <div class="dash-count das3">
                                <div class="dash-counts">
                                    <h4>105</h4>
                                    <h5>Sales Invoice</h5>
                                </div>
                                <div class="dash-imgs">
                                    <i data-feather="file"></i>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
