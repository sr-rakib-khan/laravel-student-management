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
                $courses = DB::table('courses')->where('id', $course)->first();
                $section = DB::table('sections')->where('course_id', $course)->get();
                $batch = DB::table('batches')->where('course_id', $course)->get();
            @endphp
            <form action="{{ route('store.student') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $course }}" name="course_id">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="text-white">01. Course Information</h5>
                        <div class="card-title text-white">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Admission: <Strong>{{ $courses->course_name }}</Strong></h6>
                                </div>
                                <div class="col-md-6">
                                    <h5>Session Year: <strong>{{ $year }}</strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Class Shift & schedule <span class="text-danger">*</span></label>
                                    <select name="section_id" class="select" id="course" required>
                                        @foreach ($section as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->section_name }} ({{ $item->schedule_day }}
                                                ,{{ $item->schedule_time }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Batch <span class="text-danger">*</span></label>
                                    <select name="batch_id" class="select" id="year" required>
                                        @foreach ($batch as $item)
                                            <option value="{{ $item->id }}">{{ $item->batch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Monthly regular Discount (for this course) taka</label>
                                    <input type="number" name="discount" placeholder="No Discount" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <textarea name="note" class="form-control" placeholder="note (for this course)"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Student Institute Name</label>
                                    <input type="text" name="institute_name"
                                        placeholder="Enter student current school/collage name" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-check form-switch">
                                    <input name="status" class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Active Student (for this course)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success">
                        <h5 class="text-white">02. Student Information</h5>
                        <div class="card-title text-white">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h4 class="bg-secondary mb-3 text-white">Personal Info</h4>
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <div class="row">
                                        <label>Student Photo
                                            <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                                title="Clear Image">[ x ]</a></label>
                                        <div class="col-lg-2 col-sm-6 col-12">

                                            <div style="height: 100px; width:100px; overflow: hidden; border-radius: 50%;"
                                                class="custom-file-container__image-preview"></div>
                                        </div>
                                        <div style="margin-top: 75px" class="col-lg-10 col-sm-6 col-12">
                                            <label class="custom-file-container__custom-file">
                                                <input name="photo" type="file"
                                                    class="custom-file-container__custom-file__custom-file-input"
                                                    accept="image/*" />
                                                <span
                                                    class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Full Name (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="student_name" class="form-control"
                                        placeholder="Enter student full name in english" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="date_of_birth" placeholder="No Discount"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <select name="gender" class="form-control form-small select" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Religion <span class="text-danger">*</span></label>
                                    <select name="religion" class="form-control form-small select">
                                        <option selected value="Muslim">Muslim</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddhist">Buddhist</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Student SMS Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" name="sms_mobile" required>
                                </div>
                            </div>
                            <h4 class="bg-secondary mb-3 text-white">Guardians Info</h4>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Father's Name <span class="text-danger">*</span></label>
                                    <input name="father_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Mother's Name <span class="text-danger">*</span></label>
                                    <input name="mother_name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Guardian Mobile</label>
                                    <input name="guardian_mobile" type="text" class="form-control">
                                </div>
                            </div>
                            <h4 class="bg-secondary mb-3 text-white">Student Address</h4>
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-group">
                                    <textarea name="address" class="form-control" placeholder="Student address"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-check form-switch">
                                    <input name="sms" class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Send Admission Sms</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6 col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript"></script>
@endsection
