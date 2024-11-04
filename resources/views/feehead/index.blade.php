@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>All Fee Head</h2>
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
                                    <button data-bs-toggle="modal" data-bs-target="#batchddmodal" class="btn btn-success">+
                                        Add new head</button>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feeheads as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->feehead_name }}</td>
                                    @if ($item->status == 1)
                                        <td class="text-success">Active</td>
                                    @elseif($item->status == 2)
                                        <td class="text-primary">Inactive</td>
                                    @endif
                                    <td>
                                        <a class="me-3" href="{{ route('feehead.edit', $item->id) }}">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
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

    <!-- batch add modal -->
    <div class="modal fade" id="batchddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Batch</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('feehead.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Fee Head Name <span class="text-danger">*</span></label>
                            <input type="text" name="fehead_name" class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control form-small select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
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
