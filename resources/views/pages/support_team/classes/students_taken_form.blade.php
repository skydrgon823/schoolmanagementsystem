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
        .student_list a {
            color: black;
        }
        tbody tr:nth-child(odd){
        background-color: white;
        color: #000;
    }
    tbody {
            font-size: 10px !important;

        }
    </style>
    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Classes</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classes">
                    <form method="POST" action="delete_selected_student">
                        @csrf @method('delete')
                        <input type="hidden" name="formId" id="formId" value={{ $form_id }}>
                        <table class="table   table-bordered table-sm">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>ADMNO</th>
                                <th>NAME</th>
                                <th>
                                    <input type="checkbox" name="students"  id="students" onclick="selectAll()">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($class_list1 as $val)
                                    @foreach ($val->students as $k => $key)
                                        <tr>
                                            <td>{{$k + 1}}</td>
                                            <td><a class="btn"  href="{{route('students.show', $key->id )}}"> {{$key->adm_no}} </a></td>
                                            <td><a class="btn"  href="{{route('students.show', $key->id )}}"> {{$key->user->name}} </a></td>
                                            <td class="d-none">{{$key->my_class->stream}}</td>
                                            <td class="d-none">{{$key->kcpe}}</td>
                                            <td class="d-none">not yet</td>
                                            <td>
                                                {{-- <input type="checkbox" name="students[{{ $key->user->id }}]" value="{{ $key->user->id }}" id="{{ $key->user->id }}"> --}}
                                                <input type="checkbox" class="chk_boxes1" name="students[{{ $key->id }}]" value="{{ $key->id }}" id="{{ $key->id }}">
                                                {{-- <input type="text" name="studentval{{ $key->id }}" value="{{ $key->id }}"/> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between" style="margin-top: 20px;">
                            {{-- <button class="btn btn-primary"  onclick="{{ url('/classes') }}">Back</button> --}}
                            <a class="btn btn-info" href="/classes" >Back </a>
                            <button class="btn btn-danger"  type="submit">Remove Selected Students</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
         $(document).ready(function()
        {
            $("tr:odd").css({
                "background-color":"#F2F2F2",
                "color":"#000"});
        });
        var chk_students = document.querySelector('.chk_boxes1');
        function selectAll(){
            if ($('.chk_boxes1:checked').length == $('.chk_boxes1').length) {
                $('.chk_boxes1').prop('checked', false);
            }
            else {
                $('.chk_boxes1').prop('checked', true);
            }
        }

    </script>
@endsection
