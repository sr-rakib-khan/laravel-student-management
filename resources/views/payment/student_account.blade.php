@extends('layouts.admin')
@section('page-content')
    @php
        $course = DB::table('courses')
            ->where('id', $student->course_id)
            ->first();

        $batch = DB::table('batches')
            ->where('id', $student->batch_id)
            ->first();

        $section = DB::table('sections')
            ->where('id', $student->section_id)
            ->first();
        $fees_summary = DB::table('fess')
            ->where('student_id', $student->id)
            ->get();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h2>Student Profile/ Account Info</h2>
                </div>
                <div class="col-md-6 mt-3 text-end">
                    <a type="button" href="{{ route('view.student-details', $student->id) }}"
                        class="btn btn-primary">Profile</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="profile-set">
                        <div class="profile-head row">
                            <div class="col-md-6 mt-3">
                                <h3><Strong>ID:</Strong> {{ $student->student_id }} | <strong>Name:</strong>
                                    {{ $student->student_name }}</h3>
                            </div>
                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    @if ($student->photo)
                                        <img src="{{ asset($student->photo) }}" alt="img" id="blah" />
                                    @else
                                        <img src="{{ asset('assets/img/customer/customer5.jpg') }}" alt="img"
                                            id="blah" />
                                    @endif
                                </div>
                                <div style="width: 300px" class="profile-contentname">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Status</strong></td>
                                                @if ($student->status == 1)
                                                    <td class="text-success text-end">Active</td>
                                                @else
                                                    <td class="text-danger text-end">Inactive</td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <td><strong>Gender</strong></td>
                                                <td class="text-end">{{ $student->gender }}/ {{ $student->religion }}</td>
                                            </tr>
                                            <tr>
                                                <td><a class="btn btn-primary btn-sm text-white" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#smsmodal">Send
                                                        Sms</a></td>
                                                <td class="text-end"><a type="button" class="btn btn-info btn-sm"
                                                        href="tel:{{ $student->sms_mobile }}">Call
                                                        {{ $student->sms_mobile }}</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="width: 300px" class="profile-contentname">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Course</strong></td>
                                                <td class="text-end">{{ $course->course_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Session</strong></td>
                                                <td class="text-end">{{ $batch->session }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Shift</strong></td>
                                                <td class="text-end">{{ $section->section_name }}
                                                    ({{ $section->schedule_day }} |
                                                    {{ $section->schedule_time }})</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="width: 300px" class="profile-contentname">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Batch</strong></td>
                                                <td class="text-end">{{ $batch->batch_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monthly Fee</strong></td>
                                                <td class="text-end">{{ $batch->monthly_fee }} tk</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monthly Discount</strong></td>
                                                @if ($student->discount)
                                                    <td class="text-end">{{ $student->discount }}</td>
                                                @else
                                                    <td class="text-end">00.00 tk</td>
                                                @endif

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="border-top: 2px solid" class="card">
                <div class="card-body">
                    <div class="row pt-3 pb-3 text-center">
                        <div class="col-md-3">
                            <h4>Account Info</h4>
                        </div>

                        <div class="col-md-3">
                            <a class="btn btn-primary" href="">Monthly Discount</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-success" href="">Add Payment</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-info" href="">Add Invidual Fee</a>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-secondary" href="">Finacial Report</a>
                        </div>
                        <span class="border-bottom mt-3 border-dark"></span>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Fee Title</strong></th>
                                    <th><strong>Common Fee</strong></th>
                                    <th><strong>Tusion fee</strong></th>
                                    <th><strong>Monthly Discount</strong></th>
                                    <th><strong>Fee After Discount</strong></th>
                                    <th><strong>Extra discount</strong></th>
                                    <th><strong>Dues</strong></th>
                                    <th><strong>Total</strong></th>
                                    <th><strong>Pay Amount</strong></th>
                                    <th><strong>Summary</strong></th>
                                </tr>
                                @foreach ($fees_summary as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->fees_month }}</td>
                                        <td>{{ $item->common_fee }}</td>
                                        <td>{{ $item->tusion_fee }}</td>
                                        <td>{{ $item->monthly_discount }}</td>
                                        <td>{{ $item->fee_afterdiscount }}</td>
                                        <td>{{ $item->extra_discount }}</td>
                                        <td>{{ $item->due }}</td>
                                        <td>{{ $item->net_fee }}</td>
                                        <td>{{ $item->payment }}</td>
                                        @if ($item->summary == 0)
                                            <td class="text-success">Full Paid</td>
                                        @else
                                            <td class="text-danger">Dues {{ $item->summary }}</td>
                                        @endif
                                    </tr>
                                @endforeach

                                @php
                                    $common_fee = DB::table('fess')
                                        ->where('student_id', $student->id)
                                        ->sum('common_fee');
                                    $tution_fee = DB::table('fess')
                                        ->where('student_id', $student->id)
                                        ->sum('tusion_fee');
                                    $monthly_discount = DB::table('fess')
                                        ->where('student_id', $student->id)
                                        ->sum('monthly_discount');
                                    $extra_discount = DB::table('fess')
                                        ->where('student_id', $student->id)
                                        ->sum('extra_discount');

                                    $total_pay = DB::table('fess')
                                        ->where('student_id', $student->id)
                                        ->sum('payment');

                                    $due_amount = DB::table('student_dues')
                                        ->where('student_id', $student->id)
                                        ->first();

                                        

                                    $total_fee = $common_fee + $tution_fee;
                                    $total_discount = $monthly_discount + $extra_discount;

                                    $net_fee = $total_fee - $total_discount;

                                @endphp
                                <tr>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>{{ $common_fee }}</strong></td>
                                    <td><strong>{{ $tution_fee }}</strong></td>
                                    <td><strong>{{ $monthly_discount }}</strong></td>
                                    <td></td>
                                    <td><strong>{{ $extra_discount }}</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>{{ $total_pay }}</strong></td>
                                    @if ($due_amount->due_amount <= 0)
                                        <td class="text-success"><strong>Full Paid</strong></td>
                                    @else
                                        <td class="bg-danger"><strong>Dues:{{ $due_amount->due_amount }}</strong></td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="profile-contentname">
                                <table class="table">
                                    <tbody class="mt-3">
                                        <tr>
                                            <td><strong>Total Fee</strong></td>

                                            <td class="text-end">{{ $total_fee }}.00 tk</td>

                                        </tr>
                                        <tr>
                                            <td><strong>Total Discount</strong></td>
                                            <td class="text-end">{{ $total_discount }}.00 tk</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Net Fee</strong></td>
                                            <td class="text-end">{{ $net_fee }}.00 tk</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pay Amount</strong></td>
                                            <td class="text-end">{{ $total_pay }} tk</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong></td>
                                            @if ($due_amount->due_amount == 0)
                                                <td class="text-success text-end"><strong>Full Paid</strong></td>
                                            @else
                                                <td class="bg-danger text-white text-end">
                                                    <strong>Dues:{{ $due_amount->due_amount }}</strong>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- send sms modal --}}
    <div class="modal fade" id="smsmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Sms to <span
                            class="text-success">{{ $student->student_name }}</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sms.send') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Sms Phone <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $student->sms_mobile }}" name="to"
                                class="form-control" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Sms text <span class="text-danger">*</span></label>
                            <textarea required class="form-control" name="sms"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                        <button type="submit" class="btn btn-primary">Send Sms</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
