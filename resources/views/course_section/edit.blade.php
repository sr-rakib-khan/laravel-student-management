@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Course-Section Edit</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('course.section.index') }}" class="btn btn-added">Find Section</a>
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
                        <form action="{{ route('course-section.update') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $section->course->id }}" name="course_id">
                            <input type="hidden" value="{{ $section->id }}" name="id">
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom01">Section name</label>
                                <input type="text" name="section_name" class="form-control" id="validationCustom01"
                                    value="{{ $section->section_name }}" required />
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom01">Schedule Day</label>
                                <input type="text" name="schedule_day" class="form-control" id="validationCustom01"
                                    value="{{ $section->schedule_day }}" required />
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom01">Schedule name</label>
                                <input type="text" name="schedule_time" class="form-control" id="validationCustom01"
                                    value="{{ $section->schedule_time }}" required />
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom01">Status</label>
                                <select name="status" class="form-control form-small select">
                                    <option value="1" @if ($section->status == 1) selected @endif>Active</option>
                                    <option value="0" @if ($section->status == 0) selected @endif>Inactive
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Section</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
