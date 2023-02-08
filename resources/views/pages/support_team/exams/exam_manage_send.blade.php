@extends('layouts.master')
@section('page_title', 'Manage Exams')
@section('content')
<style>
    ul {
        list-style-type: none;
    }
    .forms_sitting_exam {
        margin: 1rem;
        padding: 0;
    }
    .one-sitting {
        border-top: 1px solid #00000042;
        border-bottom: 1px solid #00000042;
    }
    .one-sitting.odd {
        background: rgb(227 225 225 / 50%);
    }
    .active-state {
        display: none;
    }
    .card{
        margin-top:90px;overflow:hidden;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="col-12">
            <h4>Send Results - Form 4 - End of term 1, 2022 - (2022 Term 1)</h4>
        </div>
        <hr>
        <br>
        <h4>Send Results To</h4>
        <form action="{{ route('exam_manage_send_msg') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex">
                        <input type="radio" name="exam_manage_all_students" id="exam_manage_all_students" class="form-control" checked
                            value="1" style="width: 20px; height: 20px;">
                        <label class="ml-2" for="exam_manage_all_students">All form 4 students</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex">
                        <input type="radio" name="exam_manage_specific_stream" id="exam_manage_specific_stream" class="form-control"
                            value="2"  style="width: 20px; height: 20px;">
                        <label class="ml-2" for="exam_manage_specific_stream">Specific Stream</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex">
                        <input type="radio" name="exam_manage_specific_student" id="exam_manage_specific_student" class="form-control"
                            value="3"  style="width: 20px; height: 20px;">
                        <label class="ml-2" for="exam_manage_specific_student">Specific Student</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="exam_manage_stream">Stream</label>
                        <select name="exam_manage_stream" class="form-control select" id="exam_manage_stream" class="form-control" data-fouc data-placeholder="Select Stream">
                            <option value="">Select...</option>
                            <option value="1">Stream 1</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <h5>Send to Students with the selected grades</h5>
            <div class="row p-3">
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_a" id="grade_a" checked> A
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_a_minus" id="grade_a_minus" checked> A-
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_b_plus" id="grade_b_plus" checked> B+
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_b" id="grade_b" checked> B
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_b_minus" id="grade_b_minus" checked> B-
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_c_plus" id="grade_c_plus" checked> C+
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_c" id="grade_c" checked> C
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_c_minus" id="grade_c_minus" checked> C-
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_d_plus" id="grade_d_plus" checked> D+
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_d" id="grade_d" checked> D
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_d_minus" id="grade_d_minus" checked> D-
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_e" id="grade_e" checked> E
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_x" id="grade_x" checked> X
                </div>
                <div class="col-2 m-2">
                    <input type="checkbox" name="grade_y" id="grade_y" checked> Y
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="exam_manage_msg">Optional Message</label>
                        <textarea id="exam_manage_msg" class="form-control" name="exam_manage_msg" rows="3" placeholder="Otional message to be sent with the exam results"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-left">
                    <div class="form-check">
                        <input id="only_msg" class="form-check-input" type="checkbox" name="only_msg">
                        <label for="only_msg" class="form-check-label">
                            Only Send the optional message(exam results won't be sent along)
                        </label>
                    </div>
                </div>
            </div>
            <div class="row align-items-center ml-1">
                <div class="col-6 text-left pt-2">
                    <div class="row">
                        <a href="/exams" class="btn btn-primary mr-1">Back</a>
                    </div>
                </div>
                <div class="col-6 text-right pt-2 pr-3">
                    <button type="submit" class="btn btn-info">Send</button>
                </div>
            </div>
        </form>

    </div>
</div>
@include('partials.js.exam_publish_js')
@endsection
