@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Profile</h4>
                    <h6>Admin Profile</h6>
                </div>
            </div>
            @php
                $user = DB::table('users')->where('id', auth()->id())->first();
            @endphp
            <div class="card">
                <div class="card-body">
                    <div class="profile-set">
                        <div class="profile-head"></div>
                        <form action="{{ route('change.profilephoto') }}" method="post" enctype="multipart/form-data">
                            <div class="profile-top">
                                @csrf
                                <input type="hidden" name="old_photo" value="{{ $user->photo }}">
                                <div class="profile-content">
                                    <div class="profile-contentimg">
                                        <img src="{{ asset($user->photo) }}" alt="img"
                                            id="blah" />
                                        <div class="profileupload">
                                            <input type="file" name="admin_photo" id="imgInp" />
                                            <a href="javascript:void(0);"><img
                                                    src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img" /></a>
                                        </div>
                                    </div>
                                    <div class="profile-contentname">
                                        <h2>{{ Auth::user()->name }}</h2>
                                        <h4>Updates Your Photo and Personal Details.</h4>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <button type="submit" class="btn btn-submit me-2">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <form action="{{ route('profile.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="admin_name" value="{{ $user->name }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12
                                            col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="admin_email" value="{{ $user->email }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" name="user_name" value="{{ $user->user_name }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="admin_phone" value="{{ $user->phone }}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-submit me-2">Update Info</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 mt-3">
                            <form action="{{ route('password.change') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <div class="pass-group">
                                                <input type="password" class="pass-input" name="old_password"
                                                    placeholder="enter your old password" required />
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <div class="pass-group">
                                                <input type="password" class="pass-input" name="new_password"
                                                    placeholder="enter new password" required />
                                                <span class="fas toggle-password fa-eye-slash"></span>
                                            </div>
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-submit me-2">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
