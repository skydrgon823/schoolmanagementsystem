<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Repositories\TeacherRepo;
use App\Repositories\UserRepo;

use App\Models\Teacher;
use App\User;
use Response;
use App\Repositories\MyClassRepo;
use App\Repositories\ExamRepo;
use App\Repositories\StudentRepo;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;
class TeacherController extends Controller
{
    protected $teacher_repo, $user;

    public function __construct(ExamRepo $exam,TeacherRepo $teacher_repo, UserRepo $user, MyClassRepo $my_class, StudentRepo $student, MessageRepo $message_repo)
    {
        // $this->middleware('teamSA', ['except' => ['destroy',] ]);
        // $this->middleware('super_admin', ['only' => ['destroy',] ]);
        $this->AT= new AfricasTalking(env('TALKING_USERNAME '), env('TALKING_API_KEY '));
        $this->teacher_repo = $teacher_repo;
        $this->user = $user;
        $this->my_class = $my_class;
        $this->exam = $exam;
        $this->student = $student;
        $this->message_repo = $message_repo;
    }

    public function index() {

        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['group'] = $this->teacher_repo->getAllGroup();
        $d['all_group'] = $this->teacher_repo->getAllGroup();
        $d['types'] = Qs::getUserType();
        $d['teacher_id'] = $this->teacher_repo->findTeacherbyUserID(Auth::user()->id);
        $d['user'] =Auth::user();
        $this->user->updateZero();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.teachers.index', $d);
    }

    public function store(Request $req) {

        // $default_password = 'qwerQWER1234!@#$_teacher';
        $groups = "";
        if($req->group){
            foreach ($req->group as $key => $value) {
                $groups .= $value . ",";
            }
            $groups = rtrim($groups, ",");
        }
        $model = new User;
        $model['name'] = $req->full_name;
        // $model['email'] = $req->email;
        $model['email'] = $req->full_name . '@' . 'bibirionihigh';
        $model['code'] = $this->user->generateRandomString();
        $model['user_type_id'] = 3;
        $model['phone'] = $req->phone_number;
        $model['tsc_no'] = $req->tsc_no;
        $model['gender'] = $req->gender;
        $model['national_id_no'] = $req->national_id_no;
        $model['photo'] = Qs::getDefaultUserImage();
        // $model['password'] = Hash::make($default_password);
        $model['password'] = '';
        if($this->user->getUserEmail($model['email']))
            $model->save();
        else
            return back()->with('flash_warning', __('msg.exit_db'));
        $model->save();
        $user = User::latest()->first();

        $model1 = new Teacher;
        $model1['user_id'] = $user->id;
        $model1['group_id'] = $groups;//$req->group;
        $model1->save();
        // try {
        //     // Thats it, hit send and we'll take care of the rest
        //     $sms = $this->AT->sms();
        //     $result = $sms->send([
        //         'to'      => $model['phone'],
        //         'message' => $model['code'],
        //         'from'    => env('TALKING_USERNAME'),
        //     ]);

        //     // print_r($result);
        // } catch (Exception $e) {
        //     echo "Error: ".$e->getMessage();
        // }
        return back()->with('flash_success', __('msg.store_ok'));
    }
    public function create(Request $req){

        return view('pages.support_team.teachers.create');
    }
    public function edit($id) {

        $d['teacher'] = $this->teacher_repo->findTeacher($id);
        $d['group'] = $this->teacher_repo->getAllGroup();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.teachers.edit', $d);
    }
    public function specificTeachers(){
        $specific_teachers = $this->teacher_repo->getAllTeachers1();
        return json_encode($specific_teachers);
    }
    public function groupTeachers(){
        $group_teachers = $this->teacher_repo->getAllTeachers2();
        return json_encode($group_teachers);
    }
    public function teacher_detail($teacher_id){
        $d['person'] = $this->teacher_repo->findTeacher($teacher_id);
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['group'] = $this->teacher_repo->getAllGroup();
        $d['all_group'] = $this->teacher_repo->getAllGroup();
        $d['types'] = Qs::getUserType();
        $d['subjects'] = $this->my_class->getClassSubjectByTeacher($teacher_id);
        $d['exams'] = $this->exam->all();
        $d['exam_records'] = $this->exam->allExamRecord();
        $d['students'] = $this->student->getAllStudents();
        $d['grades'] = $this->my_class->allGradeWithNotNull();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.teachers.detail', $d);
    }
    public function update(Request $req, $id)
    {
        // echo($req->full_name.' '.$id);
        $groups = "";
        if($req->group){
            foreach ($req->group as $key => $value) {
                $groups .= $value . ",";
            }
            $groups = rtrim($groups, ",");
        }
        $data['name'] = $req->full_name;
        // $data['email'] = $req->email;
        $data['email'] = $req->full_name . '@' . 'bibirionihigh';
        $data['phone'] = $req->phone_number;
        $data['tsc_no'] = $req->tsc_no;
        $data['gender'] = $req->gender;
        $data['national_id_no'] = $req->national_id_no;

        $data['group'] =$groups;// $req->group;
        $this->teacher_repo->updateTeacher($id, $data);

        $d['teacher'] = $this->teacher_repo->findTeacher($id);
        $d['group'] = $this->teacher_repo->getAllGroup();

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function destroy($id)
    {
        $this->teacher_repo->deleteTeacher($id);
        return redirect('/teachers');
        // return back()->with('flash_success', __('msg.del_ok'));
    }

    // for group of teachers
    public function group_index(Request $request) {


        $d['all_group'] = $this->teacher_repo->getAllGroup();
        return view('pages.support_team.teachers.group_index', $d);
    }

    public function update_group_name(Request $request) {

        $this->teacher_repo->updateGroupName($request->classId, $request->updated_group_name);
        return json_encode(['ok' => true, 'msg' => "Updated Successfully"]);
    }
    public function delete_group(Request $request) {
        $this->teacher_repo->deleteGroup($request->groupId);
        return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
    }

    public function new_group(Request $request) {

        $this->teacher_repo->addGroup($request->group_name);
        return back()->with('flash_success', __('msg.store_ok'));
    }
}
