<div style="background-color: #D2D4D9" class="header">
    <div class="header-left active">
        <a href="{{ route('dashboard') }}" class="logo">
            {{-- <img src="{{ asset('assets/img/logo.png') }}" alt="" /> --}}
            <h5>Student Management</h5>

        </a>
        <a href="index.html" class="logo-small">
            <img src="{{ asset('assets/img/logo-small.png') }}" alt="" />
        </a>
        <a id="toggle_btn" href="javascript:void(0);"> </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="{{ route('global.student.search') }}" method="get">
                    @csrf
                    <div class="searchinputs">
                        <input name="id" type="text" placeholder="Search Student with ID ..." />
                        <div class="search-addon">
                            <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('assets/img/icons/search.svg') }}"
                            alt="img" /></a>
                </form>
            </div>
        </li>

        @php
            $user = DB::table('users')->where('id', auth()->id())->first();
        @endphp

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset($user->photo) }}" alt="" />
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img">

                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{ Auth::user()->name }}</h6>
                            <h5>Admin</h5>
                        </div>
                    </div>
                    <hr class="m-0" />
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"> <i class="me-2"
                            data-feather="user"></i> My
                        Profile</a>
                    <hr class="m-0" />
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item logout pb-0"><img
                                src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2"
                                alt="img" />Logout</button>
                    </form>
                </div>
            </div>
        </li>
    </ul>

    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>
            <a class="dropdown-item" href="signin.html">Logout</a>
        </div>
    </div>
</div>
