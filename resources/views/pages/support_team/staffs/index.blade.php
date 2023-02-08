@extends('layouts.master')
@section('page_title', 'Manage Classes')
@section('content')

<style>
    .active-state{
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
        table, th, td {
        border: 1px solid;
    }
</style>


    <div class="card" style="background-color: whitesmoke">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style="transform:translateX(-22px);">
                @if ($types=="student" || $types=="teacher" || $types=="staff")
                    <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">View Staff</a></li>
                @else
                    <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Staff</a></li>
                    <li class="nav-item"><a href="#new-user" class="nav-link" data-toggle="tab">Add Staff</a></li>
                    <li class="nav-item"><a href="#all-group" class="nav-link" data-toggle="tab">Staff Groups</a></li>
                @endif

            </ul>
            <div class="tab-content tabpos">
                <div class="tab-pane fade show active" id="all-classes">
                    <div class="basic">
                        <div class="p-2 d-flex flex-row" style="background-color: white">
                            <div class="w-100 pl-2" style="text-align: left"><h4>Staff</h4></div>
                            <div class="w-100"></div>
                            <div class="input-group flex-shrink-1">
                                <input class="form-control border-end-0 border rounded-pill text-right"  type="text" placeholder="search" id="example-search-input">
                                <span class="input-group-append">
                                    <button class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill ms-n3" type="button">
                                        <i class="icofont-search"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary border-start-0 border rounded-pill ms-n3 mx-2" style="background-color: #132A4E;color:white" onclick="showPrint()" type="button">
                                        <i class="icofont-printer"></i> View Print Format
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="row m-1" id="staff_card">
                            <?php $num=0; ?>
                            @foreach ($all_staffs as $key => $staff)
                                <div class="col-md-3" id="item{{ $num++ }}" aria-label="{{ str_replace(' ', '', $staff->user->name) }}">
                                    <div class="card my-2">
                                        <div class="d-flex flex-row justify-content-start m-1">
                                                @if($staff->user->user_type_id==4)
                                                    <span class='bg-success px-1'>Admin</span>
                                                @else
                                                    <br/>
                                                @endif
                                        </div>
                                        <div class="d-flex flex-column align-items-center welcome-pane">
                                            <img class="mt-3 rounded-circle" src="/{{ $staff->user->photo_by }}/{{ $staff->user->photo }}" width="120" height="120"/>
                                            <div class="person" style="transform: translateY(-20px)">
                                                <div class="d-flex flex-row">
                                                    @if(Qs::userIsTeamSA())
                                                    <div class="rounded-circle " style="border-radius: 50%;padding:10px;background-color:green;">
                                                        <a href="{{ route('staffs.edit', $staff->id) }}" class="dropdown-item p-0" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="icon-pencil" style="margin:0px;background-color:green;"></i></a>
                                                    </div>
                                                        {{-- <a id="{{ $staff->user->id }}" name={{ $staff->user->name }} onclick="confirmCreate(this.id, this.name, '{{$staff->user->user_type_id}}', 1)" class="dropdown-item" data-toggle="tooltip" data-placement="bottom" title="Add Admin">
                                                            @if ($staff->user->user_type_id==4)
                                                                <i class="icon-user-minus"></i>
                                                            @else
                                                                <i class="icon-user-plus"></i>
                                                            @endif
                                                        </a> --}}
                                                    @endif
                                                    @if(Qs::userIsSuperAdmin())
                                                        <a id="{{ $staff->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item p-0" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="icon-trash"></i></a>
                                                        <form method="post" id="item-delete-{{ $staff->id }}" action="{{ route('staffs.destroy', $staff->id) }}" class="hidden">@csrf @method('delete')</form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="my-3 text-center">
                                                <h5>{{$staff->user->name}}</h5>
                                                <h6>{{$staff->user->email}}</h6>
                                                <h6 class="text-success">{{$staff->user->phone}}</>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <span class="active-state teacher_count">{{ count($all_staffs) }}</span>
                    <div class="print active-state" style="background: white">
                        <div class="my-2 p-2">
                            <div class="w-100 pl-2" style="text-align: left"><h4>Show</h4></div>
                            <div class="d-flex justify-content-between ">
                                <div class="col-md-3">
                                    <div class="d-flex">
                                        <input type="checkbox" name="group" id="group" class="form-control" checked
                                            value="Show Groups" onclick="groupCheck()" style="width: 20px; height: 20px;">
                                        <label class="ml-2" for="group">Show Groups</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex">
                                        <input type="checkbox" name="phone" id="phone" class="form-control" checked
                                            value="Show Phone Numbers" onclick="phoneCheck()" style="width: 20px; height: 20px;">
                                        <label class="ml-2" for="phone">Show Phone Numbers</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex">
                                        <input type="checkbox" name="national" id="national" class="form-control" checked
                                            value="Show National Id No." onclick="nationCheck()" style="width: 20px; height: 20px;">
                                        <label class="ml-2" for="gnation">Show National Id No</label>
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-end">
                                    <button class="btn btn-dark p-1" ><i class="icon-printer"></i> Print</button>
                                    <button class="btn btn-dark ml-2 p-1" ><i class="icon-download"></i> Download</button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="d-flex flex-row mt-2 py-4" style="background: whitesmoke">
                            <div class="w-100" style="text-align:left">
                                <button class="btn btn-seconday" onclick="showManageTeacher()">Close Print format</button>
                            </div>
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
                        <div id="printView">
                            <div class="d-flex align-items-center justify-content-between mt-2 p-4">
                                <div>
                                    {{-- <img class="mt-3" src="{{ asset('assets/images/school.png') }}" width="100" height="100"/> --}}
                                    <img class="mt-3" src="/school_number/{{ $user->school_logo }}" width="100" height="100"/>
                                </div>
                                <div class="text-center">
                                    <h3> {{ $user->school_name }}</h3>
                                    <h6>STAFF List</h6>
                                </div>
                                <div class="text-center">
                                    <p>{{ $user->school_postal }}</p>
                                    <p>{{ $user->school_phone }}</p>
                                    <p>{{ $user->school_email }}</p>
                                </div>
                            </div>
                            {{-- <table id="staff_table" class="table table-hover table-responsive active-state"> --}}
                            <div class="d-flex align-items-center justify-content-between flex-row p-4" style="background-color: white">
                                <table id="printDatatable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th class="phone">Phone</th>
                                        <th>Personal Email</th>
                                        <th>Gender</th>
                                        <th>TSC No.</th>
                                        <th class="nation">National ID No.</th>
                                        <th class="group">Groups</th>
                                        <th class="active-state">Role</th>
                                        <th class="active-state"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $num=0; ?>
                                        @foreach ($all_staffs as $key => $staff)
                                            <tr style="line-height: 10px;">
                                                <td>{{++$num}}</td>
                                                <td>{{$staff->user->name}}</td>
                                                <td class="phone">{{$staff->user->phone}}</td>
                                                <td>{{$staff->user->email}}</td>
                                                <td>{{$staff->user->gender}}</td>
                                                <td>{{$staff->user->tsc_no}}</td>
                                                <td class="nation">{{$staff->user->national_id_no}}</td>
                                                <td class="group">
                                                    @if ($staff->group_id!="")
                                                    <?php $staffs = explode(",",$staff->group_id) ?>
                                                    @foreach ($all_group as $value)
                                                        @foreach ($staffs as $item)
                                                            @if ($item==$value->id)
                                                                <div class="row">
                                                                    <span class="px-2 py-1 my-1" style="border-radius: 2px;background:#E4E6EF">{{ $value->name }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                                </td>
                                                <td class="active-state">{{$staff->user->user_type->name}}</td>
                                                <td class="text-center active-state">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                Action &nbsp;<i class="icon-menu9"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left">
                                                                @if(Qs::userIsTeamSA())
                                                                <div class="rounded-circle ml-1" style="border-radius: 50%;padding:10px;background-color:green;">
                                                                    <a href="{{ route('staffs.edit', $staff->id) }}" class="dropdown-item p-0" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="icon-pencil" style="margin:0px;background-color:green;"></i> Edit</a>
                                                                </div>
                                                                @endif
                                                                @if(Qs::userIsSuperAdmin())
                                                                <a id="{{ $staff->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                                <form method="post" id="item-delete-{{ $staff->id }}" action="{{ route('staffs.destroy', $staff->id) }}" class="hidden">@csrf @method('delete')</form>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " style="text-align: left;" id="new-user">
                    <div class="card p-2">
                        <h3>Options</h3>

                        <div class="row">
                            <div class="col-md-6">
                              <input type="radio" id="staff_by_key" name="staff_member" value="key" checked>
                              <label for="staff_by_key">Key in Staff member details</label>
                            </div>
                            <div class="col-md-6">
                              <input type="radio" id="staff_by_file" name="staff_member" value="key">
                              <label for="staff_by_file">Upload Staff members from a spreadsheet</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('staffs.store') }}">
                                @csrf
                                {{-- <h6>staff Data</h6> --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input value="{{ old('full_name') }}" required type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input value="{{ old('email') }}" required type="text" name="email" id="email" placeholder="Email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input value="{{ old('phone_number') }}" class="form-control" placeholder="07## ### ###" name="phone_number" id="phone_number" type="text" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="gender">Gender</label>
                                        <select class="select form-control" id="gender" name="gender" data-fouc data-placeholder="Choose..">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tsc_no">TSC No.</label>
                                            <input value="{{ old('tsc_no') }}" required type="text" name="tsc_no" id="tsc_no" placeholder="####" class="form-control">
                                        </div>
                                    </div>

                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="national_id_no">National ID No.</label>
                                            <input value="{{ old('national_id_no') }}" required type="text" name="national_id_no" id="national_id_no" placeholder="####" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="group">Group</label>
                                            <select class="select form-control" multiple id="group" name="group[]" data-fouc data-placeholder="Choose..">
                                                @foreach ($group as $key => $g)
                                                <option value="{{$g->id}}">{{$g->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="all-group">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-primary">Name</th>
                            <th class="d-flex justify-content-center text-danger">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $len = count($all_group); $i = 0; ?>
                            @foreach ($all_group as $key => $group)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <p style="margin: 0;">{{$group->name}}</p>
                                            <button class="btn btn-primary" title="Delete this user" onclick="editingGroupName('{{$group->name}}', this);">
                                                <img src="/global_assets/images/icon/edit.png" width="20" height="20"/> &nbsp; Edit
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <button class="list-icons-item btn btn-danger" onclick="deleteGroup('{{$group->id}}', this);" style="cursor: pointer; ">
                                                    <img src="/global_assets/images/icon/delete.png" width="20" height="20"/>&nbsp; Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="display: none; ">{{$group->id}}</td>
                                    {{-- {{ $group->id }} --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#myModal" >Add Group</button>
                </div>
            </div>
        </div>
    </div>

    <!-- create new group modal starts -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #5dd1bb; color: black;">
                    <h5>Creat New Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('new_group')}}">
                    <div class="modal-body">
                        <div class="form-group d-flex flex-column align-items-center">
                            <label for="group_name">Group Name </label>
                            <input type="text" name="group_name" id="group_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-theme">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- create new group modal ends -->
    @include('partials.js.class_index')
    @include('partials.js.group_index')

    <script>

    let staff_table = document.querySelector('#staff_table');
    let staff_card = document.querySelector('#staff_card');
    let clickme = document.querySelector('#clickme');
    clickme.addEventListener('click', (e) => {
        e.preventDefault();

        if((' ' + staff_card.className + ' ').indexOf('active-state')>0){
            staff_card.classList.remove("active-state");
            staff_table.classList.add("active-state");
            console.log('card', staff_card.className);
            clickme.innerHTML = '<i class="icon-printer"></i> View Print Format';
            clickme.classList.remove('bg-secondary');
            clickme.classList.add('bg-primary');
        }else{
            staff_card.classList.add("active-state");
            staff_table.classList.remove("active-state");
            console.log('table', staff_card.className);
            clickme.innerText = "Close Print Format"
            clickme.classList.remove('bg-primary')
            clickme.classList.add('bg-secondary');
        }

    });


    </script>
@endsection
