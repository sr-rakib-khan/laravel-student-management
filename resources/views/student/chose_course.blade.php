@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Add Student</h2>
                </div>
            </div>
            @php
                $course = DB::table('courses')->where('status', 1)->get();
                $year = date('Y');
            @endphp
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('create.student') }}" method="post">
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
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 col-sm-6 mt-4">
                                <button type="submit" class="btn btn-submit">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
