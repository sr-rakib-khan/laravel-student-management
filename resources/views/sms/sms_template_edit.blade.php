@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>SMS Template Edit</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('sms.template') }}" class="btn btn-added">SMS Template</a>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('template.update') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $template->id }}" name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Title</label>
                            <div class="col-lg-9">
                                <input type="text" name="title" value="{{ $template->title }}" class="form-control"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Message</label>
                            <div class="col-lg-9">
                                <textarea name="message" id="" cols="30" rows="05">{{ $template->message }}</textarea>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
