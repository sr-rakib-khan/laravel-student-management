@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Batch-Fee</h2>
                </div>
            </div>
            <div class="mb-5 bg-success">
                <div class="row pt-4 pb-4 text-center text-white">
                    <div class="col-md-3">Course: <strong>{{ $batch->course_name }}</strong></div>
                    <div class="col-md-3">Batch: <strong>{{ $batch->batch_name }}</strong></div>
                    <div class="col-md-3">Monthly Fee: <strong>{{ $batch->monthly_fee }}</strong></div>
                    <div class="col-md-3">Status: @if ($batch->status == 1)
                            <strong>Running</strong>
                        @elseif($batch->status == 2)
                            <strong>Completed</strong>
                        @else
                            <strong>Draft</strong>
                        @endif
                    </div>
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
                                    <button data-bs-toggle="modal" data-bs-target="#batchfeeddmodal"
                                        class="btn btn-success">+
                                        Add new Fee</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Fee Head</th>
                                <th>Fee Name</th>
                                <th>Fee Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batchfee as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->feehead_name }}</td>
                                    <td>{{ $item->fee_name }}</td>
                                    <td>{{ $item->fee_amount }}</td>
                                    <td>
                                        <a class="me-3" href="{{route('edit.batchfee', $item->id)}}">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a class="me-3" href="{{route('delete.batchfee', $item->id)}}">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- batch fee add modal -->
    <div class="modal fade" id="batchfeeddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Batch Fee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    $feehead = DB::table('feeheads')->get();
                @endphp
                <form action="{{ route('batchfee.store') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $batch->course_id }}" name="course_id">
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Fee Head <span class="text-danger">*</span></label>
                            <select name="feehead_id" class="form-control form-small select" required>
                                @foreach ($feehead as $item)
                                    <option value="{{ $item->id }}">{{ $item->feehead_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Fee Name <span class="text-danger">*</span></label>
                            <input type="text" name="fee_name" class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Fee Amount <span class="text-danger">*</span></label>
                            <input type="text" name="fee_amount" class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
