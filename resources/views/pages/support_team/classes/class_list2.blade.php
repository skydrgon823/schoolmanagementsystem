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
    }
    td>a{
        font-size:0.925rem;
        line-height: 1.35px;
    }
    /* tbody td{
        padding: 30px;
        } */
    tbody tr:nth-child(odd){
        background-color: white;
        color: #000;
    }
    /* tbody {
            font-size: 10px !important;

        } */
    .active-state {
        display: none;
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
    <div class="card" style="background: whitesmoke">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style="transform:translateX(-22px);">
                <li class="nav-item"><a href="#" class="nav-link active" data-toggle="tab">Class Lists</a></li>
            </ul>
            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="all-classes">
                    <div class="row" style="background: white">
                        <div class="col-md-12 px-5 pt-3">
                            <div class="d-flex">
                                <div class="align-items-start col-md-12" style="text-align: left"><h3>Class List</h3></div>
                                <div class="align-items-end mr-4 pr-4" style="float: right"><span onclick="checkClassType();"><i class="icofont-caret-down"></i></span></div>
                            </div>
                        </div>
                        <div class="row col-md-12 active-state" id="classType" style="text-align: left">
                            <div class="col-md-12"><hr style="background: black"></div>
                            <div class="col-md-4 px-5">
                                <h5 class="ml-2">Form</h5>
                                <div class="col-md-12">
                                    <select class="select form-control" id="form" name="form" data-fouc data-placeholder="Choose..">
                                        <option value="">Select Form..</option>
                                        @foreach($all_forms as $value)
                                            <option value="{{$value->id}}" @if ($class_list->form->id == $value->id)
                                                selected
                                            @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 px-5">
                                <h5 class="ml-2">Stream</h5>
                                <div class="col-md-12">
                                    <select class="select form-control" id="stream" name="stream" data-fouc data-placeholder="Choose..">
                                        <option value="">Select Stream..</option>
                                        @foreach($all_streams as $value)
                                            <option value="{{$value->stream}}" @if ($class_list->stream == $value->stream)
                                                selected
                                            @endif>{{$value->stream}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 px-5">
                                <h5 class="ml-2">Subject</h5>
                                <div class="col-md-12">
                                    <select class="select form-control" id="stream" name="stream" data-fouc data-placeholder="Choose..">
                                        <option value="">Select Stream..</option>
                                        @foreach($all_subjects as $value)
                                            <option value="{{$value->id}}" >{{$value->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 my-3">
                                <div class="d-flex pr-5" style="float: right">
                                    <a href="/class_list2/{{ $class_list->id}}" onclick="checkClassType()" class="btn btn-success">Get Class List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="background: white">
                        <div class="col-md-12 px-5 pt-3">
                            <div class="d-flex">
                                <div class="align-items-start col-md-12" style="text-align: left"><h3>Options</h3></div>
                                <div class="align-items-end mr-4 pr-4" style="float: right"><span onclick="checkListType();"><i class="icofont-caret-down"></i></span></div>
                            </div>
                        </div>


                        <div class="row col-md-12" id="listType" style="text-align: left">
                            <div class="col-md-12"><hr style="background: black"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-10 p-3">
                                <h4>List Type</h4>
                                <div class="form-check text-center form-check-inline">
                                    <input class="form-check-input" type="radio" name="class_radio" id="basic" onclick="showRadio(this)" value="Basic" checked/>
                                    <label class="form-check-label" for="basic">Basic</label>
                                </div>

                                <div class="form-check text-center form-check-inline">
                                    <input class="form-check-input" type="radio" name="class_radio" onclick="showRadio(this)" id="custom" value="Custom" />
                                    <label class="form-check-label" for="custom">Custom</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <p id="detail" class="text-right active-state">Select items you'd like to appear on the classlist</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row mt-2 py-4 justify-content-end" style="background: whitesmoke">
                        <div class="flex-shrink-1">
                            <button class="btn btn-primary" onclick="fnPrintReport(event)"><i class="icofont-printer"></i> Print </button>

                        </div>
                        <div class="flex-shrink-1 ml-2">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                  Dropdown
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" id="btnExport" onclick="fnExcelReport();">Download Excel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="printView" style="background: white">
                        <div class="d-flex col-md-12 text-center">
                            <div class="col-md-4 text-left">
                                {{-- <img class="mt-3" src="{{ asset('assets/images/school.png') }}" width="100" height="100"/> --}}
                                <img class="mt-3"  src="/school_number/{{ $user->school_logo }}" width="100" height="100"/>
                            </div>
                            <div class="col-md-4" style="margin: auto 0">
                                <h3>{{ $user->school_name }}</h3>
                                <h4>Class List</h4>
                            </div>
                            <div class="col-md-4 text-right" style="margin: auto 0">
                                <div class="flex-colmun">
                                    <div class="">
                                        {{ $user->school_postal }}
                                    </div>
                                    <div class="">
                                        {{ $user->school_phone }}
                                    </div>
                                    <div class="">
                                        {{ $user->school_email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table  table-bordered table-sm mt-3">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Form {{ $class_list->form->name }} {{  $class_list->stream }} - {{ substr($class_list->created_at, 0, 4) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="7">
                                        Class Teacher: @if ($class_list->teacher_id != null)
                                        {{ $class_list->teacher->user->name }}
                                    @endif
                                    </th>
                                </tr>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Image</th>
                                <th>ADMNO</th>
                                <th>NAME</th>
                                <th class="d-none">STREAM</th>
                                <th>KCPE</th>
                                <th class="d-none">CONTACTS</th>
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach ($class_list->students as $k => $key)
                                    {{-- {{ $key->user->name }} --}}
                                        <tr>
                                            <td>{{$k + 1}}</td>
                                            <td><img src="/{{ $key->user->photo_by }}/{{ $key->user->photo }}" alt="" width="20" height="20"></td>
                                            <td><a href="{{route('students.show', $key->id )}}"> {{$key->adm_no}} </a></td>
                                            <td><a href="{{route('students.show', $key->id )}}"> {{$key->user->name}} </a></td>
                                            <td  class="d-none">{{$key->my_class->stream}}</td>
                                            <td>{{$key->kcpe}}</td>
                                            <td  class="d-none">not yet</td>
                                        </tr>
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
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
