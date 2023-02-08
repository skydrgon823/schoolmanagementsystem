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

        <div class="card-header header-elements-inline">
            <h1 class="card-title"></h1>
            <h1 class="card-title">Class List</h1>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classes">
                    <table class="table  table-bordered table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>ADMNO</th>
                            <th>NAME</th>
                            <th>STREAM</th>
                            <th>KCPE</th>
                            <th>CONTACTS</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($class_list as $val)
                                @foreach ($val->students as $k => $key)
                                    <tr>
                                        <td>{{$k + 1}}</td>
                                        <td><a href="{{route('students.show', $key->id )}}"> {{$key->adm_no}} </a></td>
                                        <td><a href="{{route('students.show', $key->id )}}"> {{$key->user->name}} </a></td>
                                        <td>{{$key->my_class->stream}}</td>
                                        <td>{{$key->kcpe}}</td>
                                        <td>not yet</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
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
