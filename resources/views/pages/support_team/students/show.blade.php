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
    <div class="card" style="background: #e8ebf3;">


            <ul class="nav nav-tabs nav-tabs-highlight cardpos">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Student Profile</a></li>
            </ul>

            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="all-classes">
                    <div class="row justify-content-center">
                        <div class="col-md-8 p-3"  style="background: white; border-radius: 10px;">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="row  align-items-center">

                                        <img class="mx-3" src="/{{$this_user->user->photo_by}}/{{$this_user->user->photo}}" width="70" height="70"/>
                                        <div>
                                            <h2>{{$this_user->user->name}}</h2>
                                            <p>
                                                {{$this_user->adm_no}}, &nbsp;
                                                {{$this_user->my_class->form->name}} &nbsp;
                                                {{$this_user->my_class->stream}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info m-1">Analytics</button>
                                    <button class="btn btn-info m-1">Messages</button>
                                    <button class="btn btn-info m-1">Notes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <h3>Student Profile</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 p-3"  style="background: white; border-radius: 10px;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Adminssion Number</label>
                                        <input class="form-control" type="number" value="{{$this_user->adm_no}}" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">UPI</label>
                                        <input class="form-control" type="text" value="{{$this_user->upi}}" id="upi" name="upi"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="adm_no">Index Number</label>
                                        <input class="form-control" type="number" value="{{$this_user->id}}" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Name</label>
                                        <input class="form-control" type="number" value="{{$this_user->user->name}}" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">Date of Admission</label>
                                        <input class="form-control" type="date" value="" id="upi" name="upi"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Date of Birth</label>
                                        <input class="form-control" type="date" value="" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">Birth Certificate Number</label>
                                        <input class="form-control" type="number" value=""  id="upi" name="upi"/>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Primary School Name</label>
                                        <input class="form-control" type="text" value="" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">KCPE Index</label>
                                        <input class="form-control" type="number" value=""  id="upi" name="upi"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">KCPE Score</label>
                                        <input class="form-control" type="number" value="" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">KCPE Year</label>
                                        <input class="form-control" type="number" value=""  id="upi" name="upi"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Guardian Name</label>
                                        <input class="form-control" type="text" value="" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">Primary Guardian Phone</label>
                                        <input class="form-control" type="text" value=""  id="upi" name="upi"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">Secondary Guardian Phone</label>
                                        <input class="form-control" type="text" value=""  id="upi" name="upi"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Guardian Email</label>
                                        <input class="form-control" type="text" value="" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">Guardian Relation to Student</label>
                                        <input class="form-control" type="text" value=""  id="upi" name="upi"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">Home Address</label>
                                        <input class="form-control" type="text" value="" id="adm_no" name="adm_no" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upi">Gender</label>
                                        <select required data-placeholder="Select Gender" class="form-control select" name="form_id" id="form_id">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adm_no">House</label>
                                        <select required data-placeholder="Select Gender" class="form-control select" name="form_id" id="form_id">
                                            <option value="">Please Select Home</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="upi">General Comments</label>
                                        <textarea class="form-control" id="w3review114" name="w3review114" rows="4" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="upi">Photo</label>
                                        <input class="form-control" type="file" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-danger">Delete Student</button>
                                        <button type="button" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

    </div>
@endsection
