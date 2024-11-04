@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Edit Student</h2>
                </div>
            </div>
            @php
                $courses = DB::table('courses')->get();
                $section = DB::table('sections')->get();
                $batch = DB::table('batches')->get();

                $std_course = DB::table('courses')
                    ->where('id', $student->course_id)
                    ->first();

                $std_batch = DB::table('batches')
                    ->where('id', $student->batch_id)
                    ->first();
            @endphp
            <form action="{{ route('student.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $student->id }}">
                <input type="hidden" name="old_photo" value="{{ $student->photo }}">
                <div class="card-header bg-success">
                    <h5 class="text-white">01. Course Information</h5>
                    <div class="card-title text-white">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Admission: <Strong>{{ $std_course->course_name }}</Strong></h6>
                            </div>
                            <div class="col-md-6">
                                <h5>Session Year: <strong>{{ $std_batch->session }}</strong></h5>
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
                                    <option selected disabled>---Select---</option>
                                    @foreach ($section as $item)
                                        <option @if ($student->section_id == $item->id) selected @endif
                                            value="{{ $item->id }}">
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
                                        <option @if ($student->batch_id == $item->id) selected @endif
                                            value="{{ $item->id }}">{{ $item->batch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Monthly regular Discount (for this course) taka</label>
                                <input type="number" name="discount" value="{{ $student->discount }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <textarea name="note" class="form-control">{{ $student->note }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Student Institute Name</label>
                                <input type="text" name="institute_name" value="{{ $student->institute_name }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-check form-switch">
                                <input @if ($student->status == 1) checked @endif name="status"
                                    class="form-check-input" value="{{ $student->status == 1 ? 1 : 0 }}" type="checkbox">
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
                                <img style="width: 80px" height="80px" src="{{ asset($student->photo) }}" alt="photo">
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
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Full Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="student_name" class="form-control"
                                value="{{ $student->student_name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control form-small select" required>
                                <option disabled selected>---Select---</option>
                                <option @if ($student->gender == 'Male') selected @endif value="Male">Male
                                </option>
                                <option @if ($student->gender == 'Female') selected @endif value="Female">Female
                                </option>
                                <option @if ($student->gender == 'Others') selected @endif value="Others">Others
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Religion <span class="text-danger">*</span></label>
                            <select name="religion" class="form-control form-small select">
                                <option @if ($student->religion == 'Muslim') selected @endif value="Muslim">Muslim
                                </option>
                                <option @if ($student->religion == 'Hindu') selected @endif value="Hindu">Hindu
                                </option>
                                <option @if ($student->religion == 'Buddhist') selected @endif value="Buddhist">Buddhist
                                </option>
                                <option @if ($student->religion == 'Christian') selected @endif value="Christian">
                                    Christian</option>
                                <option @if ($student->religion == 'Others') selected @endif value="Others">Others
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Student SMS Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $student->sms_mobile }}" name="sms_mobile" required>
                        </div>
                    </div>
                    <h4 class="bg-secondary mb-3 text-white">Guardians Info</h4>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Father's Name <span class="text-danger">*</span></label>
                            <input name="father_name" type="text" class="form-control"
                                value="{{ $student->father_name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Mother's Name <span class="text-danger">*</span></label>
                            <input name="mother_name" value="{{ $student->mother_name }}" type="text"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Guardian Mobile</label>
                            <input name="guardian_mobile" value="{{ $student->guardian_mobile }}" type="text"
                                class="form-control">
                        </div>
                    </div>
                    <h4 class="bg-secondary mb-3 text-white">Student Address</h4>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <textarea name="address" class="form-control">{{ $student->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12 mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
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
