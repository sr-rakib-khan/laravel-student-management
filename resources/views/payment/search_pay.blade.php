@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')->where('status', 1)->get();

    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="row mb-3">
                <div class="col-md-3">
                    <h4>Batch Add Payments</h4>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-2 text-end">
                    <a href="" class="btn btn-primary btn-sm">Add New Payment</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('show.payment.list') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select name="course_id" id="course" class="select">
                                        <option>Choose Course</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select name="batch_id" id="batch" class="select">
                                        <option value="">Choose Batch</option>
                                        <option value="">**first select course**</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select name="section_id" id="section" class="form-control">
                                        <option>Choose Section</option>
                                        <option>**first select course**</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input name="start_date" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12">
                                <h6 class="text-center mt-1">to</h6>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input name="end_date" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                                <a type="button" href="" class="btn btn-danger">Print</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Monthly Discount</th>
                                <th>Ac Status</th>
                                <th>Discount Amount</th>
                                <th>Pay Amount</th>
                                <th>Fee Head</th>
                                <th>Check</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>

                                    <button class="btn btn-sm btn-primary" type="submit">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#course').on('change', function() {
                var courseId = $(this).val();

                if (courseId) {
                    var url = '{{ route('get.batch.section', ':courseId') }}'.replace(':courseId',
                        courseId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Batch Dropdown আপডেট করা
                            $('#batch').empty();
                            $('#batch').append('<option value="">Choose Batch</option>');
                            $.each(data.batches, function(key, value) {
                                $('#batch').append('<option value="' + value.id + '">' +
                                    value.batch_name + '</option>');
                            });

                            // Section Dropdown আপডেট করা
                            $('#section').empty();
                            $('#section').append('<option value="">Choose Section</option>');
                            $.each(data.sections, function(key, value) {
                                $('#section').append('<option value="' + value.id +
                                    '">' + value.section_name + '( ' + value
                                    .schedule_day + ' || ' + value
                                    .schedule_time + ')' +
                                    '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#batch').empty().append('<option value="">Choose Batch</option>');
                    $('#section').empty().append('<option value="">Choose Section</option>');
                }
            });
        });
    </script>
@endsection
