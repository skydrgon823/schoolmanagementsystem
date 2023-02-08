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
        <div class="row">
            <div class="col-3">
                <div class="row d-flex flex-column text-center">
                    <i class="icofont-home" style="font-size: 100px;"></i>
                    <h3>Form1</h3>
                    <p>End of term 1, 2022 - (2022 Term 1)</p>
                </div>
                <div class="row text-center">
                    <div class="col-6 d-flex flex-column">
                        <h5>Mean Points</h5>
                        <h3 class="text-success">
                            2.2857
                        </h3>
                        <span>-0.3571</span>
                    </div>
                    <div class="col-6 d-flex flex-column">
                        <h5>Mean Marks</h5>
                        <h3 class="text-success">
                            29.3%
                        </h3>
                        <span>
                            -3.6
                        </span>
                    </div>
                </div>
                <hr>
                <div class="row d-flex flex-column text-center">
                    <span>Mean Grade</span>
                    <h3><strong>D-</strong></h3>
                </div>
            </div>
            <div class="col-6">
                <div class="row d-flex flex-column text-center">
                    <h5>Performance of Form 1 streams</h5>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exam_manage_term">Change Exam</label>
                            <select id="exam_manage_term" class="select form-control" name="exam_manage_term" data-placeholder="Select Term...">
                                <option value="">Select Exam ...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exam_manage_stream">Change Stream</label>
                            <select id="exam_manage_stream" class="select form-control" name="exam_manage_stream" data-placeholder="Select Stream...">
                                <option value="">Select Stream ...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="row d-flex flex-column text-center">
                    <i class="icofont-student-alt" style="font-size: 100px;"></i>
                    <h3>67 Students</h3>
                    <p>Students who sat for the exam</p>
                </div>
                <div class="row justify-content-center m-2">
                        <button class="btn btn-primary" onclick="showMerit()">Merit List</button>
                </div>
                <div class="row justify-content-center m-2">
                    <button class="btn btn-primary" onclick="showImproveList()"> Most improved list</button>
                </div>
                <div class="dropdown text-center">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Report Forms
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Form 1</a></li>
                        <li><a href="#">Form 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h3>Subject Performance</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Points</th>
                            <th>Change</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Geography</td>
                            <td>3.7778</td>
                            <td>-1.1111</td>
                            <td>D+</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h3>Performance Over Time</h3>
            </div>
        </div>
        <div class="row align-items-center ml-1">
            <div class="col-6 text-left pt-2">
                <div class="row">
                    <a href="/exams" class="btn btn-primary mr-1">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.exam_publish_js')
@endsection
