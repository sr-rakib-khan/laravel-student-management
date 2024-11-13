@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Batch Manager</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('running.batch') }}" class="btn btn-primary">All Running Batch</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                                    <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
                                        alt="img" /></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <button data-bs-toggle="modal" data-bs-target="#batchddmodal" class="btn btn-success">+
                                        Add new batch</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @php
                        $course = DB::table('courses')->where('status', 1)->get();
                    @endphp
                    <div class="card mb-0" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <form action="{{ route('filter.data') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <select name="course_id" class="select">
                                                        <option disabled selected>All Course</option>
                                                        @foreach ($course as $item)
                                                            <option value="{{ $item->id }}">{{ $item->course_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <select name="session" name="session" class="select">
                                                        <option disabled selected>Select Session Year</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <select name="status" class="select">
                                                        <option disabled selected>Batch Type</option>
                                                        <option value="1">Running</option>
                                                        <option value="2">Complete</option>
                                                        <option value="3">Draft</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-filters ms-auto"><img
                                                            src="{{ asset('assets/img/icons/search-whites.svg') }}"
                                                            alt="img" /></button>
                                                </div>
                                            </div>
                                    </form>
                                    <div class="col-lg-1 col-sm-6 col-12">
                                        <div class="form-group">
                                            <a href="{{ route('all.batch') }}" class="btn btn-success">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Batch Name</th>
                                <th>Session Year</th>
                                <th>Monthly Fees</th>
                                <th>Status</th>
                                <th>Students</th>
                                <th>Links</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item->batch_name }}</td>
                                    <td>{{ $item->session }}</td>
                                    <td>{{ $item->monthly_fee }}.00</td>
                                    @if ($item->status == 1)
                                        <td class="text-success">Running</td>
                                    @elseif($item->status == 2)
                                        <td class="text-primary">Completed</td>
                                    @else
                                        <td class="text-secondary">Draft</td>
                                    @endif
                                    <td>100.00</td>
                                    <td>Admin</td>
                                    <td>
                                        <a class="me-3" href="{{ route('batch.edit', $item->id) }}">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a class="confirm-text delete" href="{{ route('batch.delete', $item->id) }}">
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

    <!-- batch add modal -->
    <div class="modal fade" id="batchddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Batch</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    $course = DB::table('courses')->where('status', 1)->get();
                @endphp
                <form action="{{ route('batch.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Academic Course <span class="text-danger">*</span></label>
                            <select name="course_id" class="form-control form-small select" required>
                                <option disabled selected="selected">---Select---</option>
                                @foreach ($course as $item)
                                    <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Session Year <span class="text-danger">*</span></label>
                            <input type="text" name="session" class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Batch Name <span class="text-danger">*</span></label>
                            <input type="text" name="batch_name" class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Batch Students Monthly Fee(tk) <span class="text-danger">*</span></label>
                            <input type="text" name="fee" class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-3" for="validationCustom01"><strong>Status:</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1" checked>
                                <label class="form-check-label">
                                    Running
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="2">
                                <label class="form-check-label">
                                    Complete
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="3">
                                <label class="form-check-label">
                                    Draft
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Batch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
