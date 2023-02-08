@extends('layouts.master')
@section('page_title', 'Test Excel')
@section('content')

    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Classes</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classes">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>Form</th>
                            <th>Students</th>
                            <th>Class Supervisor</th>
                            <th>Manage</th>
                            <th>Class List</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--Class List Ends--}}
    @include('partials.js.class_index')
@endsection
