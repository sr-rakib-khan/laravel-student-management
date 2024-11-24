@extends('layouts.admin')
@section('page-content')
    @php
        $batch = DB::table('batches')->where('id', $batch_id)->first();
        $course = DB::table('courses')
            ->where('id', $batch->course_id)
            ->first();

        $sections = DB::table('sections')
            ->where('course_id', $course->id)
            ->get();

        $batch_std_count = DB::table('students')
            ->where('batch_id', $batch->id)
            ->count();

    @endphp

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Batch Students</h2>
                </div>
                <div class="page-title">
                    <form action="{{ route('search.students') }}" method="post">
                        <a type="button" class="btn btn-sm btn-success"
                            href="{{ route('batch.active.student', $batch_id) }}">Active
                            Student</a>
                        <a type="button" class="btn btn-sm btn-danger"
                            href="{{ route('batch.inactive.student', $batch_id) }}">Inactive Student</a>
                        <a type="button" class="btn btn-sm btn-info" href="{{ route('chose.course') }}">Add Student</a>
                        <a type="button" class="btn btn-sm btn-success" href="{{ route('student.fee') }}">Fee</a>
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                        <button type="submit" class="btn btn-sm btn-primary">Add Payment</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-md-3"><strong>Course:</strong>{{ $course->course_name }}</div>
                        <div class="col-md-3"><strong>Batch:</strong>{{ $batch->batch_name }}</div>
                        <div class="col-md-3"><strong>Monthly fee:</strong>{{ $batch->monthly_fee }}</div>
                        <div class="col-md-3"><strong>Status:</strong>
                            @if ($batch->status == 1)
                                <span class="text-success"> Running</span>
                            @else
                                <span class="text-success"> Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <a class="btn btn-secondary btn-sm" href="{{ route('batch.studentlist', $batch->id) }}">
                                All ({{ $batch_std_count }})
                            </a>
                            @foreach ($sections as $item)
                                @php
                                    $sec_std_count = DB::table('students')
                                        ->where('section_id', $item->id)
                                        ->count();
                                @endphp
                                <a title="{{ $item->schedule_day }} - {{ $item->schedule_time }}"
                                    class="btn btn-success btn-sm"
                                    href="{{ route('section.students', ['id' => $item->id, 'batch_id' => $batch->id]) }}">
                                    {{ $item->section_name }} ({{ $sec_std_count }})
                                </a>
                            @endforeach
                        </div>
                    </div>


                    {{-- <div class="row mt-3">
                        <div class="col-md-2"><a class="btn btn-secondary btn-sm"
                                href="{{ route('batch.studentlist', $batch->id) }}">All ({{ $batch_std_count }})</a></div>
                        @foreach ($sections as $item)
                            @php
                                $sec_std_count = DB::table('students')
                                    ->where('section_id', $item->id)
                                    ->count();
                            @endphp
                            <div class="col-md-2"><a title="{{ $item->schedule_day }} - {{ $item->schedule_time }}"
                                    class="btn btn-success btn-sm"
                                    href="{{ route('section.students', ['id' => $item->id, 'batch_id' => $batch->id]) }}">{{ $item->section_name }}
                                    ({{ $sec_std_count }})
                                </a>
                            </div>
                        @endforeach
                    </div> --}}
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
                </div>

                <div id="stddata" class="table-responsive">
                    <table class="table datanew">
                        @php
                        @endphp
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student Id</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Class Shift</th>
                                <th>Batch</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch_studentlist as $key => $item)
                                @php
                                    $batch = DB::table('batches')
                                        ->where('id', $item->batch_id)
                                        ->first();

                                    $section = DB::table('sections')
                                        ->where('id', $item->section_id)
                                        ->first();
                                @endphp
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->student_id }}</td>
                                    <td><a
                                            href="{{ route('view.student-details', $item->id) }}">{{ $item->student_name }}</a>
                                    </td>
                                    @if ($item->photo)
                                        <td><img width="40px" src="{{ asset($item->photo) }}" alt=""></td>
                                    @else
                                        <td><img width="40px" src="{{ asset('assets/students/images (1).jfif') }}"
                                                alt=""></td>
                                    @endif
                                    <td>{{ $section->section_name }}({{ $section->schedule_day }} -
                                        {{ $section->schedule_time }})
                                    </td>
                                    <td>{{ $batch->batch_name }}</td>
                                    <td>{{ $item->sms_mobile }}</td>
                                    @if ($item->status == 1)
                                        <td class="status"><a href="{{ route('inactive.studentlist', $item->id) }}"
                                                class="btn inactive btn-success btn-sm text-white" type="button">Active</a>
                                        </td>
                                    @else
                                        <td><a href="{{ route('active.studentlist', $item->id) }}"
                                                class="btn acitve btn-danger btn-sm text-white" type="button">Inactive</a>
                                        </td>
                                    @endif
                                    <td>
                                        <a title="view" class="me-3"
                                            href="{{ route('view.student-details', $item->id) }}">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" />
                                        </a>
                                        <a class="me-3" href="{{ route('edit.student', $item->id) }}">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a class="me-3 delete-item" href="{{ route('student.delete', $item->id) }}">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
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
@endsection
