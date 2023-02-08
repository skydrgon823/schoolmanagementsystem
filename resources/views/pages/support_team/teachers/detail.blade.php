@extends('layouts.master')
@section('page_title', 'Teacher Classes')
@section('content')
<style>
    .card{
        margin-top:50px;overflow:hidden;
    }
    .cardpos{
        position:fixed;width:100%;z-index:10;
    }
    .tabpos{
        margin-top: 70px;
    }
    .cardpos>li{
            width:180px;
        }
        .cardpos>li>a{
            text-align: center;
            padding:5px 10px;
        }
</style>
    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style="transform:translateX(-22px);">
                    <li class="nav-item"><a href="#teacher-classes" class="nav-link active" data-toggle="tab">Teacher Classes</a></li>
            </ul>
            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="teacher-classes">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card my-2 px-5">
                                {{-- {{ $person->user }} --}}
                                <div class="row">
                                    <div>
                                        <img class="p-2 rounded-circle" src="/{{ $person->user->photo_by }}/{{  $person->user->photo }}" width="100" height="100"/>
                                    </div>
                                    <div class="person my-auto">
                                        <div class="d-flex justify-content-center py-1">
                                            {{ $person->user->name }}
                                        </div>
                                        <div class="d-flex">
                                            {{ $person->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($subjects as $key => $subject)
                            @foreach ($exams as $exam)
                            <?php $mark = 0;$count=0;$student_count=0; ?>
                            <div class="col-md-3">
                                <div class="card my-2">
                                    <div class="d-flex flex-column align-items-center welcome-pane">
                                            <div class="my-3 text-center">
                                                <h5> Form {{ $subject->my_class->form->name }}  {{ $subject->my_class->stream }} - {{ $subject->subject->title }} </h5>
                                                <h6> {{ $exam->name }} - ({{ $exam->year }} Term{{ $exam->term }})</h6>
                                                <hr>
                                                @foreach ($exam_records as $exam_record)
                                                    {{-- @if ($exam_record->exam_id == $exam->id && $exam_record->my_class_id == $subject->my_class->id && $subject->id == $exam_record->af && $exam_record->year == $exam->year) --}}
                                                    @if ($exam_record->my_class_id == $subject->my_class->id && $exam_record->year == $exam->year)
                                                        <?php $mark += $exam_record->pos;?>
                                                        <?php $count = $count + 1;?>
                                                    @endif
                                                @endforeach
                                                @foreach ($students as $student)
                                                    @if ($student->my_class_id == $subject->my_class->id)
                                                        <?php $student_count++;?>
                                                    @endif
                                                @endforeach
                                                <div class="row col-md-12">
                                                    <div class="col-md-6">
                                                        <span>Mean Points</span><br>
                                                        @if ($count > 0)
                                                            <span class="text-info">{{ round($mark/ $count, 2)}}</span>
                                                        @else
                                                            <span class="text-info">0.00</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>Mean Marks</span><br>
                                                        @if ($count>0 && $student_count>0)
                                                            <span class="text-info">{{ round($mark/($count*$student_count) * 100, 2) }} %</span>
                                                        @else
                                                            <span class="text-info">0.00%</span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row col-md-12">
                                                    <div class="col-md-6">
                                                        <span>Mean Grade</span><br>
                                                        @foreach ($grades as $grade)
                                                            @if ($grade->mark_from<=$mark && $grade->mark_to>=$mark)
                                                                <span class="text-info">{{ $grade->name }}</span>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                    <div class="col-md-6">
                                                        <span>Students</span><br>
                                                        <span class="text-info">{{ $student_count }}</span>
                                                    </div>
                                                </div>

                                                {{-- <h6>{{$teacher->user->email}}</h6>
                                                <h6 class="text-success">
                                                    @if($teacher->user->phone)
                                                        {{$teacher->user->phone}}
                                                    @else
                                                        <br>
                                                    @endif
                                                </h6> --}}
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('partials.js.class_index')
@endsection

