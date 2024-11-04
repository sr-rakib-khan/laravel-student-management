@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Course Section & Schedule</h4>
                </div>
                <div class="page-btn">
                    <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#courseaddmodal"><img
                            src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1" />Add New
                        Course</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="border-bottom">
                        <form action="{{ route('search.section') }}" method="post">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <select name="course_id" class="form-control form-small select">
                                        <option selected="selected" disabled>Chose Course</option>
                                        @foreach ($course as $item)
                                            <option value="{{ $item->id }}">{{ $item->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                                <div class="col-lg-2"></div>
                            </div>
                        </form>
                    </div>
                    @if (isset($section))
                        <div class="table-top mt-3">
                            <div class="search-set">
                                <div class="search-input">
                                    <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}"
                                            alt="img" /></a>
                                </div>
                            </div>
                            <a class="float-end btn btn-success" data-bs-toggle="modal" data-bs-target="#sectionaddmodal"
                                href="">+Add Section</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Course Name</th>
                                        <th>Section name</th>
                                        <th>Schedule day</th>
                                        <th>Schedule time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($section)
                                        @foreach ($section as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->course->course_name }}</td>
                                                <td>{{ $item->section_name }}</td>
                                                <td>{{ $item->schedule_day }}</td>
                                                <td>{{ $item->schedule_time }}</td>
                                                @if ($item->status == 1)
                                                    <td class="badge text-white bg-success">Acitve</td>
                                                @else
                                                    <td class="badge text-white bg-danger">Inactive</td>
                                                @endif


                                                <td>
                                                    <a class="me-3" href="{{ route('section.edit', $item->id) }}">
                                                        <img src="{{ asset('assets/img/icons/edit.svg') }}"
                                                            alt="img" />
                                                    </a>
                                                    <a class="confirm-text delete"
                                                        href="{{ route('section.delete', $item->id) }}">
                                                        <img src="{{ asset('assets/img/icons/delete.svg') }}"
                                                            alt="img" />
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- course add modal -->
    <div class="modal fade" id="sectionaddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Section</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('section.store') }}" method="post">
                    @csrf
                    @if (isset($course_id))
                        <input type="hidden" name="section_id" value="{{ $course_id }}">
                    @endif
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Section Name</label>
                            <input type="text" name="section_name" class="form-control" id="validationCustom01"
                                required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Schedule Day</label>
                            <input type="text" name="schedule_day" class="form-control" id="validationCustom01"
                                required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Schedule Time</label>
                            <input type="text" name="schedule_time" class="form-control" id="validationCustom01"
                                required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Status</label>
                            <select name="status" class="form-control form-small select">
                                <option selected="selected">Chose Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
