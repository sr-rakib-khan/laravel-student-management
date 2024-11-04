@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')->where('status', 1)->get();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Batch</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('all.batch') }}" class="btn btn-primary">Batch Manager</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('batch.upate') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $batch->id }}" name="id">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Academic Course <span class="text-danger">*</span></label>
                            <select name="course_id" class="form-control form-small select" required>
                                <option disabled selected="selected">---Select---</option>
                                @foreach ($course as $item)
                                    <option value="{{ $item->id }}" @if ($batch->course_id == $item->id) selected @endif>
                                        {{ $item->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Session Year <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $batch->session }}" name="session" class="form-control"
                                required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Batch Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $batch->batch_name }}" name="batch_name" class="form-control"
                                required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Batch Students Monthly Fee(tk) <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $batch->monthly_fee }}" name="fee" class="form-control"
                                required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-3" for="validationCustom01"><strong>Status:</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" @if ($batch->status == 1) checked @endif
                                    type="radio" name="status" value="1">
                                <label class="form-check-label">
                                    Running
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    @if ($batch->status == 2) checked @endif value="2">
                                <label class="form-check-label">
                                    Complete
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status"
                                    @if ($batch->status == 3) checked @endif value="3">
                                <label class="form-check-label">
                                    Draft
                                </label>
                            </div>
                            <div class="col-md-12 mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Update Batch</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
