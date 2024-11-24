<div class="sidebar" id="sidebar">
    <div style="background-color: #D2D4D9" class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }}"
                            alt="img" /><span>
                            Dashboard</span>
                    </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fas fa-book-open"></i><span>
                            Bacth Manager</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('all.batch') }}">Batch Manager (Students/Fee/Payment)</a></li>
                        <li><a href="{{ route('running.batch') }}">Running Batch</a></li>
                        <li><a href="{{ route('student.fee') }}">Student - Fee Head</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fas fa-user-graduate"></i><span>
                            Student Manager</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('student.list') }}">Student Manage</a></li>
                        <li><a href="{{ route('chose.course') }}">Add Student</a></li>
                        <li><a href="{{ route('pending.students') }}">Pending Students</a></li>
                        <li><a href="{{ route('promotion.search') }}">Student Class Promotion</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fa fa-clock"></i><span>
                            Course/ Section/ Shift</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('course.section.index') }}">Course Section</a></li>
                        <li><a href="{{ route('all.course') }}">All Course</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fas fa-calculator"></i><span>
                            Accounts</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('add.payment') }}">Add Payment</a></li>
                        <li><a href="{{ route('create.fee') }}">Create Fees</a></li>
                        <li><a href="{{ route('search.pay') }}">All Payment</a></li>
                        <li><a href="{{ route('expense.list') }}">Expenses</a></li>
                        <li><a href="{{ route('expensecategory.list') }}">Expenses Category</a></li>
                        <li><a href="">Summary</a></li>
                        <li><a href="{{ route('financial.report') }}">Financial Report</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fas fa-envelope"></i><span>
                            SMS</span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('sms.log') }}">Sms Log</a></li>
                        <li><a href="{{ route('sms.create') }}">Send Sms</a></li>
                        <li><a href="{{ route('sms.template') }}">SMS Template</a></li>
                        <li><a href="{{ route('sms.setting') }}">SMS Settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
