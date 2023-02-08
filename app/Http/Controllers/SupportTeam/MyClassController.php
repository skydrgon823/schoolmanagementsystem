<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\MyClass\ClassCreate;
use App\Http\Requests\MyClass\ClassUpdate;

use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Repositories\TeacherRepo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MyClass;
use App\Models\ClassSubject;
use App\Models\Form;
use App\Models\Student;
use App\Models\StudentSubject;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;

class MyClassController extends Controller
{
    protected $my_class, $user, $teacher_repo;

    public function __construct(MyClassRepo $my_class, UserRepo $user, TeacherRepo $teacher_repo, MessageRepo $message_repo)
    {
        // $this->middleware('teamSA', ['except' => ['destroy',] ]);
        // $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
        $this->teacher_repo = $teacher_repo;
        $this->message_repo = $message_repo;
    }

    public function index()
    {

        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();

        $d['teacher'] = $this->teacher_repo->findTeacherbyUserID(Qs::getUserID());
        $d['all_myclasses'] = $this->my_class->getAllMyClass();
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['all_streams'] = ClassSubject::all();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        // echo $d['teacher']['id'];
        // echo $d['all_myclasses'];
        return view('pages.support_team.classes.index', $d);
    }


    public function assign_supervisor(Request $request) {

        $this->my_class->assignSupervisor($request->formId, $request->teacher_id);
        $teacher = $this->teacher_repo->findTeacher($request->teacher_id);
        // return json_encode(['ok' => true, 'msg' => "Assigned Successfully", 'teacher_name' => $teacher->user->name]);
        return json_encode(['ok' => true, 'msg' => "Class Supervisor rights assigned successfully", 'teacher_name' => $teacher->user->name]);
    }

    public function delete_supervisor(Request $request) {

        $all_teachers = $this->teacher_repo->getAllTeachers1();
        $this->my_class->deleteSupervisor($request->formId);
        // return json_encode(['ok' => true, 'msg' => "Deleted Successfully", 'all_teachers' => $all_teachers]);
        return json_encode(['ok' => true, 'msg' => "Class Supervisor rights revoked successfully", 'all_teachers' => $all_teachers]);
    }



    public function class_manage($form_id)
    {
        $d['form_id'] = $form_id;
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['class_list'] = $this->my_class->getClass($form_id);
        $d['class_list1'] =  $this->my_class->getClassList($form_id);
        $d['teacher_style'] = "class_teacher";
        $d['teacher'] = $this->teacher_repo->findTeacherbyUserID(Qs::getUserID());
        $d['all_myclasses'] = $this->my_class->getAllMyClass();
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['all_streams'] = ClassSubject::all();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // $d['class_list1'] = $c = $this->my_class->find($class_id);
        return view('pages.support_team.classes.class_manage', $d);
    }
    public function class_manage1($form_id)
    {
        $d['form_id'] = $form_id;
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['class_list'] = $this->my_class->getClass($form_id);
        // $d['all_forms'] = $this->my_class->getAllForms();
        $d['class_list1'] =  $this->my_class->getClassList($form_id);
        $d['teacher_style'] = "subject_teacher";
        $d['teacher'] = $this->teacher_repo->findTeacherbyUserID(Qs::getUserID());
        $d['all_myclasses'] = $this->my_class->getAllMyClass();
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['all_streams'] = ClassSubject::all();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // echo $d['class_list1'];
        return view('pages.support_team.classes.class_manage', $d);
    }

    public function class_subject_manage($class_id) {
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['class_list'] = $this->my_class->find($class_id);
        $d['class_subjects'] = $this->my_class->findSubjectByClass($class_id, 'id');
        $d['class_id']  = $class_id;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $d['teacher'] = $this->teacher_repo->findTeacherbyUserID(Qs::getUserID());
        $d['all_myclasses'] = $this->my_class->getAllMyClass();
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['all_streams'] = ClassSubject::all();
        $d['types'] = Qs::getUserType();
        // echo $d['class_subjects'];
        return view('pages.support_team.classes.subject_manage', $d);
    }
    public function students_taken_csubject($classSubjectId) {

        $d['subject'] = $classSubjectId;
        $d['students'] = ClassSubject::find($classSubjectId)->students_taken_this_subject;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // echo $d['students'];
        // return ;//view('pages.support_team.classes.students_taken_this_subject', $d);
        return view('pages.support_team.classes.students_taken_this_subject', $d);
    }


    public function students_taken_form($form_id)
    {
        $d['form_id'] = $form_id;
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['class_list'] = $this->my_class->getClass($form_id);
        $d['class_list1'] =  $this->my_class->getClassList($form_id);
        // $d['class_list1'] = $c = $this->my_class->find($class_id);
        return view('pages.support_team.classes.students_taken_form', $d);
    }
    public function delete_selected_student(Request $req) {

        // print_r($req->students);
        $res = [];
        if(is_array($req->students)){
            $res = array_values($req->students);
        }
        Student::destroy($res);
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['class_list'] = $this->my_class->getClass($req->formId);
        $d['class_list1'] =  $this->my_class->getClassList($req->formId);
        // echo $req->formId;
        // return json_encode(['ok' => true, 'msg' => "Deleted Successfully", 'all_subjects' => $d['all_subjects']]);
        //return redirect()->route('class_manage1/{form_id}',['form_id'=>$req->form_id]);
        return redirect()->action(
            [MyClassController::class, 'class_manage1'], ['form_id' => $req->formId]
        );
    }
    public function delete_selected_student1(Request $req) {

        // print_r($req->students);
        $res = [];
        if(is_array($req->students)){
            $res = array_values($req->students);
        }
        Student::destroy($res);
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['class_list'] = $this->my_class->getClass($req->formId);
        $d['class_list1'] =  $this->my_class->getClassList($req->formId);
        // echo $req->formId;
        // return json_encode(['ok' => true, 'msg' => "Deleted Successfully", 'all_subjects' => $d['all_subjects']]);
        //return redirect()->route('class_manage1/{form_id}',['form_id'=>$req->form_id]);
        return redirect()->action(
            [MyClassController::class, 'students_taken_form'], ['form_id' => $req->formId]
        );
    }
    public function class_list($form_id)
    {
        $d['class_list'] = $c = $this->my_class->getClassList($form_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.classes.class_list', $d);
    }

    public function class_list2($class_id)
    {
        $d['class_list'] = $this->my_class->find($class_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // echo $d['class_list'];
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['all_streams'] = $this->my_class->getAllMyClassOnly();
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['user'] =Auth::user();
        return view('pages.support_team.classes.class_list2', $d);
    }
    public function class_list3($form_id)
    {
        $d['class_list'] = $this->my_class->findByForm($form_id);
        $d['form'] = $this->my_class->findForm($form_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // echo $d['class_list'];
        // return;
        return view('pages.support_team.classes.class_list3', $d);
    }


    public function assign_class_teacher(Request $request) {

        $this->my_class->assignClassTeacher($request->classId, $request->teacher_id);
        $teacher = $this->my_class->findClassTeacher($request->classId);
        return json_encode(['ok' => true, 'msg' => "Assigned Successfully", 'teacher_name' => $teacher->user->name]);
    }

    public function delete_class_teacher(Request $request) {

        $this->my_class->deleteClassTeacher($request->classId);
        $all_teachers = $this->teacher_repo->getAllTeachers1();
        return json_encode(['ok' => true, 'msg' => "Deleted Successfully", 'all_teachers' => $all_teachers]);
    }
    public function update_class_stream(Request $request) {

        MyClass::where('id', $request->classId)->update(['stream' => $request->updated_class_stream]);
        return Qs::jsonStoreOk();
    }

    public function delete_class(Request $request) {
        MyClass::where('id', $request->classId)->delete();
        // delete class subjects
        ClassSubject::where('my_class_id', $request->classId)->delete();
        // set property as null in Student
        Student::where('my_class_id', $request->classId)->update(['my_class_id' => null]);
        return Qs::jsonStoreOk();
    }





    public function delete_subject_teacher(Request $request) {

        $this->my_class->deleteSubjectTeacher($request->classSubjectId);
        $all_teachers = $this->teacher_repo->getAllTeachers1();
        return json_encode(['ok' => true, 'msg' => "Deleted Successfully", 'all_teachers' => $all_teachers]);
    }

    public function assign_subject_teacher(Request $request) {

        $this->my_class->assignSubjectTeacher($request->classSubjectId, $request->teacher_id);
        $teacher = $this->teacher_repo->findClassSubjectTeacher($request->classSubjectId);
        return json_encode(['ok' => true, 'msg' => "Assigned Successfully", 'teacher_name' => $teacher->user->name]);
    }

    public function delete_subject(Request $request) {
        $this->my_class->deleteClassSubject($request->classSubjectId);
        // delete StudentSubject
        StudentSubject::where('class_subject_id', $request->classSubjectId)->delete();
        return Qs::jsonStoreOk();
    }



    public function delete_selected_subject(Request $req) {

        // print_r($req->students);
        $res = [];
        if(is_array($req->students)){
            $res = array_values($req->students);
        }
        // print_r($res);
        $row = Student::destroy($res);
        // $d['students'] = ClassSubject::find($classSubjectId)->students_taken_this_subject;
        echo $req->subject;
        $d['students'] = ClassSubject::find($req->subject)->students_taken_this_subject;
        // echo $d['students'];
        // return json_encode(['ok' => true, 'msg' => "Deleted Successfully", 'all_subjects' => $d['all_subjects']]);
        //return redirect()->route('class_manage1/{form_id}',['form_id'=>$req->form_id]);
        // return ;
        return redirect()->action(
            [MyClassController::class, 'students_taken_csubject'], ['classSubjectId' => $req->subject]
        );
    }

    public function store(Request $req)
    {
        //create my_class
        $myclass = new MyClass;
        $myclass['form_id'] = $req->form_id;
        $myclass['stream'] = $req->stream;
        $myclass->save();

        //create class_subject
        $last_id = MyClass::orderBy('id', 'DESC')->first();
        $subject_list = json_decode($req['subject_list']);

        foreach($subject_list as $slist) {
            if($slist->check_status == true) {

                $classsubject = new ClassSubject;
                $classsubject['my_class_id'] = $last_id->id;
                $classsubject['subject_id'] = $slist->id;
                $classsubject->save();
            }
        }
        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $d['myclass'] = $c = $this->my_class->find($id);
        $bbbb = $this->my_class->getMyClassSubjects($id);
        $myclasssubject = array();
        foreach($bbbb as $value) {
            array_push($myclasssubject, $value->subject_id);
        }
        $d['myclasssubject'] = $myclasssubject;
        $d['all_subjects'] = $this->my_class->getAllSubjects();
        $d['classId'] = $id;
        return is_null($c) ? Qs::goWithDanger('classes.index') : view('pages.support_team.classes.edit', $d);
    }

    public function update(Request $req, $id)
    {
        $data['form_id'] = $req->form_id;
        $data['stream'] = $req->stream;
        $this->my_class->update($id, $data);

        //create class_subject

        $subject_list = json_decode($req['subject_list']);

        foreach($subject_list as $slist) {
            if($slist->check_status == true) {
                if(!ClassSubject::where('my_class_id', $id)->where('subject_id', $slist->id)->first()) {
                    $classsubject = new ClassSubject;
                    $classsubject['my_class_id'] = $id;
                    $classsubject['subject_id'] = $slist->id;
                    $classsubject->save();
                }
            } else {
                ClassSubject::where('my_class_id', $id)->where('subject_id', $slist->id)->delete();
            }
        }


        return Qs::jsonUpdateOk();
    }

    public function destroy($id)
    {
        $this->my_class->delete($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }

}

