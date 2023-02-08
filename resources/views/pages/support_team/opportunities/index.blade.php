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
            <ul class="nav nav-tabs nav-tabs-highlight" style=" transform:translateX(-22px);">
                <li class="nav-item"><a href="#vacancies" class="nav-link active" data-toggle="tab">Vacancies</a></li>
                <li class="nav-item"><a href="#swap" class="nav-link" data-toggle="tab">Swap</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="vacancies">
                    <div class="row justify-content-between">
                        <div class="form-group">
                            <select required data-placeholder="Teaching Staff" class="form-control" id="teaching-staff" name="teaching-staff">
                                <option value=""></option>
                                <option value="1">Teaching Staff</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">+ Add</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search Title/Subject">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="icon-search4"></i>Search</span>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>TITLE</th>
                                    <th>SUBJECT COMBINATION</th>
                                    <th>SCHOOL</th>
                                    <th>POSTED BY</th>
                                    <th>DATE POSTED</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>MAT/BST</td>
                                    <td>Mathematices/Business Studies</td>
                                    <td>
                                        <h5>KHALFA BIN JASIM HIGH SCHOOL</h5>
                                        Isinya., Kajiado
                                    </td>
                                    <td>
                                        <h5>Mr. Musa</h5>
                                        0728572929,0724095784
                                    </td>
                                    <td>Aug 11, 2022</td>
                                    <td>
                                        <button class="btn btn-seconday px-3"><i class="icon-eye"></i>View</a></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="swap">

                </div>

            </div>
        </div>
    </div>

    @include('partials.js.class_index')
    @include('partials.js.group_index')
@endsection
