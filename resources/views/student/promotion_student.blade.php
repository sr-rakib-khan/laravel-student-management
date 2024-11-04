@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Student Promotion in Next Class</h2>
                </div>
                <div class="col-md-6 mt-3 text-end">
                    <a type="button" href="" class="btn btn-primary">Account</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('find.student') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" name="id" value="{{ old('id') }}" class="form-control"
                                        placeholder="Enter Student ID">
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-6 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Find Student</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if ($student)
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
                                                    <td class="text-end">{{ $student->gender }}/ {{ $student->religion }}
                                                    </td>
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
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-4 text-center">
                                <button data-bs-toggle="modal" data-bs-target="#promotion" class="btn btn-primary">Promotion
                                    to next Class</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div>
                    <p class="text-center text-danger">No record found</p>
                </div>
            @endif

        </div>
    </div>

    <div class="modal" id="promotion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student- Add Promotion Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    $course = DB::table('courses')->get();
                @endphp
                <div class="modal-body">
                    <form action="{{ route('promotion.student') }}" method="post">
                        @csrf
                        @if ($student)
                            <input type="hidden" name="id" value="{{ $student->id }}">
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="course">Select Course</label>
                                    <select id="course" class="form-select" name="course">
                                        <option value="">--select Item--</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="course">Select Session</label>
                                    <select id="session" class="form-select" name="session">
                                        <option value="">Select Item</option>
                                        <option id="session-op" disabled>At first select course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="course">Class Shift & Schedule</label>
                                    <select id="section" class="form-select" name="section" id="">
                                        <option value="">Select Item</option>
                                        <option disabled id="section-op">At first select course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="course">Select Batch</label>
                                    <select id="batch" class="form-select" name="batch">
                                        <option value="">Select Item</option>
                                        <option id="batch-op" disabled>At first select course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="course">Discount For This Course</label>
                                    <input name="discount" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- jquery ajax cdn  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        $(document).ready(function() {
            $('#course').on('change', function() {
                let courseID = $(this).val();
                if (courseID === "") {
                    $('#session').prop('disabled', true).html(
                        '<option value="">At first select course</option>');
                    $('#section').prop('disabled', true).html(
                        '<option value="">At first select course</option>');
                    $('#batch').prop('disabled', true).html(
                        '<option value="">At first select course</option>');
                } else {
                    // AJAX call to fetch data based on course ID
                    $.ajax({
                        url: '{{ route('student.getCourseData') }}', // Laravel route to fetch data
                        type: 'GET',
                        data: {
                            course_id: courseID
                        },
                        success: function(response) {
                            let sessionOptions = '<option value="">Select Session</option>';
                            let sectionOptions = '<option value="">Select Section</option>';
                            let batchOptions = '<option value="">Select Batch</option>';

                            $.each(response.batches, function(key, value) {
                                sessionOptions +=
                                    `<option value="${value.id}">${value.session}</option>`;
                            });

                            $.each(response.sections, function(key, value) {
                                sectionOptions +=
                                    `<option value="${value.id}">${value.section_name}</option>`;
                            });

                            $.each(response.batches, function(key, value) {
                                batchOptions +=
                                    `<option value="${value.id}">${value.batch_name}</option>`;
                            });

                            $('#session').prop('disabled', false).html(sessionOptions);
                            $('#section').prop('disabled', false).html(sectionOptions);
                            $('#batch').prop('disabled', false).html(batchOptions);
                        }
                    });
                }
            });
        });
    </script>
@endsection
