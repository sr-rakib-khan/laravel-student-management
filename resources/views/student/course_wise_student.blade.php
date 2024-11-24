@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Students</h2>
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
                            @foreach ($sutdents as $key => $item)
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
