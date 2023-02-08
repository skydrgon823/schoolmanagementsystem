@extends('layouts.master')
@section('page_title', 'Manage Exams')
@section('content')

<style>
    ul {
        list-style-type: none;
    }
    .forms_sitting_exam {
        margin: 1rem;
        padding: 0;
    }
    .one-sitting {
        border-top: 1px solid #00000042;
        border-bottom: 1px solid #00000042;
    }
    .one-sitting.odd {
        background: rgb(227 225 225 / 50%);
    }
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
            width:190px;
        }
    .cardpos>li>a{
        text-align: center;
        padding:5px 10px;
    }
    .ratio{
        text-align: left;
    }
    .ratio>tbody>tr>td{
            font-family: Open Sans,Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 1rem;
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            padding:0.1rem 0.5rem !important;
        }
    /* #ajax-alert{
        display: none !important;
    } */
</style>
    <div class="card" style="background: whitesmoke">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight cardpos" style=" transform:translateX(-22px);">
                @if ($types=="student" || $types=="teacher" || $types=="staff")
                    <li class="nav-item"><a href="#my_classes_pane" class="nav-link" data-toggle="tab"  onclick="selectExam()"><i class="icofont-home"></i> My Classes</a></li>
                @else
                    <li class="nav-item"><a href="#my_classes_pane" class="nav-link active" data-toggle="tab"  onclick="selectExam()"><i class="icofont-home"></i> My Classes</a></li>
                    <li class="nav-item"><a href="#all_exams_pane" class="nav-link" data-toggle="tab" onclick="getInitExam()" ><i class="icofont-gears"></i> Manage Exams</a></li>
                    <li class="nav-item"><a href="#new_exam_pane" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create Exam</a></li>
                    <li class="nav-item"><a href="#grading_systems_pane" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Grading Systems</a></li>
                    <li class="nav-item"><a href="#subject_paper_ratios" class="nav-link" data-toggle="tab"><i class="icofont-network"></i> Subject Paper Ratios</a></li>
                    <li class="nav-item"><a href="#student-residences" class="nav-link" data-toggle="tab"><i class="icofont-trash"></i> Deleted Exams</a></li>
                @endif

                {{-- <li class="nav-item dropdown">

                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">More</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#student-residences" class="dropdown-item" data-toggle="tab">Deleted Exams</a>
                    </div>
                </li> --}}
            </ul>

            <div class="tab-content tabpos">
                <div class="tab-pane fade  show active" id="my_classes_pane" style="text-align: left;padding:15px;background:white">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="exam_class">Exam</label>
                                <select class="select form-control" id="exam_class_select" name="exam_class_select" onchange="selectExam();" data-fouc data-placeholder="Select ....">
                                        <option value=""></option>
                                        {{-- <option value="0">All</option> --}}
                                        @for ($i = 1; $i < 4; $i++)
                                            <optgroup label="Term{{ $i }}">
                                                @foreach ($exams as $exam)
                                                    @if ($exam->term == $i)
                                                        <option value={{ $exam->id }} @if ($exam->id == $last)
                                                            selected
                                                        @endif>{{ $exam->name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endfor
                                    {{-- @foreach ($teachers as $teacher)
                                        <option value={{ $teacher->id }}>{{ $teacher->user->name }}</option>
                                    @endforeach --}}

                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label>Subject Classes</label>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class="d-none">ClassSubjectID</th>
                                        <th class="d-none">ExamID</th>
                                        <th class="d-none">TeacherID</th>
                                        <th class="d-none">SubjectID</th>
                                        {{-- af-subject --}}
                                    </tr>
                                    </thead>
                                    <tbody id="exam_class_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mt-3 d-none">
                            <div class="form-group">
                                <label onclick="showStream(this);" class="text-success">Show Streams</label>
                                <table class="table table-bordered table-stream active-state">
                                    <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class="d-none">ExamID</th>
                                        <th class="d-none">TeacherID</th>
                                    </tr>
                                    </thead>
                                    <tbody id="exam_class_tbody_stream">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="all_exams_pane" style="padding:15px;background:white">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="exam_class">Academic Year</label>
                                <select class="select form-control" id="exam_manage_academic" name="exam_manage_academic" data-fouc data-placeholder="Select Year...." onchange="selectYear();">
                                    <option value=""></option>
                                    <option value="1">All</option>
                                    <option value={{ date("Y"); }}>{{ date("Y"); }}</option>
                                    <option value{{ date("Y") -1 }}>{{ date("Y") -1 }}</option>
                                    <option value={{ date("Y") -2 }}>{{ date("Y") -2 }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <table class="table datatable-button-html5-columns table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th class="d-none">#</th>
                            <th class="d-none">Type</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Status</th>
                            <th class="d-none">Term</th>
                            <th class="d-none">Year</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="exam_index_tbody">

                        </tbody>
                    </table> --}}
                    <div id="exam_index_body">

                    </div>
                </div>

                <div class="tab-pane fade" id="new_exam_pane" style="padding:15px;background:white">
                    <div class="exam_type_pane" style="text-align: left">
                        <h6 id="search_title">Exam Type</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <input type="radio" name="exam_type" id="Ordinary_Exam" class="form-control" checked
                                                value="Ordinary_Exam" style="width: 20px; height: 20px;">
                                            <label class="ml-2" for="Ordinary_Exam">Ordinary Exam</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <input type="radio" name="exam_type" id="Consolidated_Exam" class="form-control"
                                                value="Consolidated_Exam"  style="width: 20px; height: 20px;">
                                            <label class="ml-2" for="Consolidated_Exam">Consolidated Exam</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <input type="radio" name="exam_type" id="Year_Average" class="form-control"
                                                value="Year_Average" style="width: 20px; height: 20px;">
                                            <label class="ml-2" for="Year_Average">Year Average</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <input type="radio" name="exam_type" id="KCSE" class="form-control"
                                                value="KCSE" style="width: 20px; height: 20px;">
                                            <label class="ml-2" for="KCSE">KCSE</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ordinary_body">
                            <form id="create_exam_form" method="post" action="{{ route('exams.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="form-group">
                                            <label for="exam_name">Exam Name</label>
                                            <input class="form-control" type="text" id="exam_name" name="exam_name" oninvalid="examNameInvalid(event)"   placeholder="Mid Term">
                                            <span style="color: red;" id="exam_name_helper"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <label for="exam_term">Term</label>
                                            <select class="select form-control" id="exam_term" name="exam_term" oninvalid="examTermInvalid(event)"  data-fouc data-placeholder="Select Term">
                                                <option value="">Select Term</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                            <span style="color: red;" id="exam_term_helper"></span>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <label for="exam_year">Year</label>
                                            <select class="select form-control" id="exam_year" name="exam_year" data-fouc data-placeholder="Select Year">
                                                <option value="">Select Year</option>
                                                <option value={{ date("Y"); }} selected>{{ date("Y"); }}</option>
                                                <option value{{ date("Y") -1 }}>{{ date("Y") -1 }}</option>
                                                <option value={{ date("Y") -2 }}>{{ date("Y") -2 }}</option>
                                                <option value={{ date("Y") -3 }}>{{ date("Y") -3 }}</option>
                                                <option value={{ date("Y") -4 }}>{{ date("Y") -4 }}</option>
                                            </select>
                                            <span style="color: red;" id="exam_year_helper"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="exam_year">Forms sitting for the exam</label>
                                        <ul class="forms_sitting_exam">
                                            @foreach ($forms as $key => $val)
                                            <li class="row one-sitting @if($key % 2 == 0) odd @endif">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <input type="checkbox" class="exam_form my-2 mx-3" onchange="checkState({{ $val->id }}, this, event)" id="min_subject_id{{$val->id}}" style="width: 20px; height: 20px;">
                                                        <p class="my-2 mx-3">Form {{$val->name}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input  class="my-2 mx-3 p-1" type="number" placeholder="Minimum Subject that can be taken" oninput="hideSubject({{ $val->id }}, event)"
                                                    name="min_subject_cnt" id="min_subject_cnt{{$val->id}}" min="0" style="width: 80%;" oninvalid="examSubject({{ $val->id }}, event);"/>
                                                    <br>
                                                    <span style="color: red;" id="min_subject_helper{{ $val->id }}"></span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" id="create-exam-btn">Create<i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                        <div id="consolidated_body" class="active-state">
                            <form method="GET" action="">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="form-group">
                                            <label for="exam_name">Exam Name</label>
                                            <input class="form-control" type="text"  id="exam_name" name="exam_name" required placeholder="Mid Term">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <label for="exam_term">Term</label>
                                            <select class="select form-control" id="exam_term"  name="exam_term" required data-fouc data-placeholder="Select Term">
                                                <option value="">Select Term</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="form-group">
                                            <label for="exam_year">Year</label>
                                            <select class="select form-control" id="exam_year"  name="exam_year" data-fouc data-placeholder="Select Year">
                                                <option value="">Select Year</option>
                                                <option value={{ date("Y"); }} selected>{{ date("Y"); }}</option>
                                                <option value{{ date("Y") -1 }}>{{ date("Y") -1 }}</option>
                                                <option value={{ date("Y") -2 }}>{{ date("Y") -2 }}</option>
                                                <option value={{ date("Y") -3 }}>{{ date("Y") -3 }}</option>
                                                <option value={{ date("Y") -4 }}>{{ date("Y") -4 }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" id="consolidated-exam-btn"><i class="icon-search4 mr-2"></i> Specifify Classes</button>
                                </div>
                            </form>
                        </div>
                        <div id="year_body"  class="active-state">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label for="exam_form">Form</label>
                                        <select class="select form-control" id="exam_form" name="exam_form" data-fouc data-placeholder="Select Form">
                                            <option value="">Select Form</option>
                                            @foreach ($forms as $item)
                                                <option value={{ $item->id }}>{{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ksce_body"  class="active-state">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label for="ksce_form">Form</label>
                                        <select class="select form-control" id="ksce_form" name="ksce_form" data-fouc data-placeholder="Select Form">
                                            <option value="">Select Form</option>
                                            @foreach ($forms as $item)
                                                <option value={{ $item->id }}>{{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="grading_systems_pane" style="padding:15px;background:white">
                    <div class="row">
                        <div class="col-6">
                            <h4>Grading Systems</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="exam_grading/add" class="btn btn-primary">Create Grading System</a>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-8 text-center">Name</th>
                                    <th class="col-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td class="col-10"> {{ $grade->name }}</td>
                                        <td class="col-2">
                                            <div class="row text-center">
                                                <div class="col-6 border-right">
                                                    <a href="{{ route('exam_grading_view', $grade->id) }}" class="btn btn-secondary">View</a>
                                                </div>
                                                <div class="col-6">
                                                    <button onclick="deleteGrade({{ $grade->id }});" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="subject_paper_ratios" style="padding:15px;background:white">
                    <div class="row">
                        <h4>Subject Paper Ratios</h4>
                    </div>

                    <div class="row">
                        <table class="table table-bordered ratio">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="active-state">#</th>
                                    <th rowspan="2">Subject</th>
                                    <th colspan="3">Paper Out Of</th>
                                    <th colspan="3">Paper Contribution percentage</th>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2" class="d-none">ID</th>
                                </tr>
                                <tr>
                                    <th>Paper 1 (Out of X)</th>
                                    <th>Paper 2 (Out of Y)</th>
                                    <th>Paper 3 (Out of Z)</th>
                                    <th>Paper 1 (%)</th>
                                    <th>Paper 2 (%)</th>
                                    <th>Paper 3 (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $len = count($subjects); $i = 0; ?>
                                @for ($i = 0; $i < $len; $i++)
                                    <tr style="line-height:1.5">
                                        <td class="active-state">{{ $i + 1 }}</td>
                                        <td>{{ $subjects[$i]->title }}</td>
                                        @if ($subjects[$i]->out_x>0 || $subjects[$i]->out_y>0 ||  $subjects[$i]->out_z>0 || $subjects[$i]->con_x>0 || $subjects[$i]->con_y>0 || $subjects[$i]->con_z>0)
                                          <td>
                                            <input type="number" name="out_x" placeholder="{{ $subjects[$i]->out_x }}" disabled style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="out_y" placeholder="{{ $subjects[$i]->out_y }}" disabled style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="out_z" placeholder="{{ $subjects[$i]->out_z }}" disabled style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="con_x" placeholder="{{ $subjects[$i]->con_x }}" disabled style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="con_y" placeholder="{{ $subjects[$i]->con_y }}" disabled style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="con_z" placeholder="{{ $subjects[$i]->con_z }}" disabled style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <div class="d-flex align-items-center justify-content-start">
                                                  <button class="btn btn-secondary px-4" disabled onclick="editSubjectRatio('{{ $subjects[$i]->id }}', this);">Edit</button>
                                              </div>
                                          </td>
                                        @else
                                          <td>
                                            <input type="number" name="out_x" placeholder="{{ $subjects[$i]->out_x }}" style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="out_y" placeholder="{{ $subjects[$i]->out_y }}" style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="out_z" placeholder="{{ $subjects[$i]->out_z }}" style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="con_x" placeholder="{{ $subjects[$i]->con_x }}" style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="con_y" placeholder="{{ $subjects[$i]->con_y }}" style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <input type="number" name="con_z" placeholder="{{ $subjects[$i]->con_z }}" style="width: 60px" min="0" max="100"/>
                                          </td>
                                          <td>
                                              <div class="d-flex align-items-center justify-content-start">
                                                  <button class="btn btn-secondary px-4" onclick="editSubjectRatio('{{ $subjects[$i]->id }}', this);">Edit</button>
                                              </div>
                                          </td>
                                        @endif

                                        <td class="d-none"> {{ $subjects[$i]->id }}</td>
                                    </tr>
                                @endfor
                                {{-- @foreach ($subjects as $subject)

                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="student-residences" style="padding:15px;background:white">
                    <div class="row">
                        <div class="col-12">
                            <h3>Deleted Exam</h3>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <table class="table table-bordered ratio">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="2">Name</th>
                                    <th rowspan="2">Academic Year</th>
                                    <th rowspan="2">Term</th>
                                    <th colspan="5">
                                        Offered in 2022
                                    </th>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <th>Deleted by</th>
                                    <th>Deletion Date</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deleteds as $deleted)
                                    <tr>
                                        <td>{{ $deleted->exam->name }}</td>
                                        <td>{{ $deleted->exam->year }}</td>
                                        <td>{{ $deleted->exam->term }}</td>
                                        <td>Form {{ $deleted->form->name }}</td>
                                        <td>{{ $user}}</td>
                                        <td>{{ $deleted->updated_at }}</td>
                                        <td>
                                            <button class="btn btn-primary" onclick="recoverFinal({{ $deleted->exam_id }},{{ $deleted->form_id }}, this);">Recover</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="deleteFinal({{ $deleted->exam_id }}, {{ $deleted->form_id }}, this);">
                                            <i class="icofont-trash"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <th>KCSE Exam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>No KCPE exams found</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('partials.js.exam_js')
@endsection
