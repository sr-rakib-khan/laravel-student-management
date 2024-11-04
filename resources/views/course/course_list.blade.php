@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Course List</h4>
                    <h6>Manage your Course</h6>
                </div>
                <div class="page-btn">
                    <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#courseaddmodal"><img
                            src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1" />Add New
                        Course</button>
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
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Course Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->course_name }}</td>
                                        @if ($item->status == 1)
                                            <td class="badge text-white bg-success">Acitve</td>
                                        @else
                                            <td class="badge text-white bg-danger">Inacitve</td>
                                        @endif

                                        <td>
                                            <a class="me-3" href="{{ route('course.edit', $item->id) }}">
                                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                            </a>
                                            <a class="confirm-text delete" href="{{ route('course.delete', $item->id) }}">
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


    <!-- course add modal -->
    <div class="modal fade" id="courseaddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('course.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Course name</label>
                            <input type="text" name="course_name" class="form-control" id="validationCustom01"
                                placeholder="Course Name" required />
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
                        <button type="submit" class="btn btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
