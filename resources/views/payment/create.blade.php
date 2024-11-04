@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Payment</h4>
                    <h6>Create Batch Add payments</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-body pb-0">
                        <div class="row">
                            @php
                                $courses = DB::table('courses')->where('status', 1)->get();
                                $batches = DB::table('batches')->where('status', 1)->get();
                            @endphp
                            <form action="{{ route('search.students') }}" method="post">
                                @csrf
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select" name="course_id" id="course">
                                                    <option disabled selected>Select Course</option>
                                                    @foreach ($courses as $item)
                                                        <option value="{{ $item->id }}">{{ $item->course_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('course_id'))
                                                    <span class="text-danger">{{ $errors->first('course_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select" name="batch_id" id="batch">
                                                    <option disabled selected>Select Batch</option>
                                                    <option disabled selected>**first select course**</option>
                                                </select>
                                                @if ($errors->has('batch_id'))
                                                    <span class="text-danger">{{ $errors->first('batch_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-filters ms-auto"><img
                                                        src="{{ asset('assets/img/icons/search-whites.svg') }}"
                                                        alt="img" /></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#course').on('change', function() {
                var courseId = $(this).val();
                if (courseId) {
                    $.ajax({
                        url: "{{ route('get.batches') }}",
                        type: "POST",
                        data: {
                            course_id: courseId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#batch').html('<option disabled selected>Select Batch</option>');
                            $.each(data, function(key, batch) {
                                $('#batch').append('<option value="' + batch.id + '">' +
                                    batch.batch_name + ' | ' + batch.session +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#batch').html(
                        '<option disabled selected>Select Batch</option><option disabled>**first select course**</option>'
                        );
                }
            });
        });
    </script>
@endsection
