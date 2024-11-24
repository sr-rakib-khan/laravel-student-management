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
                    <form action="" method="post">
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
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Section</option>
                                        <option>Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12">
                                <h6 class="text-center mt-1">to</h6>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input class="form-control" type="date">
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
                var batchDropdown = $('#batch');
                var message = $('#message');
                batchDropdown.empty(); // Clear the batch dropdown
                batchDropdown.append('<option value="">Choose Batch</option>'); // Default option

                if (courseId) {
                    // AJAX request
                    $.ajax({
                        url: '/get-batches/' + courseId, // Route for fetching batches
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    batchDropdown.append('<option value="' + value.id +
                                        '">' + value.batch_name + '</option>');
                                });
                                message.hide();
                            } else {
                                batchDropdown.append(
                                    '<option value="">No batches found</option>');
                            }
                        },
                        error: function() {
                            alert('Error fetching batch data.');
                        }
                    });
                } else {
                    message.show(); // Show message if no course is selected
                }
            });
        });
    </script>
@endsection
