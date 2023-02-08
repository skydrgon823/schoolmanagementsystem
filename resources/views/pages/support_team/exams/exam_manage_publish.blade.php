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
            <h4>Publish Results form 1</h4>
        </div>
        <hr>
        <div class="col-12">
            <div class="form-group">
                <label for="exam_manage_term">Exam</label>
                <select class="select form-control" id="exam_manage_term" name="exam_manage_term" data-fouc data-placeholder="Select Term...">
                    <option value="">Select ...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>
        </div>
        <br>
        <h4>Status of class results</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Class</th>
                    <th colspan="2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>form 1 East</td>
                    <td>
                        <i class="icofont-checked"></i>
                    </td>
                    <td>
                        <a href="/exam_class/view" class="btn btn-secondary">View</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <h4>Ranking Criteria</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex">
                    <input type="radio" name="exam_manage_raking" id="rank_mean_marks" class="form-control" checked
                        value="1" style="width: 20px; height: 20px;">
                    <label class="ml-2" for="rank_mean_marks">Rank by Mean marks</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex">
                    <input type="radio" name="exam_manage_raking" id="rank_kcpe" class="form-control"
                        value="2"  style="width: 20px; height: 20px;">
                    <label class="ml-2" for="rank_kcpe">Rank by KCPE points</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <input type="radio" name="exam_manage_raking" id="rank_mean_points" class="form-control"
                        value="3"  style="width: 20px; height: 20px;">
                    <label class="ml-2" for="rank_mean_points">Rank by Mean points  </label>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="exam_manage_mini_subjects">Minimum number of subjects that can be taken</label>
                    <input type="number" name="exam_manage_mini_subjects" id="exam_manage_mini_subjects" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="exam_manage_overall_grading">Overall Grading System</label>
                    <select name="exam_manage_overall_grading" class="form-control select" id="exam_manage_overall_grading" class="form-control" data-fouc data-placeholder="Select Grading System">
                        <option value="">Select...</option>
                        <option value="1">BIBIRIONI</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <h4>Subject Grading System</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Grading System</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>English</td>
                    <td class="p-0">
                        <div class="col-12">
                            <select name="exam_manage_grading" class="form-control select" id="exam_manage_grading" class="form-control" data-fouc data-placeholder="Select Grading System">
                                <option value="">Select...</option>
                                <option value="1">System 1</option>
                                <option value="2">System 2</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row align-items-center ml-1">
            <div class="col-6 text-left pt-2">
                <div class="row">
                    <a href="/exams" class="btn btn-primary mr-1">Back</a>
                    <div class="dropdown ml-1">
                        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Action
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action 1</a></li>
                            <li><a href="#">Action 2</a></li>
                            <li><a href="#">Action 3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6 text-right pt-2 pr-3">
                <button onclick="publishResults();" class="btn btn-info">Publish Results</button>
            </div>
        </div>


    </div>
</div>
@include('partials.js.exam_publish_js')
@endsection
