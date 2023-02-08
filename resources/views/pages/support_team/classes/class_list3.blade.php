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
    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style="transform:translateX(-22px);">
                <li class="nav-item"><a href="#" class="nav-link active" data-toggle="tab">Class Lists</a></li>
            </ul>
            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="all-classes">
                    <div class="row">
                        <div class="col-md-12 p-3 ">
                            <h3>Options</h3>
                            <hr style="background: black">
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6 p-3">
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
                        <div class="col-md-7">
                            <p id="detail" class="text-right active-state">Select items you'd like to appear on the classlist</p>
                        </div>
                    </div>
                    <div class="col-md-12 text-right m-3 p-3" style="background-color: whitesmoke">
                        <a href="#" class="btn btn-primary" id="detail-print"><i class="icofont-printer"></i> Print</a>
                            <div class="btn btn-primary dropdown">
                                <a
                                  class="dropdown-toggle text-white"
                                  href="#"
                                  id="dropdown04"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                <i class="icofont-download"></i>
                                  Download Class List</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown04">
                                  <li>
                                    <a class="dropdown-item" href="#">
                                      Download Excel</a
                                    >
                                  </li>
                                </ul>
                            </div>
                    </div>
                    <div id="detail-content">
                        <div class="d-flex col-md-12 text-center">
                            <div class="col-md-4 text-left">
                                <img class="mt-3" src="{{ asset('assets/images/school.png') }}" width="100" height="100"/>
                            </div>
                            <div class="col-md-4" style="margin: auto 0">
                                <h3>BIBIRIONI HIGH SCHOOL - LIMURU</h3>
                                <h4>Class List</h4>
                            </div>
                            <div class="col-md-4 text-right" style="margin: auto 0">
                                <div class="flex-colmun">
                                    <div class="">
                                        553Limuru
                                    </div>
                                    <div class="">
                                        00
                                    </div>
                                    <div class="">
                                       {{ $form->teacher->user->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table  table-bordered table-sm mt-3">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Form {{ $form->name }} - {{ substr($form->updated_at, 0, 4) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="7">
                                        Class Supervisor Teacher: {{ $form->teacher->user->name }}
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
                                    @foreach ($class_list as $item)

                                        @foreach ($item->students as $k => $key)
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
