@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Students</h2>
                </div>
            </div>
            @php
                $course = DB::table('courses')->where('status', 1)->get();
                $year = date('Y');
            @endphp
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('search.student') }}" method="post">
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
                                    <select name="session" class="select" id="year" required>
                                        <option value="">---Select Session Year---</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-12 col-sm-6 mt-4">
                                <button type="submit" class="btn btn-submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
