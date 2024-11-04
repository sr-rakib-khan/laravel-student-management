@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Manage SMS Template</h4>
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
                                        class="btn btn-success">+
                                        Add new Template</button>
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
                            @foreach ($template as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td id="paragraph-copy1">{{ $item->message }}</td>
                                    <td>
                                        <a class="mb-1 btn clip-btn btn-primary" href="javascript:;"
                                            data-clipboard-action="copy" data-clipboard-target="#paragraph-copy1"><i
                                                class="far fa-copy"></i> Copy from Input</a>
                                        <a class="me-3" href="{{ route('template.edit', $item->id) }}">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a class="confirm-text delete" href="{{ route('template.delete', $item->id) }}">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Template</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('template.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Title</label>
                            <input type="text" name="title" class="form-control" required />
                        </div>
                        <div class="col-md-12 col-lg-12 mb-3">
                            <label for="message">Message</label>
                            <textarea name="message" cols="60" rows="5"></textarea>
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
