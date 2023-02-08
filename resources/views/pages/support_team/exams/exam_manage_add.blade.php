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
            <h4>Add Form To This Exam</h4>
        </div>
        <div class="col-12">
            <hr>
            @if (count($exam_forms)>0)
                <h4 id="exam_add_title">Add classes that sat for the exam</h4>
            @else
                <h4>All forms are taking this exam</h4>
            @endif

        </div>
        <input type="hidden" name="exam_id" value={{ $exam_id }}>
        <table class="table table-striped table-bordered">
            <tbody>
                @foreach ($exam_forms as $exam_form)
                    <tr>
                        {{-- {{ $exam_form['id'] }} --}}
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-4">
                                    <input type="checkbox"  name={{ "chk".$exam_form['id'] }} id={{"chk".$exam_form['id']}}> <span> Form {{ $exam_form['name']}}</span>
                                </div>
                                <div class="col-8">
                                    <input type="number" required class="form-control" name={{ "form".$exam_form['id'] }} id={{ "form".$exam_form['id'] }} placeholder="Minimun Subjects that can be taken">
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row align-items-center ml-1">
            <div class="col-6 text-left pt-2">
                <a href="/exams/{{ $exam_id }}" class="btn btn-secondary">Back</a>

            </div>
            <div class="col-6 text-right pt-2 pr-3">
                <button onclick="addSelected({{ $exam_id }});" class="btn btn-info">Add Selected</button>
            </div>
        </div>
        </form>
    </div>
</div>
@include('partials.js.exam_js')
@endsection
