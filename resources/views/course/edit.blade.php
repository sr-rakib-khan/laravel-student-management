@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Course Edit</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('all.course') }}" class="btn btn-added">All Course</a>
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
                    <div>
                        <form action="{{ route('course.update') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $course->id }}" name="id">
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom01">Course name</label>
                                <input type="text" name="course_name" class="form-control" id="validationCustom01"
                                    value="{{ $course->course_name }}" required />
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom01">Status</label>
                                <select name="status" class="form-control form-small select">
                                    <option value="1" @if ($course->status == 1) selected @endif>Active</option>
                                    <option value="0" @if ($course->status == 0) selected @endif>Inactive
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
