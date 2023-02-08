@extends('layouts.master')
@section('page_title', 'My Account')
@section('content')

    <div class="card" style="margin-top: -26px;">
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#change-pass_reset" class="nav-link active" data-toggle="tab">Change Password</a></li>
            </ul>

            <div class="tab-content mt-5">
                <div class="tab-pane fade show active" id="change-pass_reset">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card col-md-12" style="background-color: whitesmoke">
                                <form method="get" action="{{ route('my_account.show_pass') }}">
                                    <div class="form-group row p-5">
                                        <h4>Do you have a reset code?</h4>
                                    </div>

                                    <div class="row p-5">
                                        {{-- <div class="col-6"> --}}
                                            <a href="#" class="btn btn-success col-md-5 m-1 p-2">No</a>
                                        {{-- </div> --}}
                                            <div class="col-md-1"></div>
                                            <button type="submit" class="btn btn-primary col-md-5 m-1 p-2">Yes <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--My Profile Ends--}}

@endsection
