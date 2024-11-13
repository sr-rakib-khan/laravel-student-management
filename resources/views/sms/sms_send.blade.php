@extends('layouts.admin')
@section('page-content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Send Sms</h4>
                </div>
                <div class="page-btn">
                    <a href="{{ route('sms.log') }}" class="btn btn-added">SMS Log</a>
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
                                <span class="mt-2 text-muted">For example: 01xxxxxxxxx, +8801xxxxxxxxx, 8801xxxxxxxxx</ুে>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">SMS Text</label>
                            <div class="col-lg-9">
                                <textarea name="sms" id="text" rows="5"></textarea>
                                <div class="row">
                                    <div class="col-md-6 text-muted">Eng:160 / Ban:70 Characters Per Message</div>
                                    <div class="col-md-6 text-muted">Message Length : <span id="length">0</span></div>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#text').on('input', function() {
                let textLength = $(this).val().length;
                $('#length').text(textLength);
            });
        });
    </script>
@endsection
