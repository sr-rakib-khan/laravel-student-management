@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Students</h2>
                </div>
            </div>
            @php
                $course = DB::table('courses')->where('status', 1)->get();
                $year = date('Y');
            @endphp
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('search.student') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Addmission Course <span class="text-danger">*</span></label>
                                    <select name="course_id" class="select" id="course" required>
                                        <option value="">---Select---</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Session Year <span class="text-danger">*</span></label>
                                    <select name="session" class="select" id="year" required>
                                        <option value="">---Select Session Year---</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 col-sm-6 mt-4">
                                <button type="submit" class="btn btn-submit">Search</button>
                            </div>
                        </div>
                    </form>
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
                                    <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#sedngroupsms" title="Send Sms">Send Group Sms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="stddata" class="table-responsive">
                        <table class="table datanew">
                            @php
                                $student = DB::table('students')
                                    ->where('course_id', session('stdmanage_course_id'))
                                    ->get();

                                $student_count = DB::table('students')
                                    ->where('course_id', session('stdmanage_course_id'))
                                    ->count();
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
                                @foreach ($student as $key => $item)
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
                                        <td>{{ $section->section_name }} ({{ $section->schedule_day }} -
                                            {{ $section->schedule_time }}) </td>
                                        <td>{{ $batch->batch_name }}</td>
                                        <td>{{ $item->sms_mobile }}</td>
                                        @if ($item->status == 1)
                                            <td class="status"><a href="{{ route('inactive.studentlist', $item->id) }}"
                                                    class="btn inactive btn-success btn-sm text-white"
                                                    type="button">Active</a>
                                            </td>
                                        @else
                                            <td><a href="{{ route('active.studentlist', $item->id) }}"
                                                    class="btn acitve btn-danger btn-sm text-white"
                                                    type="button">Inactive</a>
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
    </div>

    @php
        $course_name = DB::table('courses')->where('id', session('stdmanage_course_id'))->first();
    @endphp

    <!-- group send sms Modal -->
    <div class="modal fade" id="sedngroupsms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sedngroupsms">Send SMS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sendgroup.sms') }}" method="post">
                        @csrf
                        <input type="hidden" name="course_id" id="course-id" value="{{ $course_name->id }}">
                        <div class="mb-3">
                            <label for="send to" class="form-label">Send to ({{ $student_count }})</label>
                            <input type="text" value="All ({{ $course_name->course_name }}) Students"
                                class="form-control" id="all-student" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Sms text</label>
                            <textarea name="sms_text" id="sms-text" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                </form>
            </div>
        </div>
    </div>






    {{-- jquery ajax cdn  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#sedngroupsms form').on('submit', function(event) {
                event.preventDefault();

                let smsText = $('#sms-text').val();
                let courseId = $('#course-id').val();

                // Ajax call
                $.ajax({
                    url: "{{ route('sendgroup.sms') }}", // Laravel rotue
                    type: "POST",
                    data: {
                        sms_text: smsText,
                        course_id: courseId,
                        _token: "{{ csrf_token() }}" // CSRF token
                    },
                    success: function(response) {
                        toastr.success(response); // success notification
                        $('#sedngroupsms').modal('hide'); // Modal hide
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message ||
                            'Failed to send SMS.'); // error notification
                    }
                });
            });
        });
    </script>
@endsection
