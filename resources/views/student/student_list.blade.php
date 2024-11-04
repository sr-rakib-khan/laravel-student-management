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
                                    <select name="year" class="select" id="year" required>
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
            @if (isset($course_id))
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
                                $student = DB::table('students')->where('course_id', $course_id)->get();
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
                                        <td>{{ $item->student_name }}</td>
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
            @endif

        </div>
    </div>
    {{-- jquery ajax cdn  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- active student ajax code
    <script type="text/javascript">
        $(document).on('click', '.active', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'get',
                success: function(response) {
                    toastr.success(response);
                    $('.status').load(location.href + ' .status');
                }
            });
        });
    </script>

    {{-- inactive student ajax code  --}}

    {{-- <script type="text/javascript">
        $(document).on('click', '.inactive', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'get',
                success: function(response) {
                    toastr.success(response);
                    $('.status').load(location.href + ' .status');
                }
            });
        });
    </script> --}}

@endsection
