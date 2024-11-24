@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')->where('id', session('course_id'))->first();
        $batch = DB::table('batches')->where('id', session('batch_id'))->first();

    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="row mb-3">
                <div class="col-md-3">
                    <h4>Batch Add Payments</h4>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-2 text-end">
                    <a href="" class="btn btn-primary btn-sm">Add New Payment</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Choose Course</option>
                                    <option>course</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Choose Batch</option>
                                    <option>Batch</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Choose Section</option>
                                    <option>Section</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <input class="form-control" type="date">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <a type="button" href="" class="btn btn-danger">Print</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Monthly Discount</th>
                                <th>Ac Status</th>
                                <th>Discount Amount</th>
                                <th>Pay Amount</th>
                                <th>Fee Head</th>
                                <th>Check</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>

                                    <button class="btn btn-sm btn-primary" type="submit">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
