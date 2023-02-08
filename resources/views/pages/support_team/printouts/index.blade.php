@extends('layouts.master')
@section('page_title', 'Manage Classes')
@section('content')

<style>
    .active-state{

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
</style>


    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight" style=" transform:translateX(-22px);">
                <li class="nav-item"><a href="#class-lists" class="nav-link active" data-toggle="tab">Class Lists</a></li>
                <li class="nav-item"><a href="#analysis-report" class="nav-link" data-toggle="tab">Analysis Report</a></li>
                <li class="nav-item"><a href="#report-forms" class="nav-link" data-toggle="tab">Report Forms</a></li>
                <li class="nav-item"><a href="#merit-lists" class="nav-link" data-toggle="tab">Merit Lists</a></li>
                <li class="nav-item"><a href="#transcripts" class="nav-link" data-toggle="tab">Transcripts</a></li>
                <li class="nav-item"><a href="#leaving-certificates" class="nav-link" data-toggle="tab">Leaving Certificates</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="class-lists">
                    <h3>Class List</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select-form">Form</label>
                                <select name="select-form" id="select-form" class="form-control" data-placeholder="Select Form">
                                    <option value=""></option>
                                    <option value="1">Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select-form">Stream</label>
                                <select name="select-stream" id="select-stream" class="form-control" data-placeholder="Select Stream(Optional)">
                                    <option value=""></option>
                                    <option value="1">Test</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="select-subject">Subject</label>
                                <select name="select-subject" id="select-subject" class="form-control" data-placeholder="Select Subject(Optional)">
                                    <option value=""></option>
                                    <option value="1">Test</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="analysis-report">

                </div>


                <div class="tab-pane fade" id="report-forms">

                </div>
                <div class="tab-pane fade" id="merit-lists">
                    <div class="row">
                        <div class="col-12">
                            <h4>Merit List</h4>
                            <br>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-end">
                                <button class="btn btn-primary mr-1">
                                    Print Format
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <span class="caret"></span>Download</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Download 1</a></li>
                                        <li><a href="#">Download 2</a></li>
                                        <li><a href="#">Download 3</a></li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-sm w-auto" style="font-size: 12px;">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>ADMNO</th>
                                    <th>Name</th>
                                    <th>STR</th>
                                    <th>ENG</th>
                                    <th>KIS</th>
                                    <th>MAT</th>
                                    <th>BIO</th>
                                    <th>PHY</th>
                                    <th>CHE</th>
                                    <th>HIS</th>
                                    <th>GEO</th>
                                    <th>CRE</th>
                                    <th>AGR</th>
                                    <th>COM</th>
                                    <th>BST</th>
                                    <th>SBJ</th>
                                    <th>KCPE</th>
                                    <th>VAP</th>
                                    <th>MN<br>MKS</th>
                                    <th>DEV</th>
                                    <th>GR</th>
                                </tr>
                                </thead>
                                <tbody id="printouts-table-merit">
                                    <tr>
                                        <td>1</td>
                                        <td>1138</td>
                                        <td>William Muigai</td>
                                        <td>East</td>
                                        <td>52 C</td>
                                        <td>38 D</td>
                                        <td>22 E</td>
                                        <td>46 C-</td>
                                        <td>59 C+</td>
                                        <td>50 C-</td>
                                        <td>61 B-</td>
                                        <td>40 D</td>
                                        <td>66 B</td>
                                        <td>38 D</td>
                                        <td>26 E</td>
                                        <td>52 C</td>
                                        <td>12</td>
                                        <td>347</td>
                                        <td>-23.57</td>
                                        <td>45.83</td>
                                        <td>-8.8</td>
                                        <td>C-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="transcripts">

                </div>
                <div class="tab-pane fade" id="leaving-certificates">

                </div>
            </div>
        </div>
    </div>

    @include('partials.js.class_index')
    @include('partials.js.group_index')
@endsection
