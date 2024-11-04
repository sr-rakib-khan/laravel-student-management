@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')
            ->where('id', $student->course_id)
            ->first();

        $batch = DB::table('batches')
            ->where('id', $student->batch_id)
            ->first();

        $section = DB::table('sections')
            ->where('id', $student->section_id)
            ->first();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Student Profile/ Account Info</h2>
                </div>
                <div class="col-md-6 mt-3 text-end">
                    <a type="button" href="" class="btn btn-primary">Account</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="profile-set">
                        <div class="profile-head row">
                            <div class="col-md-6 mt-3">
                                <h3><Strong>ID:</Strong> {{ $student->student_id }} | <strong>Name:</strong>
                                    {{ $student->student_name }}</h3>
                            </div>
                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    @if ($student->photo)
                                        <img src="{{ asset($student->photo) }}" alt="img" id="blah" />
                                    @else
                                        <img src="{{ asset('assets/img/customer/customer5.jpg') }}" alt="img"
                                            id="blah" />
                                    @endif
                                </div>
                                <div style="width: 300px" class="profile-contentname">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Status</strong></td>
                                                @if ($student->status == 1)
                                                    <td class="text-success text-end">Active</td>
                                                @else
                                                    <td class="text-danger text-end">Inactive</td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <td><strong>Gender</strong></td>
                                                <td class="text-end">{{ $student->gender }}/ {{ $student->religion }}</td>
                                            </tr>
                                            <tr>
                                                <td><a class="btn btn-primary btn-sm text-white" type="button"
                                                        href="">Send
                                                        Sms</a></td>
                                                <td class="text-end"><a type="button" class="btn btn-info btn-sm"
                                                        href="tel:{{ $student->sms_mobile }}">Call
                                                        {{ $student->sms_mobile }}</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="width: 300px" class="profile-contentname">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Course</strong></td>
                                                <td class="text-end">{{ $course->course_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Session</strong></td>
                                                <td class="text-end">{{ $batch->session }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Shift</strong></td>
                                                <td class="text-end">{{ $section->section_name }}
                                                    ({{ $section->schedule_day }} |
                                                    {{ $section->schedule_time }})</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="width: 300px" class="profile-contentname">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Batch</strong></td>
                                                <td class="text-end">{{ $batch->batch_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monthly Fee</strong></td>
                                                <td class="text-end">{{ $batch->monthly_fee }} tk</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monthly Discount</strong></td>
                                                @if ($student->discount)
                                                    <td class="text-end">{{ $student->discount }}</td>
                                                @else
                                                    <td class="text-end">00.00 tk</td>
                                                @endif

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="border-top: 2px solid" class="card">
                <div class="card-body">
                    <div class="row pt-3 pb-3 text-center">
                        <div class="col-md-3">
                            <h4>Account Info</h4>
                        </div>

                        <div class="col-md-3">
                            <a class="btn btn-primary" href="">Monthly Discount</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-success" href="">Add Payment</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-info" href="">Add Invidual Fee</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-secondary" href="">Finacial Report</a>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table">
                            <tr class="table-row">
                                <th>#</th>
                                <th>Fee Title</th>
                                <th>Tusion fee</th>
                                <th>Common fee</th>
                                <th>Monthly discount</th>
                                <th>Extra discount</th>
                                <th>Dues</th>
                                <th>Total</th>
                                <th>Pay Amount</th>
                            </tr>
                            <tr>
                                <td>01</td>
                                <td>Admission</td>
                                <td>1000</td>
                                <td>250</td>
                                <td>250</td>
                                <td>00.0</td>
                                <td>00.0</td>
                                <td>00.0</td>
                                <td>1000</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
