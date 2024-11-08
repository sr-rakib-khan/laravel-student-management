@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>All Running Batch</h2>
                </div>
                <div class="page-btn">
                    <a href="{{ route('all.batch') }}" class="btn btn-primary">Batch Manager</a>
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
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Batch Name</th>
                                <th>Session Year</th>
                                <th>Monthly Fees</th>
                                <th>Action Links</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($running_batch as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item->batch_name }}</td>
                                    <td>{{ $item->session }}</td>
                                    <td>{{ $item->monthly_fee }}.00</td>
                                    <td>
                                        <a class="badge rounded-pill bg-primary" href="">Students()</a>
                                        <a class="badge rounded-pill bg-success" href="">Add Payment</a>
                                        <a class="badge rounded-pill bg-secondary"
                                            href="{{ route('batchfee.list', $item->id) }}">Batch Fee</a>
                                        <a class="badge rounded-pill bg-info" href=""><i
                                                class="fa-solid fa-print"></i> Account Summary</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
