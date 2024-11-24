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
                    <a href="{{ route('sms.create') }}" class="btn btn-added">Send Sms</a>
                </div>
            </div>
            @php

            @endphp
            <div class="card">
                <div class="row m-3">
                    <div class="col-lg-4 col-sm-6 col-12 d-flex">
                        <div style="width: 250px; height:100px" class="bg-success rounded border">
                            <div class="m-3">
                                <h4 class="text-white text-center">SMS Rate</h4>
                                <p class="text-white text-center">1 SMS / 0.35</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 d-flex">
                        <div style="width: 250px; height:100px" class="bg-success rounded border">
                            <div class="m-3">
                                <h4 class="text-white text-center">Sent This Month</h4>
                                <p class="text-white text-center">{{ $smsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12 d-flex">
                        <div style="width: 250px; height:100px" class="bg-success rounded border">
                            <div class="m-3">
                                <h4 class="text-white text-center">Blance</h4>
                                <p class="text-white text-center">{{ $blance['balance'] }} tk</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('settings.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS Key</label>
                            <div class="col-lg-9">
                                <input type="text" name="key" value="{{ $sms_settings->sms_key }}"
                                    class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS Url</label>
                            <div class="col-lg-9">
                                <input type="text" name="url" value="{{ $sms_settings->sms_url }}"
                                    class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Helpline Nubmer</label>
                            <div class="col-lg-9">
                                <input type="text" name="helpline" value="{{ $sms_settings->helpline }}"
                                    class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Sender Id</label>
                            <div class="col-lg-9">
                                <input type="text" name="sender_id" value="{{ $sms_settings->sender_id }}"
                                    class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS Footer Text</label>
                            <div class="col-lg-9">
                                <input type="text" name="footer" value="{{ $sms_settings->footer_text }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS Sent Status</label>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="form-check col-lg-3">
                                        <input class="form-check-input" @if ($sms_settings->status == 1) checked @endif
                                            value="1" type="radio" name="status" value="" id="invalidCheck"
                                            required />
                                        <label class="form-check-label" for="invalidCheck"> Enable
                                        </label>
                                    </div>
                                    <div class="form-check col-lg-3">
                                        <input class="form-check-input" @if ($sms_settings->status == 0) checked @endif
                                            value="0" type="radio" name="status" value="" id="invalidCheck"
                                            required />
                                        <label class="form-check-label" for="invalidCheck"> Disable
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Svae Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
