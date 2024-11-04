@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Batch Fee Edit</h2>
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
                @php
                    $feehead = DB::table('feeheads')->get();
                @endphp
                <div class="col">
                    <div class="col-md-8">
                        <form action="{{ route('update.batchfee') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $batchfee->id }}" name="fee_id">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom01">Fee Head <span class="text-danger">*</span></label>
                                <select name="feehead_id" class="form-control form-small select" required>
                                    @foreach ($feehead as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($batchfee->feehead_id == $item->id) selected @endif>
                                            {{ $item->feehead_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom01">Fee Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $batchfee->fee_name }}" name="fee_name" class="form-control"
                                    required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom01">Fee Amount <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $batchfee->fee_amount }}" name="fee_amount"
                                    class="form-control" required />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
