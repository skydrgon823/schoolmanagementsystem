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
        <form action="{{ route('exam_class_upload_mark') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h4>Upload Results - Form -{{ $class_subject->my_class->form->name }} {{ $class_subject->my_class->stream }} - {{ $class_subject->subject->title  }}</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h4>Upload Type</h4>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <input type="radio" name="exam_class_upload_type" id="exam_class_upload_key" class="form-control" checked
                                    value="1" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="exam_class_upload_key">Key in makks</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <input type="radio" name="exam_class_upload_type" id="exam_class_upload_mark" class="form-control"
                                    value="1" style="width: 20px; height: 20px;">
                                <label class="ml-2" for="exam_class_upload_mark">Upload results from a spreadsheet</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="exam_class_upload_exam">Exam</label>
                    <input type="text" name="exam_class_upload_exam" class="form-control" id="exam_class_upload_exam" placeholder="{{ $exam->name }}" disabled>
                </div>
                <div class="col-6">
                    <label for="exam_class_upload_max">Maximum Marks*</label>
                    <input type="number" name="exam_class_upload_max" class="form-control" id="exam_class_upload_max" placeholder="'out of' value e.g. 30" disabled>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="exam-class-subject">Subject Paper</label>
                        <select class="select form-control" id="exam-class-subject" name="exam_class_subject" data-fouc data-placeholder="Subject Paper...">
                            <option value=""></option>
                            <option value="1">Paper 1</option>
                            <option value="2">Paper 2</option>
                            <option value="3">Paper 3</option>
                        </select>
                    </div>
                </div>
            </div>
            <h4>Students Without Results</h4>
            <input type="text" name="class_exam_count" value="{{ count($class_subject->my_class->students) }}" class="d-none">
            <input type="text" name="subjectID" value="{{ $subject_id }}" class="d-none">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Admission No</th>
                            <th>Name</th>
                            <th>Marks</th>
                            <th class="d-none">StudentID</th>
                            <th class="d-none">MyClassID</th>
                            <th class="d-none">ExamID</th>
                            <th class="d-none">TeacherID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $len = count($class_subject->my_class->students); ?>
                        @for ($i = 0; $i < $len; $i++)
                            @foreach ($marks as $mark)
                                @if (($mark->student_id == $class_subject->my_class->students[$i]->id)&&($mark->pos>0))
                                    <tr>
                                        <td>{{ $class_subject->my_class->students[$i]->adm_no }}</td>
                                        <td>{{ $class_subject->my_class->students[$i]->user->name }}</td>
                                        <td>{{ $mark->pos }}</td>
                                        <td class="d-none"><input type="text" name="student{{ $i }}" value="{{ $class_subject->my_class->students[$i]->id }}"></td>
                                        <td class="d-none"><input type="text" name="class{{ $i }}" value="{{ $class_subject->my_class_id }}"></td>
                                        <td class="d-none"><input type="text" name="Exam{{ $i }}" value="{{ $exam_id }}"></td>
                                        <td class="d-none"><input type="text" name="teacher{{ $i }}" value="{{ $teacher_id }}"></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="row align-items-center ml-1">
                <div class="col-6 text-left pt-2">
                    <a href="/exams" class="btn btn-secondary">Back</a>

                </div>
                <div class="col-6 text-right pt-2">
                    {{-- <a href="/exams" class="btn btn-primary">Upload Subject Results</a> --}}
                    <button type="submit" class="btn btn-primary d-none">Upload Subject Results</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- @include('partials.js.exam_js') --}}
@endsection
