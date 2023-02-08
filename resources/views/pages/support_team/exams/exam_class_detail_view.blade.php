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
        margin-top:50px;overflow:hidden;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h4>Exam Results - Form 3 West - Kiswahili</h4>
            </div>
        </div>
        <hr>
        <form action="{{ route('exam_class_score') }}" method="post">
            @csrf
            <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group">
                        <label for="exam_class_name">Exam</label>
                        <input type="text" name="exam_class_name" id="exam_class_name" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="exam_class_marks">Maximum Marks</label>
                        <input type="number" name="exam_class_marks" id="exam_class_marks" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row ml-1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admission Number</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>%</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>989</td>
                            <td>Moses Nderitu Kamau</td>
                            <td>37</td>
                            <td>62</td>
                            <td><button class="btn btn-secondary">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="row align-items-center ml-1">
                <div class="col-6 text-left pt-2">
                    <button type="button" class="btn btn-primary">Action</button>
                </div>
                <div class="col-6 text-right pt-2">
                    <button type="submit" class="btn btn-success">Publish</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- @include('partials.js.exam_js') --}}
@endsection
