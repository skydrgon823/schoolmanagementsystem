@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')
<link href="css/mobiscroll.javascript.min.css" rel="stylesheet" />
<script src="js/mobiscroll.javascript.min.js"></script>
    <style>
        .fc-basic-view tbody .fc-row {
            min-height: 2em !important;
            height: 48px !important;
        }
        .fc-scroller.fc-day-grid-container {
            height: 288px !important;
        }
        .fc-toolbar .fc-right {
            width: 40% !important;
        }
        .welcome-pane {
            margin: 4rem;
        }
        .card {
            border: 10px solid whitesmoke;
        }
        .one-form-pane {
            background: #ccc;
            border: 4px solid white;
            border-radius: 10px;
        }
        .tab-pane {
            margin: 0;
        }
        .font-green {
            color: green;
            font-weight: bold;
        }
        .sticky-toolbar {
            width: 50px;
            position: fixed;
            top: 70%;
            right: 0;
            list-style: none;
            margin: 0;
            z-index: 999;
            background: #fff;
            box-shadow: 0 0 50px 0 #523f6926;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-top-left-radius: 0.42rem;
            border-bottom-left-radius: 0.42rem;
            padding: 10px;
        }
        .modal-backdrop.show {
            opacity: 0;
        }
        .modal1 {
            top: unset;
            left: unset;
            right: 35px !important;
        }
        .text-left {
            background: whitesmoke;
            width: 80%;
        }
        a {
            cursor: pointer;
        }
        .fc-event-container {
            transform: translate(0px, -33px);
            opacity: 0.7;
        }
        .fc-event-container:hover {
            transform: translate(0px, -35px);
            opacity: 1;
        }
        .fc-day-number {
            color: black;
        }
        .hide {
            display: none;
        }
        @media (max-width: 578px) {

            .welcome-pane {
                margin: 1rem;
            }
        }

    </style>
    <style>
        /* width */
        ::-webkit-scrollbar {
          width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          box-shadow: inset 0 0 5px grey;
          border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: rgb(21, 20, 20);
          border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #3a3939;
        }
        .card{
            margin-top:60px;
            overflow:hidden;
        }
        .cardpos{
            position:fixed;width:100%;z-index:10;
        }
        .cardpos>li{
            width:180px;
        }
        .cardpos>li>a{
            text-align: center;
            padding:5px 10px;
        }
        </style>
    <div class="card">


        <ul class="nav nav-tabs nav-tabs-highlight cardpos" style="margin-bottom: 0;transform:translateX(-12px);">
            @if ($types=="student" || $types == "staff" || $types == "teacher")
                <li class="nav-item"><a href="#dashboard-pane" class="nav-link active" data-toggle="tab">Manage Events</a></li>
            @else
                <li class="nav-item"><a href="#dashboard-pane" class="nav-link active" data-toggle="tab">Manage Events</a></li>
                <li class="nav-item"><a href="#my-subject-pane" class="nav-link" data-toggle="tab">Newsletters</a></li>
            @endif
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="dashboard-pane">
                <div class="row" style="background: whitesmoke;">
                    @if ($types == "student" || $types == "staff" || $types=="teacher")
                        <div class="card col-16">
                            <div class="card-body">
                                {{-- <div class="card-header header-elements-inline">
                                    <h5 class="card-title"><strong>Upcoming Events</strong></h5>
                                    <div class="card-title" style="float: right !important;">
                                        <a class="btn btn-primary" data-target="#add_event_modal" data-toggle="modal" style="color: white;"> + Add Event </a>
                                    </div>
                                </div> --}}
                                <div class="fullcalendar-event-colors"></div>
                            </div>
                        </div>
                    @else
                        <div class="card col-md-8 col-xl-6">
                            <div class="card-body">
                                {{-- <div class="card-header header-elements-inline">
                                    <h5 class="card-title"><strong>Upcoming Events</strong></h5>
                                    <div class="card-title" style="float: right !important;">
                                        <a class="btn btn-primary" data-target="#add_event_modal" data-toggle="modal" style="color: white;"> + Add Event </a>
                                    </div>
                                </div> --}}
                                <div class="fullcalendar-event-colors"></div>
                            </div>
                        </div>
                        <div class="card col-md-4 col-xl-6">
                            <div class="card-body">
                                <div class="card-header header-elements-inline">
                                    <h5 class="card-title"><strong>Add Events</strong></h5>

                                </div>
                                <hr>
                                <div class="card-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label for="event-name">Event Name</label>
                                            <input type="text" id="event-name" class="form-control" name="event-name" placeholder="Event Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="event-participants">Event Participants</label>
                                            <select name="event-participants" id="event-participants" class="select form-control" data-placeholder="Select participants">
                                                <option value=""></option>
                                                <option value="1">Test</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="event-dates">Event Dates</label>
                                            <div class="form-control border-0">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="event-radio" id="single" value="Single" checked>
                                                    <label class="form-check-label" for="Single">Single</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="event-radio" id="range" value="Range">
                                                    <label class="form-check-label" for="range">Range</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start-date">Start Date</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="icofont-calendar">
                                                </i>
                                                </div>
                                                <input class="form-control" id="start-date" name="start-date" placeholder="Pick date/range" type="text"/>
                                            </div>
                                        </div>
                                        <button class="form-control btn btn-primary">Create Event</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
            <div class="tab-pane fade" id="my-subject-pane">

                <div class="row" style="background: whitesmoke;">
                    @foreach ($class_subjects as $val)
                    <div class="card col-md-3">
                        <h3>Form {{$val->my_class->form->name}} &nbsp; {{$val->my_class->stream}}  &nbsp; {{$val->subject->title}} </h3>
                        <p>END OF TERM 1, 2022 - (2022 TERM 1)</p>
                        <div class="row">
                            <div class="one-form-pane col-md-6">
                                <p>Mean Points</p>
                                <h3>2.2857</h3>
                            </div>
                            <div class="one-form-pane col-md-6">
                                <p>Mean Marks</p>
                                <h3>29.26%</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="one-form-pane col-md-6">
                                <p>Mean Grade</p>
                                <h3>D-</h3>
                            </div>
                            <div class="one-form-pane col-md-6">
                                <p>Students</p>
                                <h3>{{count($val->students_taken_this_subject)}}</h3>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-success" style="width: 100%;">View Analysis</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
           </div>
    </div>
    <div class="sticky-toolbar">
        <a class="" data-target="#call_modal" data-toggle="modal">
            <img src="/global_assets/images/icon/call.png" width="30" height="30"/>
        </a>
        <a class="mt-1" data-target="#message_chat_modal" data-toggle="modal">
            <img src="/global_assets/images/icon/message-chat.png" width="30" height="30"/>
        </a>
        <a class="mt-1" data-target="#comment_modal" data-toggle="modal">
            <img src="/global_assets/images/icon/comment.png" width="30" height="30"/>
        </a>
    </div>

    <div class="modal fade modal1" id="call_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true" style="max-width: 300px;">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #095e54;">
                    <h2 class="modal-title" id="noticeModalLabel" style="color: white;">
                        <img class="mr-2" src="/global_assets/images/icon/call.png" width="30" height="30"/>Call Zeraki
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mt-3 text-left">Hi there 👋,<br>Hit the button below to reach out to us directly on 0798666111</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success col-12">Call</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal1" id="message_chat_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true" style="max-width: 300px;">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #095e54;">
                    <div class="d-flex align-items-center">
                        <img class="mr-2" src="/global_assets/images/logo.png" width="40" height="40"/>
                        <div class="d-flex flex-column" style="color: white;">
                            <h3 class="modal-title" id="noticeModalLabel">Zeraki</h3>
                            <p>Always active 😊</p>
                        </div>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mt-3 text-left">Hi there 👋,<br>Hit the button below to reach out to us directly on 0798666111</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success col-12">
                        <img class="mr-2" src="/global_assets/images/icon/message-chat.png" width="15" height="15"/>Start Chat
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal1" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true" style="max-width: 400px;">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #095e54;">
                    <h2 class="modal-title" id="noticeModalLabel" style="color: white;">
                        Send Feedback to Zeraki
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mt-3 text-left">Hi there 👋,<br>If you would like to share your feedback, have any question, suggest a feature or need help resolving an issue, kindly put it here and our team will get back to you</p>
                </div>
                <form class="row m-1 sitecomments-store" action="{{ route('sitecomments.store') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <input class="" type="text" placeholder="Send a message..." style="width: 90%;" id="sitecomment" name="sitecomment">
                        <button type="submit" class="btn m-0 p-0">
                            <img class="" src="/global_assets/images/icon/messages-send.png" width="25" height="25"/>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_event_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:white;">
                    <h2 class="modal-title" id="noticeModalLabel" style="color: black;">
                        Add Event
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="calevent-store" action="{{ route('calevents.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="event_name">Event Name</label>
                                    <input type="text" placeholder="Event Name" id="event_name" name="event_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="event_participants">Event Participants</label>
                                    <select required data-placeholder="Event Participants" class="form-control" id="event_participants" name="event_participants">
                                        <option value="">Event Participants</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="parent">Parents</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row calevent_specific_teacher hide">
                            <div class="col-md-12">
                                <label for="specific_teacher">Specific*</label>
                                <select data-placeholder="Select Teacher" class="form-control" id="specific_teacher" name="specific_teacher">
                                    <option value="">Select Teacher Group</option>
                                    @foreach($all_groups as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row calevent_specific_form hide">
                            <div class="col-md-12">
                                <label for="specific_form">Specific*</label>
                                <select data-placeholder="Select Form" class="form-control" id="specific_form" name="specific_form">
                                    <option value="">Select Form</option>
                                    @foreach($all_forms as $val)
                                    <option value="{{$val->id}}">Form {{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="upi">Event Dates</label>
                                <div class="row align-items-center">
                                    <input type="radio" name="date_type" id="event_single" class="form-control ml-2 create-radio" checked
                                        value="single" style="width: 20px; height: 20px;">
                                    <label class="ml-2 mb-0" for="event_single">Single </label>

                                    <input type="radio" name="date_type" id="event_range" class="form-control ml-2 create-radio"
                                        value="range"  style="width: 20px; height: 20px;">
                                    <label class="ml-2 mb-0" for="event_range">Range</label>
                                </div>

                            </div>
                        </div>
                        <div class="row calevent_date_single mt-3">

                            <div class="col-md-12">
                                <label for="event_date">Pick date</label>
                                <input class="form-control" type="datetime-local" placeholder="Pick date/time" id="event_date" name="event_date" required/>
                            </div>
                        </div>
                        <div class="row calevent_date_range mt-3 hide">

                            <div class="col-md-6">
                                <label for="start_date">Pick start date</label>
                                <input class="form-control" type="datetime-local" placeholder="Pick date/time" id="start_date" name="start_date"/>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date">Pick end date</label>
                                <input class="form-control" type="datetime-local" placeholder="Pick date/time" id="end_date" name="end_date"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" id="create-calevent-btn" >save Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_event_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:white;">
                    <h2 class="modal-title" id="noticeModalLabel" style="color: black;">
                        View Event
                    </h2>
                    <div class="">
                        <a class="btn" onclick="viewEditModal();" style="transform: translate(0px, -10px);">
                            <img src="/global_assets/images/icon/edit.png" width="16" height="16"/>
                        </a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="row pl-2">
                        <h2 style="color: green;" id="view_event_name">Opener exams(test)</h2>
                    </div>
                    <div class="pl-2">
                        <label for="">Event Details</label>
                        <div class="pl-2">
                            <div class="d-flex align-items-center">
                                <img src="/global_assets/images/icon/clock.svg" width="16" height="16"/>
                                <p class="p-0 m-0 ml-2" id="view_event_date">Jul 22, 2022, 8:00 AM</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="icon-users2 icon-1x opacity-75"></i>
                                <p class="p-0 m-0 ml-2" id="view_event_participants">Teachers</p></div>
                            <div class="d-flex align-items-center">
                                <i class="icon-users4 icon-1x opacity-75"></i>
                                <p class="p-0 m-0 ml-2" id="view_event_group">ALL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_event_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:white;">
                    <h2 class="modal-title" id="noticeModalLabel" style="color: black;">
                        Edit Event
                    </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="calevent-update" action="{{ route('calevents_update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_event_name">Event Name</label>
                                    <input type="text" placeholder="Event Name" id="edit_event_name" name="edit_event_name" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_event_participants">Event Participants</label>
                                    <select required data-placeholder="Event Participants" class="form-control" id="edit_event_participants" name="edit_event_participants">
                                        <option value="">Event Participants</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="parent">Parents</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row edit_calevent_specific_teacher hide">
                            <div class="col-md-12">
                                <label for="edit_specific_teacher">Specific*</label>
                                <select data-placeholder="Select Teacher" class="form-control" id="edit_specific_teacher" name="edit_specific_teacher">
                                    <option value="">Select Teacher Group</option>
                                    @foreach($all_groups as $val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row edit_calevent_specific_form hide">
                            <div class="col-md-12">
                                <label for="edit_specific_form">Specific*</label>
                                <select data-placeholder="Select Form" class="form-control" id="edit_specific_form" name="edit_specific_form">
                                    <option value="">Select Form</option>
                                    @foreach($all_forms as $val)
                                    <option value="{{$val->id}}">Form {{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="upi">Event Dates</label>
                                <div class="row align-items-center">
                                    <input type="radio" name="date_type" id="edit_event_single" class="form-control ml-2 edit-radio"
                                        value="single" style="width: 20px; height: 20px;">
                                    <label class="ml-2 mb-0" for="event_single">Single </label>

                                    <input type="radio" name="date_type" id="edit_event_range" class="form-control ml-2 edit-radio"
                                        value="range"  style="width: 20px; height: 20px;">
                                    <label class="ml-2 mb-0" for="event_range">Range</label>
                                </div>

                            </div>
                        </div>
                        <div class="row edit_calevent_date_single mt-3">

                            <div class="col-md-12">
                                <label for="edit_event_date">Pick date</label>
                                <input class="form-control" type="datetime-local" placeholder="Pick date/time" id="edit_event_date" name="edit_event_date" required/>
                            </div>
                        </div>
                        <div class="row edit_calevent_date_range mt-3 hide">

                            <div class="col-md-6">
                                <label for="edit_start_date">Pick start date</label>
                                <input class="form-control" type="datetime-local" placeholder="Pick date/time" id="edit_start_date" name="edit_start_date"/>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_end_date">Pick end date</label>
                                <input class="form-control" type="datetime-local" placeholder="Pick date/time" id="edit_end_date" name="edit_end_date"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" id="delete-calevent-btn" >delete Event</button>
                        <button type="submit" class="btn btn-info" id="update-calevent-btn" >update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="now_calendar_status">
    <input type="hidden" id="update_status" value="true">
    <script>
        $(document).ready(function(){
          var date_input=$('#start-date'); //our date input has the name "date"
          var options={
            format: 'mm/dd/yyyy',
            todayHighlight: true,
            autoclose: true,
          };
          date_input.datepicker(options);
        })
    </script>
    @include('partials.js.dashboard_js')
    @endsection
