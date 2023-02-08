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
                <h5>CAT 1 - (2022 Term 2)</h5>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Subject Teacher</th>
                        <th>Student Without Marks</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Form 3 West</td>
                        <td>Kiswahili</td>
                        <td>Kamau Andey</td>
                        <td>16 / 37 Don't have marks</td>
                        <td>Pending publishing by <span class="text-danger">Class Teacher</span></td>
                        <td><a href="/exam_class/detail_view" class="btn btn-secondary">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Subject Teacher</th>
                        <th>Students</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Form 3 West</td>
                        <td>English</td>
                        <td>Mercy</td>
                        <td>37</td>
                        <td><button class="btn btn-secondary">Upload Results</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="row align-items-center ml-1">
            <div class="col-6 text-left pt-2">
                <a href="/exams" class="btn btn-secondary">Back</a>
                <button class="btn btn-success">Download Results</button>
            </div>
            <div class="col-6 text-right pt-2">
                <a href="/exam_class/grant" class="btn btn-primary">Grant access to subject teachers</a>
            </div>
        </div>
        <br>
        <div class="row ml-1">
            <div class="col-12">
                <span>* Some subject teachers have already published their subject results, hence they'll be unable to add new results.
                    To allow subject teachers to enter results, click 'Grant Access To Subject Teachers' button above.
                </span>
            </div>
        </div>
    </div>
</div>
{{-- @include('partials.js.exam_js') --}}
@endsection
