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
        <div class="row ml-1">
            <div class="col-6 text-left">
                <h3>Edit Exam</h3>
            </div>
            <div class="col-6 text-right">
                <a href="/exam_manage/add/{{ $exam->id }}" class="bg-success py-2 px-3" style="border-radius: 5px;">Add form</a>
            </div>
        </div>
        <form action="{{ route('exams.update', $exam->id) }}"  method="post">
            @csrf @method('PUT')
            <div class="col-12">
                <hr>
                <p><h4>Exam Name</h4></p>
                <input class="form-control" type="text" name="exam_name" value={{ str_replace(' ', '-', $exam->name) }}>
            </div>
            <div class="row">
                <div class="col-6 text-left pt-2 pl-3">
                    <a href="/exams" class="btn btn-secondary">Back</a>
                </div>
                <div class="col-6 text-right pt-2 pr-3">
                    <button type="submit" class="btn btn-info">
                        Update Name
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@include('partials.js.exam_js')
@endsection
