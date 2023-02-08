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
            <div class="col-12">
                <h4>Exam Publishing - 3 West</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h4>Select subjects to grant access to the respective subject teachers</h4>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Subject Teacher</th>
                        <th>Stuent Without Marks</th>
                        <th>Status</th>
                        <th>
                            <input type="checkbox" name="exam-class-grant-check" id="exam-class-grant-check">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Form3 West</td>
                        <td>Kiswahili</td>
                        <td>Kamau Andey</td>
                        <td>16/37 Don't have marks</td>
                        <td>Pending publishing by <span class="text-danger">Class Teacher</span></td>
                        <td>
                            <input type="checkbox" name="exam-class-grant-chk1" id="exam-class-grant-chk1">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row align-items-center ml-1">
            <div class="col-6 text-left pt-2">
                <a href="/exams" class="btn btn-secondary">Cancel</a>

            </div>
            <div class="col-6 text-right pt-2">
                <a href="/exam_class/view" class="btn btn-primary">Grant Access</a>
            </div>
        </div>
    </div>
</div>
{{-- @include('partials.js.exam_js') --}}
@endsection
