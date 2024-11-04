@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Fee Head Edit</h2>
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
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a href="{{ route('student.fee') }}" class="btn btn-success">All Fee Head</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col-md-8">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Fee Head Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $feehead->feehead_name }}" name="fehead_name"
                                class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control form-small select" required>
                                <option value="1" @if ($feehead->status == 1) selected @endif>Active</option>
                                <option value="0" @if ($feehead->status == 0) selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
