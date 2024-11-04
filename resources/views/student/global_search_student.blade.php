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
                    <h2>Student Profile</h2>
                </div>
                <div class="col-md-6 mt-3 text-end">
                    <a type="button" href="{{ route('student.account', $student->id) }}" class="btn btn-primary">Account</a>
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
                    <div class="row">
                        <h3 class="bg-success text-white">Student Info</h3>
                        <div>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td class="text-end">{{ $student->student_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Father's Name</strong></td>
                                        <td class="text-end">{{ $student->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mother's Name</strong></td>
                                        <td class="text-end">{{ $student->mother_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Guardians Mobile</strong></td>
                                        <td class="text-end">{{ $student->guardian_mobile }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gender</strong></td>
                                        <td class="text-end">{{ $student->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Religion</strong></td>
                                        <td class="text-end">{{ $student->religion }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date of birth</strong></td>
                                        <td class="text-end">{{ $student->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Student Mobile</strong></td>
                                        <td class="text-end">{{ $student->sms_mobile }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td class="text-end">{{ $student->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row mt-5">
                        <h3 class="bg-success text-white">Acadamic Info</h3>
                        <div>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Course</strong></td>
                                        <td class="text-end">{{ $course->course_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Session Year</strong></td>
                                        <td class="text-end">{{ $batch->session }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Class Shift</strong></td>
                                        <td class="text-end">{{ $section->section_name }} ({{ $section->schedule_day }}) |
                                            {{ $section->schedule_time }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Session Batch</strong></td>
                                        <td class="text-end">{{ $batch->batch_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Admission Date</strong></td>
                                        <td class="text-end">{{ $student->admission_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
