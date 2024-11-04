@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Find Student For Promotion</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('find.student') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" name="id" class="form-control"
                                        placeholder="Enter Student ID">
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-6 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Find Student</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
