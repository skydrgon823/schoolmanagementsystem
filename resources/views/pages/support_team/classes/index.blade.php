@extends('layouts.master')
@section('page_title', 'Manage Classes')
@section('content')
    <style>
        tbody>tr>td{
            font-family: Open Sans,Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 1rem;
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            padding:0.1rem 0.5rem !important;
        }
        td>a{
            font-size:0.925rem;
            line-height: 1.35px;
        }
        tbody tr:nth-child(odd){
            background-color: white;
            color: #000;
        }
        tbody {
            font-size: 10px !important;

        }
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
    <div class="card" style="background-color:whitesmoke">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style=" transform:translateX(-22px);">
                @if ($types=="student" || $types == "staff" || $types == "teacher")
                    <li class="nav-item"><a href="#my-classes" class="nav-link active" data-toggle="tab" onclick="showMyClass();">My Classes</a></li>
                @else
                    <li class="nav-item"><a href="#my-classes" class="nav-link active" data-toggle="tab" onclick="showMyClass();">My Classes</a></li>
                    <li class="nav-item"><a href="#all-classes" class="nav-link" data-toggle="tab">Manage Classes</a></li>
                    <li class="nav-item"><a href="#add-class" class="nav-link" data-toggle="tab">Add New Class</a></li>
                @endif

            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active tabpos" id="my-classes">
                    <div class="row">
                        <div class="col-12" style="margin: -30px auto;padding-left:20px;padding-right:20px;">
                            <div class="card p-2">
                                <div class="form-group">
                                    <h3 style="font-weight: 700;text-align:left">Subject Classes</h3>
                                    <hr style="background-color: whitesmoke">
                                    <table class="table table-striped table-bordered table-sm table-hover mb-0">
                                        <thead>
                                        <tr class="text-center">
                                            <th style="width: 10%">*</th>
                                            <th style="width: 60%;text-align:left">Name</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $num=0; ?>

                                            @if ($types=="student" || $types == "staff" || $types == "teacher" || $types == "admin")
                                                @foreach ($all_streams as $val)
                                                    @if ($teacher!=null && $val->teacher_id ==$teacher->id)
                                                        @foreach ($all_myclasses as $item)
                                                            @if ($item->id ==$val->my_class_id)
                                                                <tr>
                                                                    <td><?php echo ++$num; ?></td>
                                                                    <td style="text-align: left"> Form {{ $item->form->name }} {{ $item->stream }} - {{ $val->subject->title }} </td>
                                                                    <td class="d-flex">
                                                                        <div class="col-6 border-right">
                                                                            <a class="btn btn-primary p-2"  href="{{ route('class_manage1', $val->my_class->form_id) }}" ><i class="icofont-settings"></i> Manage </a>
                                                                        </div>
                                                                        {{-- &nbsp;&nbsp; --}}
                                                                        <div class="col-6">
                                                                            <a class="btn btn-success p-2"  href="{{ route('class_list2', $val->my_class->id) }}" ><i class="icofont-list"></i> Class list </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($all_streams as $val)
                                                    @foreach ($all_myclasses as $item)
                                                        @isset($item->teacher->user->name)
                                                        <tr>
                                                            <td><?php echo ++$num; ?></td>
                                                            <td style="text-align: left"> Form {{ $item->form->name }} {{ $item->stream }} - {{ $val->subject->title }} - {{ $item->teacher->user->name }} </td>
                                                            <td class="d-flex">
                                                                <div class="col-6 border-right">
                                                                    <a class="btn btn-primary p-2"  href="{{ route('class_manage1', $val->my_class->form_id) }}" ><i class="icofont-settings"></i> Manage </a>
                                                                </div>
                                                                <div class="col-6">
                                                                {{-- &nbsp;&nbsp; --}}
                                                                    <a class="btn btn-success p-2"  href="{{ route('class_list2', $val->my_class->id) }}" ><i class="icofont-list"></i> Class list </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endisset
                                                    @endforeach
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $count=0; ?>
                    @if ($types=="student" || $types == "staff" || $types == "teacher" || $types=="admin")
                        @foreach ($all_myclasses as $item)
                            @foreach ($all_forms as $form)
                                @if ($item->teacher_id ==$teacher->id && $form->teacher_id == $teacher->id)
                                   <?php ++$count; ?>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                    @if ($count>0)
                        <div class="row">
                            <div class="col-12" style="padding-left:20px;padding-right:20px;">
                                <div class="card p-2">
                                    <div class="form-group">
                                        <h2 style="font-weight: 700;text-align: left">Streams</h2>
                                        <hr>
                                        <table class="table  table-bordered table-sm">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width: 10%">*</th>
                                                    <th style="width: 50%;text-align:left">Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num=0; ?>
                                                @if ($types=="student" || $types == "staff" || $types == "teacher" || $types=="admin")
                                                    @foreach ($all_myclasses as $item)
                                                        @foreach ($all_forms as $form)

                                                            @if ($item->teacher_id ==$teacher->id && $form->teacher_id == $teacher->id && $form->id == $item->form_id)
                                                                <tr>
                                                                    <td><?php echo ++$num; ?></td>
                                                                    <td style="text-align: left"> Form {{ $item->form->name }} {{ $item->stream }}</td>
                                                                    <td class="d-flex">
                                                                        <div class="col-4 border-right">
                                                                            <a class="btn btn-primary p-2"  href="{{ route('class_subject_manage', $item->id) }}" ><i class="icofont-settings"></i> Manage </a>
                                                                        </div>
                                                                        {{-- &nbsp;&nbsp; --}}
                                                                        <div class="col-4 border-right">
                                                                            <a class="btn btn-secondary p-2"  href="/" ><i class="icofont-list"></i> Attendance </a>
                                                                        </div>
                                                                        {{-- &nbsp;&nbsp; --}}
                                                                        <div class="col-4">
                                                                            <a class="btn btn-success p-2"  href="{{ route('class_list2', $item->id) }}" ><i class="icofont-list"></i> Class list </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    @foreach ($all_myclasses as $item)
                                                        <tr>
                                                            <td>{{ ++$num }}</td>
                                                            <td style="text-align: left"> Form {{ $item->form->name }} {{ $item->stream }} </td>
                                                            <td class="d-flex">
                                                                <div class="col-4 border-right">
                                                                    <a class="btn btn-primary p-2"  href="{{ route('class_subject_manage', $item->id) }}" ><i class="icofont-settings"></i> Manage </a>
                                                                </div>
                                                                {{-- &nbsp;&nbsp; --}}
                                                                <div class="col-4 border-right">
                                                                    <a class="btn btn-secondary p-2"  href="/" ><i class="icofont-list"></i> Attendance </a>
                                                                </div>
                                                                {{-- &nbsp;&nbsp; --}}
                                                                <div class="col-4 border-right">
                                                                    <a class="btn btn-success p-2"  href="{{ route('class_list2', $item->id) }}" ><i class="icofont-list"></i> Class list </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <?php $count=0; ?>
                    @if ($types=="student" || $types == "staff" || $types == "teacher" || $types=="admin")
                        {{-- @foreach ($all_myclasses as $item) --}}
                        @foreach ($all_forms as $form)
                            @if ($form->teacher_id == $teacher->id)
                                <?php ++$count; ?>
                            @endif
                        @endforeach
                        {{-- @endforeach --}}
                    @endif
                    @if ($count>0)
                        <div class="row">
                            <div class="col-12" style="padding-left:20px;padding-right:20px;">
                                <div class="card p-2">
                                    <div class="form-group">
                                        <h2 style="font-weight: 700;text-align: left;">Classes Supervised</h2>
                                        <hr>
                                        <table class="table  table-bordered table-sm">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width: 10%">*</th>
                                                    <th style="width: 60%;text-align:left">Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $num=0; ?>
                                                @if ($types=="student" || $types == "staff" || $types == "teacher" || $types=="admin")
                                                    @foreach ($all_forms as $form)
                                                        @if ($form->teacher_id == $teacher->id)
                                                            <tr>
                                                                <td><?php echo ++$num; ?></td>
                                                                <td style="text-align: left"> Form {{ $form->name }}</td>
                                                                <td>
                                                                    <a class="btn btn-success p-2"  href="{{ route('class_list3', $form->id) }}" ><i class="icofont-list"></i> Class list </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="tab-pane fade tabpos" id="all-classes">
                    <table class="table  table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>Form</th>
                            <th>Students</th>
                            <th>Boys</th>
                            <th>Girls</th>
                            <th>Class Supervisor</th>
                            <th>Manage</th>
                            <th>Class List</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_forms as $val)
                            <tr>
                                <td>{{$val->name}}</td>
                                <td>
                                    <?php $total_students_cnt = 0; ?>
                                    @foreach($val->my_classes as $key)
                                        <?php $total_students_cnt += count($key->students) ?>
                                    @endforeach
                                    {{$total_students_cnt}}
                                </td>
                                <td></td>
                                <td></td>
                                <td >
                                    @if ($val->teacher_id != 0 && $val->teacher_id != null  && $val->teacher_id != '0')
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p style="margin: 0;">
                                                @if ($val->teacher != null)
                                                    {{$val->teacher->user->name}}</p>
                                                @endif
                                            <button class="btn" title="Delete this user" style="background:transparent;line-height: 7px;margin:0;font-size: 10px;height:auto" onclick="deleteSupervisor('{{ $val->id }}', this);">
                                                <img src="/global_assets/images/icon/delete.png" width="10" height="10"/>
                                            </button>
                                        </div>
                                    @else
                                        <select required data-placeholder="Assign" class="form-control" onchange="assignSupervisor({{ $val->id }}, this)" data-id="{{ $val->id }}">
                                            <option value="">Assign</option>
                                            @foreach($all_teachers as $value)
                                            <option value="{{$value->id}}">{{$value->user->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </td>
                                <td><a class="btn btn-primary"  href="{{ route('class_manage', $val->id) }}" ><i class="icofont-settings"></i> Manage</a></td>
                                <td><a class="btn btn-success"  href="{{ route('class_list', $val->id) }}" ><i class="icofont-list"></i>Class List</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade tabpos" id="add-class">
                    <form class="ajax-store" method="post" action="{{ route('classes.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_id" class="col-lg-3 col-form-label font-weight-semibold">Form</label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Form" class="form-control select" name="form_id" id="form_id">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Stream Name</label>
                                    <div class="col-lg-9">
                                        <input name="stream" id="stream" value="{{ old('stream') }}" required type="text" class="form-control" placeholder="Stream Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <?php  $subject_type = ''; $cnt = 0;?>
                            @foreach ($all_subjects as $subject)

                                @if($cnt == 0) <div class="col-md-4"> @endif

                                @if($subject_type != $subject->subject_type->id)<h3>{{$subject->subject_type->name}}</h3> <?php $subject_type = $subject->subject_type->id;?> @endif
                                    <input type="checkbox" id="{{$subject->subject_type->name.$subject->title}}" name="{{$subject->subject_type->name.$subject->title}}" value="{{$subject->id}}">
                                    <label for="{{$subject->subject_type->name.$subject->title}}">{{$subject->title}}</label><br>

                                    @if($cnt == 13) </div>
                                @endif
                                <?php $cnt++; if($cnt == 14) $cnt = 0; ?>

                            @endforeach

                        </div>
                        <div class="text-right">
                            <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Class List Ends--}}
    @include('partials.js.class_index')
    <script>
        $(document).ready(function()
        {
            $("tr:odd").css({
            "background-color":"#F2F2F2",
            "color":"#000"});
        });

    </script>
@endsection
