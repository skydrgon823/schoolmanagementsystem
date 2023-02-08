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
        margin-top:20px;overflow:hidden;
    }
    #grade-tbody>tr>td{
            font-family: Open Sans,Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 1rem;
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            padding:0.1rem 0.5rem !important;
            vertical-align:0%;
        }
</style>
<div class="card" style="text-align: left">
    <div class="card-body">
        <div class="row" >
            <div class="col-6">
                <h4>Grading Systems</h4>
            </div>
            <div class="col-6 text-right">
                <a href="/exams" class="bg-primary p-2" style="border-radius: 5px"><- Close</a>
            </div>

        </div>
        <hr>
        <div>
            {{-- @csrf action="{{ route('exams.grade_store') }}" method="post"--}}
            <div class="row">
                <div class="col-12">
                    <h5 id="exam_add_title">Grading System Name</h5>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control" id="exam-grading-name" placeholder="Name" onblur="validateName();" onchange="validateName();">
                    <span id="exam-grade-name-error" class="text-danger"></span>
                </div>
            </div>
            <br>
            <h6>Grading Grid (Start with the lowest)</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="d-none">ID</th>
                        <th>#</th>
                        <th>Low</th>
                        <th>High</th>
                        <th>Grade</th>
                        <th>Points</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="grade-tbody">
                    <span class="d-none">{{ $k=0 }}</span>
                    @foreach ($grades as $grade)
                        <tr class="exam-row{{ ++$k }}">
                            <td class="d-none exam-grade{{ $k }}">{{ $grade->id }}</td>
                            <td>{{ $k }}</td>
                            <td><input type="number" class="form-control" oninput="validateMin({{ $k }}, event)" id="exam-grade-table-low{{ $k }}"><br/><span id="exam-grade-table-low-error{{ $k }}" class="text-danger d-none"></span></td>
                            <td><input type="number" class="form-control" oninput="validateMax({{ $k }}, event)" id="exam-grade-table-high{{ $k }}"><br/><span id="exam-grade-table-high-error{{ $k }}" class="text-danger d-none"></span></td>
                            <td><input type="text" id="exam-grade-table-name{{ $k }}" class="form-control exam-grade-table-name{{ $k }}" oninput="validateGrade({{ $k }}, event)"><br/><span id="exam-grade-table-name-error{{ $k }}" class="text-danger d-none"></span></td>
                            <td><input type="number" id="exam-grade-table-mark{{ $k }}" class="form-control exam-grade-table-mark{{ $k }}" oninput="validateMark({{ $k }}, event)"><br/><span id="exam-grade-table-mark-error{{ $k }}" class="text-danger d-none"></span></td>
                            <td>
                                <div class="row text-center">
                                    <div class="col-6 border-right">
                                        <button class="btn btn-secondary" onclick="gradeAdd({{ $k }}, {{ $grades_max }})">+ Add</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger" onclick="gradeRemove({{ $k }})"><i class="icofont-trash"></i>Remove</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <span style="font-size:13px;font-style:italic">Add marks upto 100</span>
            <div class="row align-items-center">
                <div class="col-6 text-left pt-2">
                    <span class="show-container" style="cursor: pointer">Show Sample
                    </span>
                    <i class="icofont-arrow-down"></i>
                    <i class="icofont-arrow-up active-state"></i>
                </div>
                <div class="col-6 text-right pt-2 pr-3">
                    <button class="btn btn-info save-container">Save Grading System</button>
                </div>
            </div>
            <br>
            <div class="active-state sample-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="d-none">#<th>
                            <th>Low</th>
                            <th>High</th>
                            <th>Grade</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <span class="d-none">{{ $k=0 }}</span>
                        @foreach ($grades as $grade)
                            <tr id="grade{{ $grade->id }}">
                                <td>{{ ++$k }}</td>
                                <td class="exam-grade-low{{ $k }}">{{ $grade->mark_from }}</td>
                                <td class="exam-grade-high{{ $k }}">{{ $grade->mark_to }}</td>
                                <td class="exam-grade-name{{ $k }}">{{ $grade->name }}</td>
                                <td class="exam-grade-mark{{ $k }}">{{ $grade->remark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 text-right pt-2 pr-3">
                    <span class="sample d-none">{{ count($grades) }}</span>
                    <button class="btn btn-info auto-fill">AutoFill With Sample</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.js.grade_js')
@endsection
