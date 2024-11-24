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
                                @php
                                    $student_count = DB::table('students')
                                        ->where('batch_id', $item->id)
                                        ->count();
                                @endphp

                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item->batch_name }}</td>
                                    <td>{{ $item->session }}</td>
                                    <td>{{ $item->monthly_fee }}.00</td>
                                    <td>
                                        <form action="{{ route('search.students') }}" method="post">
                                            <a type="button" class="btn btn-sm btn-primary text-white"
                                                href="{{ route('batch.studentlist', $item->id) }}">Students({{ $student_count }})</a>
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="batch_id">
                                            <input type="hidden" value="{{ $item->course_id }}" name="course_id">
                                            <button type="submit" class="btn btn-success btn-sm text-white">Add
                                                Payment</button>
                                            <a type="button" class="btn btn-sm btn-secondary text-white"
                                                href="{{ route('student.fee', $item->id) }}">Batch Fee</a>
                                            <a type="button" class="btn btn-info btn-sm text-white" href=""><i
                                                    class="fa-solid fa-print"></i> Account Summary</a>
                                        </form>
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
