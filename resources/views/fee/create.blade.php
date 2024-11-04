@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Student Tusion Fee</h4>
                    <p>Add Tusion fee for all students</p>
                </div>
            </div>
            @php
                $feehead = DB::table('feeheads')->get();
            @endphp
            <div class="row">
                <div class="col-md-1"></div>
                <div class="card col-md-6">
                    <form action="{{ route('fee.add') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Fee Head</label>
                                    <select name="fee_head" class="select">
                                        <option selected disabled>Choose head</option>
                                        @foreach ($feehead as $item)
                                            <option value="{{ $item->feehead_name }}">{{ $item->feehead_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('fee_head'))
                                        <span class="text-danger">{{ $errors->first('fee_head') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Year</label>
                                    <select name="year" class="select">
                                        <option selected disabled>select year</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="text-danger">{{ $errors->first('year') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fee Details</label>
                                <input type="text" name="fee_details" />
                                @if ($errors->has('fee_details'))
                                    <span class="text-danger">{{ $errors->first('fee_details') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>

        </div>
    </div>
@endsection
