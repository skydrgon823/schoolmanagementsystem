@extends('layouts.master')
@section('page_title', 'Manage Classes')
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
            <ul class="nav nav-tabs nav-tabs-highlight cardpos">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Edit Class</a></li>
            </ul>

            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="all-classes">

                    <form class="ajax-update-class-subject" data-reload="#page-header" method="post" action="{{ route('classes.update', $classId) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_id" class="col-lg-3 col-form-label font-weight-semibold">Form</label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Form" class="form-control select" name="form_id" id="form_id">
                                            <option value="1" @if ($myclass->form_id == 1) selected @endif >1</option>
                                            <option value="2" @if ($myclass->form_id == 2) selected @endif >2</option>
                                            <option value="3" @if ($myclass->form_id == 3) selected @endif >3</option>
                                            <option value="4" @if ($myclass->form_id == 4) selected @endif >4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Stream Name</label>
                                    <div class="col-lg-9">
                                        <input name="stream" id="stream" value="{{ $myclass->stream }}" required type="text" class="form-control" placeholder="Stream Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php  $subject_type = ''; $cnt = 0;?>
                            @foreach ($all_subjects as $subject)
                                @if($cnt == 0) <div class="col-md-4"> @endif

                                @if($subject_type != $subject->subject_type->id)<h3>{{$subject->subject_type->name}}</h3> <?php $subject_type = $subject->subject_type->id;?> @endif
                                    <input type="checkbox" id="{{$subject->subject_type->name.$subject->title}}" name="{{$subject->subject_type->name.$subject->title}}" value="{{$subject->id}}" @if(in_array($subject->id, $myclasssubject)) checked disabled  @endif >
                                    <label for="{{$subject->subject_type->name.$subject->title}}">{{$subject->title}}</label><br>

                                @if($cnt == 13) </div> @endif
                                <?php $cnt++; if($cnt == 14) $cnt = 0; ?>

                            @endforeach
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                            <a class="btn btn-warning" href="{{ route('class_subject_manage', $classId) }}" >Back</a>
                        </div>
                        @method('PUT')
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{--Class List Ends--}}

@endsection

