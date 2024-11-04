@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Edit Expenses Category</h2>
                </div>

                <div class="page-title">
                    <a class="btn btn-primary" href="{{ route('expense.list') }}" type="button">Expense Category list</a>
                </div>
            </div>

            <div class="card">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="card-body col-md-6">
                        <form action="{{ route('update.expcategory') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $expcategory->id }}">
                            <div class="mb-3">
                                <label for="validationCustom01">Category Name <span class="text-danger">*</span></label>
                                <input value="{{ $expcategory->category_name }}" type="text" name="category_name"
                                    class="form-control" />
                                @if ($errors->has('category_name'))
                                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="validationCustom01">Category Status</label>
                                <select name="status" class="form-control form-small select">
                                    <option @if ($expcategory->status == 1) selected @endif value="1">Active</option>
                                    <option @if ($expcategory->status == 0) selected @endif value="0">Inactive
                                    </option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--expense category add modal -->
    <div class="modal fade" id="categoryaddmodal" tabindex="-1" aria-labelledby="courseaddmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New expense category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('expensecategory.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" class="form-control" required />
                            @if ($errors->has('category_name'))
                                <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Category Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control form-small select">
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
