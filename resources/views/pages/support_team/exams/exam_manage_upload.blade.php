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
            <h4>Exam</h4>
            {{-- <select class="select form-control" id="upload_exam" name="upload_exam" data-fouc data-placeholder="Select Exam...">
                <option value="">Select ...</option>
                <option value={{ now()->year }}>TEST {{ now()->year }}A - Term 2 - {{ now()->year }}</option>
                <option value={{ now()->year -1 }}>TEST {{ now()->year - 1}}A - Term 2 - {{ now()->year -1 }}</option>
            </select> --}}
            <p><h4>{{ $exam->name }} - {{ $exam->term }} - {{ $exam->year }}</h4></p>
        </div>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-4">
                    <h4>Form</h4>
                    <input type="text" name="upload_form" id="upload_form" class="form-control" value={{ $form->name }}>
                </div>
                <div class="col-4">
                    <h4>Term</h4>
                    <input type="text" name="upload_term" id="upload_term" class="form-control" value={{ $exam->term }}>
                </div>
                <div class="col-4">
                    <h4>Year</h4>
                    <input type="text" name="upload_year" id="upload_year" class="form-control" value={{ $exam->year }}>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <h5>
                <a href="/exams/download" class="text-success">Download</a> and fill the template then upload it below.(You may delete subjects that aren't taken. Please leave the other column headers intact.)
            </h5>
            <input type="file" name="upload_file" id="upload_file" placeholder="Choose File">
        </div>
        <div class="row align-items-center ml-1">
            <div class="col-6 text-left pt-2">
                <a href="/exams" class="btn btn-secondary">Back</a>

            </div>
            <div class="col-6 text-right pt-2">
                <a href="/exam_manage/upload/{{ $exam->id }}/{{ $form->id }}" class="btn btn-primary">Upload class Results</a>
            </div>
        </div>


    </div>
</div>
@include('partials.js.exam_js')
@endsection
