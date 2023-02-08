@extends('layouts.master')
@section('page_title', 'User Profile - '.$user->name)
@section('content')
<style>
.card{
    margin-top:50px;
    overflow:hidden;
}
.cardpos{
        position:fixed;width:100%;z-index:10;
    }
.tabpos{
    margin-top: 30px;
}
.active-state{
    display: none;
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

    <div class="card-body" style="background: whitesmoke">
        <ul class="nav nav-tabs nav-tabs-highlight cardpos" style=" transform:translateX(-40px);">
            <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">Update Profile</a></li>
        </ul>

        <div class="tab-content tabpos">
            <div class="tab-pane fade show active" id="new-user">
                @if($errors->any())
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                        @foreach($errors->all() as $er)
                            <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                        @endforeach

                </div>
            @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('users.update', Qs::hash($user->id)) }}">
                @csrf @method('PUT')
                <div class="row py-3" style="background: whitesmoke" style="transform:translateX(-40px);">
                    <div class="col-md-4 mr-3" style="margin-left: -20px;">
                        <div class="row">
                            <div class="card col-md-12 mt-2 ml-2" style="heigth:100%;">
                                <div class="d-flex flex-column align-items-center welcome-pane" style="height:450px;">
                                    <img class="mt-5 rounded-circle"  id="imgPhoto" src="/{{ $user->photo_by }}/{{ $user->photo }}" width="150" height="150"/>
                                    <div class="d-flex" style="margin-top: -20px;margin-right:-40px;">
                                        {{-- <a id="{{ $user->id }}" onclick="imagePhotoDelete(event)" href="#" class="btn-danger active-state" id="delete_photo"><div style="background-color: red;padding:2px;border-radius:3px;"><i class="icon-trash" style="color: white"></i></div></a>
                                        <form method="post" id="item-delete-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" class="hidden">@csrf @method('delete')</form> --}}
                                    </div>
                                    <div class="d-flex flex-row mt-4">
                                        {{-- <button class="btn btn-primary active-state" onclick="changeImage(event)" id="change_image">Change Image</button> --}}
                                        <input  accept="image/*" type="file" name="photo" id="photo" class="form-input-styled" data-fouc>

                                        {{-- <input id="file-input" type="file" name="name" style="display: none;" /> --}}
                                    </div>
                                    <div class="mt-3 text-center">
                                        <h5>{{$user->name}}</h5>
                                    </div>


                                </div>
                                <div class="d-flex flex-column ml-3 my-3">
                                    <div class="d-flex flex-row">
                                        USERNAME:
                                    </div>
                                    <div class="d-flex flex-row">
                                        <h6 class="text-success">{{ $user->email }}</>
                                    </div>
                                    <div class="row">
                                        Signature
                                    </div>
                                    <img class="mt-1"  id="imgSign" src="/sign_number/{{ $user->sign }}" style="border: 1px solid black" width="250" height="80"/>
                                </div>
                                <div class="text-center  active-state" style="margin-top: -2rem;margin-right:-2rem;" id="delete_sign">
                                    {{-- @if(Qs::userIsSuperAdmin()) --}}
                                        <a onclick="imageSignDelete()" href="#" style="cursor: pointer;"  class="btn-danger p-1" style="border-radius: 3px;"><i class="icon-trash" style="color: white"></i></a>
                                        {{-- <form method="post" id="item-delete-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" class="hidden">@csrf @method('delete')</form> --}}
                                    {{-- @endif --}}
                                </div>
                                <div class="d-flex flex-row m-2">
                                    {{-- <button class="btn btn-primary active-state" onclick="changeSignature()" id="change_signature">Change Signature</button> --}}
                                    <input  accept="image/*" type="file" name="sign" id="sign" class="form-input-styled" data-fouc>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 m-0" style="text-align: left; transform:translateY(-40px)">
                        {{-- <span>{{ $message }}</span> --}}
                        <div class="row">
                            <div class="card col-12 px-4">
                                <h4 class="mt-3"><strong> User Profile</strong></h4>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input value="{{ $user->name }}" required type="text" name="name" id="name" placeholder="Full Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label for="email">Email</label>
                                            <input value="{{ $teacher->user->email }}" required type="text" name="email" id="email" placeholder="Email" class="form-control">
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input value="{{ $user->phone }}" class="form-control" placeholder="07## ### ###" name="phone" id="phone" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">

                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input value="{{ $teacher->user->phone }}" class="form-control" placeholder="07## ### ###" name="phone_number" id="phone_number" type="text" >
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="email">Personal Email</label>
                                            <input value="{{ $user->email }}" type="text" name="email" id="email" placeholder="####" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gender">Gender</label>
                                        <select class="select form-control" id="gender" name="gender" data-fouc data-placeholder="Choose..">
                                            <option value="male" @if($user->gender == 'male') selected @endif >Male</option>
                                            <option value="female" @if($user->gender == 'female') selected @endif >Female</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input value="{{ $teacher->user->phone }}" class="form-control" placeholder="07## ### ###" name="phone_number" id="phone_number" type="text" >
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="tsc_no">TSC No.</label>
                                            <input value="{{ $user->tsc_no }}" type="text" name="tsc_no" id="tsc_no" placeholder="####" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nal_id">ID Number</label>
                                            <input value="{{ $user->nal_id }}" type="text" name="nal_id" id="nal_id" placeholder="####" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bio">Bio</label>
                                            <textarea class="form-control">bio</textarea>
                                        </div>
                                    </div>
    {{--
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="group">Group</label>
                                            <select class="select form-control" id="group" name="group" data-fouc data-placeholder="Choose..">
                                                @foreach ($group as $key => $g)
                                                <option value="{{$g->id}}"  @if($teacher->group_id == $g->id) selected @endif  >{{$g->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="text-right mt-3 mb-4">
                                    <button class="btn btn-primary" onclick="showTwoButtonImage(event)" id="edit_button">
                                    <i class="icofont-pencil"></i> Edit
                                    </button>
                                    {{-- <a class="btn btn-warning active-state" id="cancel_button" href="{{ route('users.index') }}"><i class="icon-trash">Cancel </i></a> --}}
                                    <button class="btn btn-warning active-state" id="cancel_button" onclick="hideTwoButtonImage(event)"><i class="icon-trash">Cancel </i></button>
                                    <button type="submit" class="btn btn-primary active-state" id="save_button">Save <i class="icon-paperplane ml-2"></i></button>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>

        </div>
    </div>
</div>

    {{--User Profile Ends--}}
    @include('partials.js.user_index')
@endsection
