@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Manage SMS Logs</h4>
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
                                    <button data-bs-toggle="modal" data-bs-target="#templateaddmodal"
                                        class="btn btn-success">Send SMS</button>
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
                                <th>Tile</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($smslog as $item => $value)
                                <tr>
                                    <td>{{ ++$item }}</td>
                                    <td>{{ $value->message }}</td>
                                    <td>{{ $value->recipient }}</td>
                                    <td>
                                        <a class="confirm-text delete" href="{{ route('delete.smslog', $value->id) }}">
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

    <!-- batch add modal -->
    <div class="modal fade" id="templateaddmodal" tabindex="-1" aria-labelledby="templateaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Sms</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sms.send') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Sms To</label>
                            <input type="text" name="to" class="form-control" required />
                        </div>
                        <div class="col-md-12 col-lg-12 mb-3">
                            <label for="message">Message</label>
                            <textarea name="sms" cols="60" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
