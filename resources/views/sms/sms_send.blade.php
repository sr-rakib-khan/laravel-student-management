@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>SMS Settings</h4>
                    <h6>Manage sms settings</h6>
                </div>
                <div class="page-btn">
                    <a href="" class="btn btn-added">SMS Log</a>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('sms.send') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS To</label>
                            <div class="col-lg-9">
                                <input type="text" name="to" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS Text</label>
                            <div class="col-lg-9">
                                <textarea name="sms" id="" rows="5"></textarea>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
