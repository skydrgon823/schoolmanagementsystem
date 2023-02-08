@extends('layouts.master')
@section('page_title', 'My Account')
@section('content')
    <style>
    .card{
        margin-top:50px;overflow:hidden;
    }
    .cardpos{
        position:fixed;width:100%;z-index:10;
    }
    .tabpos{
        margin-top: 30px;
    }
    .active-state{
    display: none;
}
.cardpos>li{
            width:180px;
        }
        .cardpos>li>a{
            text-align: center;
            padding:5px 10px;
        }
        .selcls {
            padding: 9px;
            border: solid 1px #517B97;
            outline: 0;
            background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #CAD9E3), to(#FFFFFF));
            background: -moz-linear-gradient(top, #FFFFFF, #CAD9E3 1px, #FFFFFF 25px);
            box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;

        }
    </style>
    <div class="card">
        {{-- <div class="card-header header-elements-inline">
            <h6 class="card-title">My Account</h6>
            {!! Qs::getPanelOptions() !!}
        </div> --}}

        <div class="card-body" style="background: whitesmoke">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style=" transform:translateX(-25px);">
                <li class="nav-item"><a href="#school-profile" class="nav-link active" data-toggle="tab"><i class="icofont-clock-time"></i> School Profile</a></li>
                <li class="nav-item"><a href="#school-option" class="nav-link" data-toggle="tab"><i class="icofont-settings"></i> School Options</a></li>
                <li class="nav-item"><a href="#user_role" class="nav-link" data-toggle="tab"><i class="icofont-user"></i> User Roles</a></li>
            </ul>

            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="school-profile">
                    @if($errors->any())
                        <div class="alert alert-danger border-0 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                                @foreach($errors->all() as $er)
                                    <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                                @endforeach

                        </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('my_account.update', $my->id) }}">
                        @csrf @method('PUT')
                        <div class="row py-3" style="background: whitesmoke;">
                            <div class="col-md-4 mr-3" style="margin-left: -20px;">
                                <div class="row">
                                    <div class="card col-12 mt-2 ml-2" style="heigth:100%;">
                                        <div class="d-flex flex-column my-5 align-items-center welcome-pane" style="height: 300px;">
                                            <img class="rounded-circle" id="schoolPhoto" src="/school_number/{{ $my->school_logo }}" width="150" height="150"/>
                                            <div class="d-flex flex-row mt-4">
                                            {{-- <button class="btn btn-primary active-state" onclick="changeImage(event)" id="change_image">Change Image</button> --}}
                                                <input  accept="image/*" type="file" name="school_photo" id="school_photo" class="form-input-styled" data-fouc>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <h3 class="text-success">{{ $my->school_name }}</h3>
                                        </div>
                                        <div class="d-flex flex-column my-3 ml-1">
                                            <div class="d-flex flex-row">
                                                EMAIL ADDRESS:
                                            </div>
                                            <div class="d-flex flex-row">
                                                <h6 class="text-success">{{ $my->school_email }}</>
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8 m-0" style="text-align: left;transform:translateY(-40px)">
                                <div class="row">
                                    <div class="card col-12 px-4">
                                        <h4 class="mt-3"><strong> Update details for Accounts </strong></h4>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                {{-- <div class="form-group">
                                                    <label for="name">School Name</label>
                                                    <input value="{{ $my->school_name }}" required type="text" name="name" id="name" placeholder="BIBIRIONI HIGH SCHOOL - LIMURU" class="form-control">
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="name">School Name</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append" style="background-color:grey;border-radius-top-left:5px;border-radius-bottom-left:5px;">
                                                            <a href="#" class="text-white" style="padding:5px 10px;"><i class="icofont-building" style="color:white"></i></a>
                                                        </div>
                                                        <input value="{{ $my->school_name }}" required type="text" name="name" id="name" placeholder="BIBIRIONI HIGH SCHOOL - LIMURU" class="form-control">
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="short_name">School Name(Short Version)</label>

                                                    <div class="input-group">
                                                        <div class="input-group-append" style="background-color:grey;border-radius-top-left:5px;border-radius-bottom-left:5px;">
                                                            <a href="#" class="text-white" style="padding:5px 10px;"><i class="icofont-building" style="color:white"></i></a>
                                                        </div>
                                                        <input value="{{ $my->school_short_name }}" required type="text" name="short_name" id="short_name" placeholder="BBHS" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone Number</label>

                                                    <div class="input-group">
                                                        <div class="input-group-append" style="background-color:grey;border-radius-top-left:5px;border-radius-bottom-left:5px;">
                                                            <a href="#" class="text-white" style="padding:5px 10px;"><i class="icofont-phone" style="color:white"></i></a>
                                                        </div>
                                                        <input value="{{ $my->school_phone }}" class="form-control" placeholder="07## ### ###" name="phone" id="phone" type="text" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email Address</label>

                                                    <div class="input-group">
                                                        <div class="input-group-append" style="background-color:grey;border-radius-top-left:5px;border-radius-bottom-left:5px;">
                                                            <a href="#" class="text-white" style="padding:5px 10px;"><i class="icofont-email" style="color:white"></i></a>
                                                        </div>
                                                        <input value="{{ $my->school_email }}" required type="text" name="email" id="email" placeholder="bibirioniboyz@gmail.com" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="head_id">Head Of School</label>
                                                    <select class="select form-control" id="head_id" name="head_id" data-fouc data-placeholder="Choose..">
                                                        <option value="0"></option>
                                                        @foreach ($all_teachers as $teacher)
                                                            <option value="{{$teacher->id}}"  @if($teacher->id == $my->school_head_id) selected @endif  >{{$teacher->user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title_id">Head Of School's Title</label>
                                                    <select class="select form-control" id="title_id" name="title_id" data-fouc data-placeholder="Choose..">
                                                        <option value="0"></option>
                                                        <option value="1" @if($my->school_title_id == 1) selected @endif >Principal</option>
                                                        <option value="2" @if($my->school_title_id == 2) selected @endif >Senior Principal</option>
                                                        <option value="3" @if($my->school_title_id == 3) selected @endif >Chief Principal</option>
                                                        <option value="4" @if($my->school_title_id == 4) selected @endif >Executive Head</option>
                                                        <option value="5" @if($my->school_title_id == 5) selected @endif >Director</option>
                                                        <option value="6" @if($my->school_title_id == 6) selected @endif >Head Teacher</option>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hod_id">H.O.D. Academis / D.O.S</label>
                                                    <select class="select form-control" id="hod_id" name="hod_id" data-fouc data-placeholder="Choose..">
                                                        <option value="0"></option>
                                                        @foreach ($all_teachers as $teacher)
                                                            <option value="{{$teacher->id}}"  @if($teacher->id == $my->school_hod_id) selected @endif  >{{$teacher->user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="postal">Postal Address</label>

                                                <div class="input-group">
                                                    <div class="input-group-append" style="background-color:grey;border-radius-top-left:5px;border-radius-bottom-left:5px;">
                                                        <a href="#" class="text-white" style="padding:5px 10px;"><i class="icofont-address-book" style="color:white"></i></a>
                                                    </div>
                                                    <input value="{{ $my->school_postal }}" type="text" name="postal" id="postal" placeholder="553Limuru" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-md-6">
                                                <label for="gender_id">Gender Type</label>
                                                <select class="select form-control" id="gender_id" name="gender_id" data-fouc data-placeholder="Choose..">
                                                    <option value="0"></option>
                                                    <option value="1" @if($my->school_gender_id == 1) selected @endif >Boys School</option>
                                                    <option value="2" @if($my->school_gender_id == 2) selected @endif >Girls School</option>
                                                    <option value="3" @if($my->school_gender_id == 3) selected @endif >Mixed School</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status_id">Boarding Status</label>
                                                    <select class="select form-control" id="status_id" name="status_id" data-fouc data-placeholder="Select boarding status..">
                                                        <option value="0"></option>
                                                        <option value="1" @if($my->school_status_id == 1) selected @endif >Mixed</option>
                                                        <option value="2" @if($my->school_status_id == 2) selected @endif >Day</option>
                                                        <option value="3" @if($my->school_status_id == 3) selected @endif >Boarding</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="text-right mt-2 mb-2">
                                            <button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
                                            {{-- <a class="btn btn-warning" href="{{ route('teachers.index') }}" >Back</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="tab-pane fade show" style="padding-left: 120px;padding-right:100px;" id="school-option">
                    <div class="row">
                        {{-- <div class="col-md-1"></div> --}}
                        <div class="col-md-12">
                            <div class="row" style="background: white">
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  SMS Summary</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Send a summary text message to the sender of a group message
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select class="form-control selcls" name="sms-summmary" id="sms-summanry">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Teachers Per Subject</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Number of teachers assignable to a subject of a given stream
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="teachers-number" class="form-control selcls" id="teachers-number">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="background: white">
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Order Students By</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Order all list of students by admission number of name
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="adminssion_name" id="admission_name" class="form-control selcls">
                                                <option value="0">Admission Name</option>
                                                <option value="1">Name</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Subject-paper Marks</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Enable the entry of subject-paper marks
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="subject-paper-mark" id="subject-paper-mark" class="form-control selcls">
                                                <option value="0">Yes</option>
                                                <option value="1">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Breaking Ties</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Breaking ties using mean points when you rank by mean marks, and break ties using mean marks when you rank by KSCE points / mean points
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="breaking-ties" id="breaking-ties" class="form-control selcls">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Decimal in Marks</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Show decimals in subject marks if present
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="decimal-marks" id="decimal-marks" class="form-control selcls">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Top Students</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Number of top students to be shown in the exam analysis report of a class
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="student-numbers" id="student-numbers" class="form-control selcls">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3" selected>3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">10</option>
                                                <option value="7">15</option>
                                                <option value="8">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Prior Exams in Report Forms</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Show prior exams of given term when generating report forms for a non-consolidated exam
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="generating-report" id="generating-report" class="form-control selcls">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  Consolidated Exam - Grade X of Y</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Assign a student grade X of Y in a consolidated exam if they missed or got grade X or Y in any of the constituent exams
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="consolidated-exam" id="consolidated-exam" class="form-control selcls">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr style="border: 2px solid whitesmoke">
                                </div>
                                <div class="col-md-12 p-3">
                                    {{-- <div class="row"> --}}
                                        <p class="text-bold" style="text-align: left;font-weight:700">  TSC No. in analysis reports</p>
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-md-10 text-left">
                                            Display TSC Number in analysis reports
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <select name="tsc-number" id="tsc-number" class="form-control selcls">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-1"></div> --}}
                    </div>
                </div>
                <div class="tab-pane fade show" id="user_role">
                    <div class="d-flex align-items-center" >
                        <div class="col-md-2"></div>
                        <div class="col-md-8 p-4" style="background:white">
                            <div class="row">
                                <div class="col-md-1" style="margin:auto 0;">
                                    <span class="icofont-chat" style="color: #e25822;font-size:3rem"></span>
                                </div>
                                <div class="col-md-10" style="text-align:left">
                                    <h5>Messages</h5>
                                    <h1 style="color: green">7</h1>
                                    <span>Users can send messages</span>
                                </div>
                                <div class="col-md-1" style="margin:auto 0;">
                                    <span class="icofont-arrow-right" style="font-size: 1.5rem"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--My Profile Ends--}}
    @include('partials.js.account_index')
@endsection
