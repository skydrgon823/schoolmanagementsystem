@extends('layouts.master')
@section('page_title', 'Manage Message')
@section('content')
<style>
    .active-state {
        display: none;
    }
    .active-font-state {
        color: grey
    }
    .active-badge-state {
        color: white;
        background-color: grey
    }
    #message-second-badge{
        cursor: pointer;
    }
    #message-first-badge{
        cursor: pointer;
    }
    .card{
        margin-top:50px;overflow:hidden;
    }
    .cardpos{
        position:fixed;width:100%;z-index:10;
    }
    .tabpos{
        margin-top: 70px;
    }
    /* .cardpos>li{
            width:180px;
        }
        .cardpos>li>a{
            text-align: center;
        } */
</style>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight cardpos" style=" transform:translateX(-22px);">
            @if ($types=="student" || $types=="teacher" || $types=="staff")
                <li class="nav-item"><a href="#view_inbox" class="nav-link active" data-toggle="tab" ><i class="icon-envelope"></i> View Inbox</a></li>
            @else
                <li class="nav-item"><a href="#view_inbox" class="nav-link active" data-toggle="tab" ><i class="icon-envelope"></i> View Inbox</a></li>
                <li class="nav-item"><a href="#compose_message" class="nav-link" data-toggle="tab"><i class="icon-pencil"></i>Compose Message</a></li>
                <li class="nav-item"><a href="#sms_usage" class="nav-link" data-toggle="tab">Track SMS Usage</a></li>
                <li class="nav-item"><a href="#sms_by" class="nav-link" data-toggle="tab">Buy SMS</a></li>
            @endif

        </ul>
        <div class="tab-content tabpos">
            <div class="tab-pane fade show active" id="view_inbox">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>From</th>
                        <th>Type</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_messages as $key => $message)
                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td><a href="{{ route('messages.show', $message->id)}}">{{ $message->sender->name }}</a></td>
                                <td><a href="{{ route('messages.show', $message->id)}}">
                                    @switch($message->message_type)
                                        @case(1)
                                            <span class="badge badge-info">
                                                Information
                                            </span>
                                            @break
                                        @case(2)
                                            <span class="badge badge-primary">
                                                Meeting
                                            </span>
                                            @break
                                        @case(3)
                                            <span class="badge badge-secondary">
                                                Discipline
                                            </span>
                                            @break
                                        @default

                                    @endswitch
                                </a></td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="compose_message">
                <h3>Complete Message</h3>
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <h5><span class="badge badge-primary rounded-circle text-center" id="message-first-badge">1</span> &nbsp; Receivents: <span class="text-primary" id="receiver_type_text"> Students </span></h5>
                    <div class="row mt-3 ml-3" id="message-first-body">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:100px"></div>
                        <div class="col-md-2">
                            <div class="d-flex">
                                <input type="radio" name="receiver_type" id="Student_Receiver" class="form-control" checked
                                                    value="Students" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Student_Receiver">Students</label>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="d-flex">
                                <input type="radio" name="receiver_type" id="Teacher_Receiver" class="form-control"
                                    value="Teachers"  style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Teacher_Receiver">Teachers</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex">
                                <input type="radio" name="receiver_type" id="Bom_Receiver" class="form-control"
                                    value="BOM/PA"  style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Bom_Receiver">BOM/PA</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex">
                                <input type="radio" name="receiver_type" id="Staff_Receiver" class="form-control"
                                    value="Staff"  style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Staff_Receiver">Staff</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex">
                                <input type="radio" name="receiver_type" id="Alumni_Receiver" class="form-control"
                                    value="Alumni"  style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Alumni_Receiver">Alumni</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex">
                                <input type="radio" name="receiver_type" id="Other_Receiver" class="form-control"
                                    value="Other"  style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Other_Receiver">Others</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -60px">
                            <div class="text-left mt-3 ml-3">
                                <button type="button" class="btn btn-primary" id="set-message-receiver-type-btn">Next<i class="icon-paperplane ml-2"></i></button>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <h5 class="active-font-state" id="message-second-title"> <span class="badge active-badge-state rounded-circle text-center" id="message-second-badge" >2</span> &nbsp; Message Type</h5>
                    <div class="row mt-3 ml-3 active-state" id="message-second-body-students">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:100px"></div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input type="checkbox" name="All_Students_Message" id="All_Students_Message" class="form-control"
                                                    value="All Students" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="All_Students_Message">All Students</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input type="checkbox" name="Specific_Students_Message" id="Specific_Students_Message" class="form-control"
                                                    value="Specific Students" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Specific_Students_Message">Specific Students</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input type="checkbox" name="Specific_Classes_Message" id="Specific_Classes_Message" class="form-control"
                                                    value="Specific Classes" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Specific_Classes_Message">Specific Classes</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex">
                                <input type="checkbox" name="Exam_Results_Message" id="Exam_Results_Message" class="form-control"
                                                    value="Exam Results" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Exam_Results_Message">Exam Results</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 ml-3 active-state" id="message-second-body-teachers">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:110px"></div>

                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="All_Teachers_Message" id="All_Teachers_Message" class="form-control"
                                                    value="All Teachers" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="All_Teachers_Message">All Teachers</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="Specific_Teachers_Message" id="Specific_Teachers_Message" class="form-control"
                                                    value="Specific Teachers" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Specific_Teachers_Message">Specific Teachers</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="Teachers_Groups_Message" id="Teachers_Groups_Message" class="form-control"
                                                    value="Teachers Groups" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Teachers_Groups_Message">Teachers Groups</label>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3 ml-3 active-state" id="message-second-body-bompa">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:100px"></div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="All_BOM_Message" id="All_BOM_Message" class="form-control"
                                                    value="All BOM/PA members" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="All_BOM_Message">All BOM/PA members</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="Specific_BOM_Message" id="Specific_BOM_Message" class="form-control"
                                                    value="Specific BOM/PA members" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Specific_BOM_Message">Specific BOM/PA members</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="BOM_Groups_Message" id="BOM_Groups_Message" class="form-control"
                                                    value="BOM/PA Groups" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="BOM_Groups_Message">BOM/PA Groups</label>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3 ml-3 active-state" id="message-second-body-staff">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:100px"></div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="All_Staff_Message" id="All_Staff_Message" class="form-control"
                                                    value="All Staff members" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="All_Staff_Message">All Staff members</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="Specific_Staff_Message" id="Specific_Staff_Message" class="form-control"
                                                    value="Specific Staff members" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Specific_Staff_Message">Specific Staff members</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <input type="checkbox" name="Staff_Groups_Message" id="Staff_Groups_Message" class="form-control"
                                                    value="Staff Groups" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="Staff_Groups_Message">Staff Groups</label>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3 mb-3 ml-3 active-state" id="message-second-body-alumni">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:100px"></div>
                        <div class="col-12">
                            <div class="d-flex">
                                <label for="alumni_category">Graduation Class</label>
                            </div>
                            <div class="d-flex">
                                <select class="select form-control" id="alumni_category" name="alumni_category" data-fouc data-placeholder="Graduation Class Category">
                                    <option value="">Select Graduation Class</option>
                                    <option value={{ now()->year }}>Class of {{ now()->year }}</option>
                                    <option value={{ now()->year -1 }}>Class of {{ now()->year -1 }}</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="row active-state ml-1" id="message-second-footer" style="margin-top: -60px;">
                        <div class="col-12"  id="message-second-body-category" style="margin-top:-10px;">
                            <div class="form-group">
                                <label for="message_type_category">Teachers</label>
                                <select class="select form-control" id="message_type_category" multiple  onchange="selectChange();" name="message_type_category[]" data-fouc data-placeholder="Select....">
                                    <option value="">Information</option>
                                    <option value="2">Teacher1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 active-state"  id="message-second-body-category-detail" style="margin-top:-10px;">
                            <div class="form-group">
                                <label for="message_type_category_detail">Teachers</label>
                                <select class="select form-control" id="message_type_category_detail" multiple name="message_type_category_detail" data-fouc data-placeholder="Select....">
                                    <option value="">Information</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 text-left mt-3 ml-3">
                            <button type="button" class="btn btn-secondary"  id="back-message-type-btn">Back</button> &nbsp;
                            <button type="button" class="btn btn-primary"  id="next-message-type-btn">Next<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </div>
                    <br><br>
                    <h5 class="active-font-state" id="message-final-title"> <span class="badge active-badge-state  rounded-circle text-center" id="message-final-badge" >3</span> &nbsp; Final Step</h5>
                    <div class="row mt-3 ml-3 active-state" id="message-final-body">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:500px"></div>
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <label for="message_subject">Subject</label>
                                <input class="form-control" type="text" name="message_subject" id="message_subject" placeholder="Message Subject">
                            </div>
                        </div>
                        <div class="col-6 mt-3" id="message-final-category">
                            <div class="form-group">
                                <label for="message_category">Category</label>
                                <select class="select form-control" id="message_category" name="message_category" data-fouc data-placeholder="Message Category">
                                    <option value="1">Information</option>
                                    <option value="2">Meeting</option>
                                    <option value="3">Discipline</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -400px;">
                            <div class="col-12 active-state" id="message-final-phone">
                                <div class="card">
                                    <div class="card-body">
                                      <p class="card-title">
                                          phone number
                                      </p>
                                      <div id="emails-input"></div>
                                    </div>
                                    <div class="card-footer d-none">
                                        <button class='btn push-right' type="button" data-action='add-email'>Add email</button>
                                        <button class='btn' type="button" data-action='get-emails-count'>Get emails count</button>
                                      </div>
                                  </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                        <label for="message_content">Message</label>
                                        <textarea id="message_content" class="form-control" name="message_content" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-right text-grey ml-2">
                                    Message Count: 0(0 characters)
                                </div>
                                <div class="text-right text-grey ml-2">
                                    (The school's name shall be appended to the end of each message because the school does not have a unique Sender ID)
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex">
                                    <input type="checkbox" name="Send_Text_Message" id="Send_Text_Message" class="form-control" checked
                                                        value="Send Text Message" style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="Send_Text_Message">Send Text Message</label>
                                </div>
                                <div class="d-flex" id="check_mail">
                                    <input type="checkbox" name="Send_Email" id="Send_Email" class="form-control"
                                                        value="Send Text Message" style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="Send_Email">Send Email</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 ml-3 active-state" id="message-final-body1">
                        <div style="margin-left:-10px;border-left: 1px solid grey; height:500px"></div>
                        <div class="col-12">
                            <p>
                                Send Results To
                            </p>
                        </div>
                        <div class="row col-12" style="margin-top:-450px;">
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <input type="radio" name="final_type" id="Final_All_Receiver" class="form-control" checked
                                                        value="All Form students" style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="Final_All_Receiver">All Form Students</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="d-flex">
                                    <input type="radio" name="final_type" id="Final_Stream_Receiver" class="form-control"
                                        value="Specific Stream"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="Final_Stream_Receiver">Specific Stream</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <input type="radio" name="final_type" id="Final_Student_Receiver" class="form-control"
                                        value="Specific Student"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="Final_Student_Receiver">Specific Student</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" style="margin-top:-400px;">
                            <p>
                                Send to students with the selected grads
                            </p>
                        </div>
                        <div class="row ml-1" style="margin-top:-350px;">
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_a" id="chk_a" class="form-control" checked
                                        value="A"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_a"> A</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_a_minus" id="chk_a_minus" class="form-control" checked
                                        value="A-"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_a_minus"> A-</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_b_plus" id="chk_b_plus" class="form-control" checked
                                        value="B+"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_b_plus"> B+ </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_b" id="chk_b" class="form-control" checked
                                        value="B"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_b"> B </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_b_minus" id="chk_b_minus" class="form-control" checked
                                        value="B"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_b_minus"> B- </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_c_plus" id="chk_c_plus" class="form-control" checked
                                        value="C+"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_c_plus"> C+ </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_c" id="chk_c" class="form-control" checked
                                        value="C"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_c"> C </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_c_minus" id="chk_c_minus" class="form-control" checked
                                        value="C-"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_c_minus"> C- </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_d_plus" id="chk_d_plus" class="form-control" checked
                                        value="D+"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_d_plus"> D+ </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_d" id="chk_d" class="form-control" checked
                                        value="D"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_d"> D </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_d_minus" id="chk_d_minus" class="form-control" checked
                                        value="D-"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_d_minus"> D- </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_e" id="chk_e" class="form-control" checked
                                        value="E"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_e"> E </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_x" id="chk_x" class="form-control" checked
                                        value="X"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_x"> X </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <input type="checkbox" name="chk_y" id="chk_y" class="form-control" checked
                                        value="Y"  style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="chk_y"> Y </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="optional_message">Optional Message</label>
                                    <textarea id="optional_message" class="form-control" name="optional_message" rows="5" placeholder="Optional message to be sent along with the exam results"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="d-flex">
                                    <input type="checkbox" name="Send_Optional_Message" id="Send_Optional_Message" class="form-control"
                                                        value="Send Optional Message" style="width: 20px; height: 20px;">
                                    <label class="ml-2" for="Send_Optional_Message">Only send the optional message(exam results won't be sent along)</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3 col-12 active-state" style="margin-top:-300px;" id="final_message_btn">
                        <div class="text-left col-6">
                            <button type="button" class="btn btn-secondary"  id="back-message-content-btn">Back</button>
                        </div>
                        <div class="text-right col-6">
                            <button type="submit" class="btn btn-primary">Send<i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="sms_usage">
                <div class="row">
                    <div class="col-12">
                        <p class="text-secondary">Remaining SMS Credits</p>
                        <h1 class="text-success">{{ $balance }} Texts</h1>
                    </div>

                    <div class="col-12">
                        <hr>
                        <p><h4>SMS Usage</h4></p>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Sender</th>
                                <th>Type</th>
                                <th>Intended Recipients</th>
                                <th>Delivered</th>
                                <th>Failed</th>
                                <th>SMS Credits</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{-- {{ print_r($sms_messages) }} --}}
                                @for ($i = 0; $i < count($sms_messages); $i++)
                                <tr>
                                    <td>{{ $sms_messages[$i]['id'] }}</td>
                                    <td>{{ $sms_messages[$i]['title'] }}</td>
                                    <td>{{ $sms_messages[$i]['name'] }}</td>
                                    <td>
                                        @switch($sms_messages[$i]['type'])
                                            @case(1)
                                                <span class="badge badge-info">
                                                    SMS Msg
                                                </span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-primary">
                                                    SMS Msg
                                                </span>
                                                @break
                                            @case(3)
                                                <span class="badge badge-secondary">
                                                    SMS Msg
                                                </span>
                                                @break
                                            @default

                                        @endswitch
                                    </td>
                                    <td>{{ $sms_messages[$i]['recipients'] }}</td>
                                    <td>{{ $sms_messages[$i]['delivered'] }}</td>
                                    <td>{{ $sms_messages[$i]['failed'] }}</td>
                                    <td>{{ $sms_messages[$i]['credits'] }} Credits</td>
                                    <td>{{ $sms_messages[$i]['date'] }}</td>
                                    <td><a href="{{ route('messages.msggroup', $sms_messages[$i]['id']) }}" class="dropdown-item"><i class="icon-eye"></i></a></td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane whitesmoke" id="sms_by">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-secondary">Remaining <br> SMS Credits</p>
                                <h3 class="text-success">{{ $balance }} Texts</h3>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body text-secondary">
                                <p>To buy SMS credits via MPESA, use the details below</p>
                                <br>
                                <p>Paybill Number: 525900</p>
                                <p>Account Number: ALVINCY.API</p>
                                <br>
                                <p><strong>Please Note:</strong></p>
                                <p>1 Input an amount greater than Ksh.50/-</p>
                                <p>2 Ensure that the account number you specify in MPESA is exactly as shown above i.e. SMS3192. if you ignore any letter
                                    or number, the payment will be rejected
                                </p>
                                <p>3 Once you make the payment, Safaricom will notify you that the payment has been made to Litemore Ltd</p>
                                <br>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>SMS charges are Ksh. 1/- per SMS</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row col-12 justify-content-end">
                                            {{-- <button class="btn btn-primary" id="message-view-sms">View SMS Purchases</button> --}}
                                            <a class="btn btn-primary" id="message-view-sms" href="{{ route('main.buy') }}">View SMS Purchases</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('partials.js.message_js')
@include('partials.js.util_js')
@include('partials.js.phone_input_js')
@include('partials.js.app_js')
{{-- @include('partials.css.app_css') --}}
@include('partials.css.phone_css')
@endsection
