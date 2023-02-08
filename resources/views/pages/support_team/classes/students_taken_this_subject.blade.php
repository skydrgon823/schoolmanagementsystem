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
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Classes</a></li>
            </ul>

            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="all-classes">
                    <form method="POST" action="delete_selected_subject">
                        @csrf @method('delete')
                        <input type="hidden" name="subject" id="subject" value={{ $subject }}>
                        <table class="table datatable-button-html5-columns table-bordered table-sm">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>
                                    <input type="checkbox" name="students"  id="students" onclick="selectAll()">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $key => $val)
                                    <tr class="student_list">
                                        {{-- {{ $val->student }} - {{$val->student_id}} --}}
                                        @if (is_object($val->student) && $val->student !==null)
                                            <td><a href="{{route('students.show', $val->student_id )}}"> {{$key + 1}} </a></td>
                                            <td><a href="{{route('students.show', $val->student_id )}}"> {{$val->id}} </a></td>
                                            <td><a href="{{route('students.show', $val->student_id )}}"> {{$val->student->user->name}} </a></td>
                                            <td>
                                                <input type="checkbox" class="chk_boxes1" name="students[{{ $val->student_id }}]" value="{{ $val->student_id }}" id="{{ $val->student_id }}">
                                            </td>
                                        @endif

                                    </tr>
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
