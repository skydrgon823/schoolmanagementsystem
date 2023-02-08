<?php

namespace App\Http\Controllers\SupportTeam;

use Illuminate\Http\Request;
use App\Helpers\Qs;
use App\Http\Requests\Exam\ExamCreate;
use App\Http\Requests\Exam\ExamUpdate;
use App\Repositories\ExamRepo;
use App\Repositories\MarkRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\TeacherRepo;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Validator;

use App\Models\Exam;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;
class ExamController extends Controller
{
    protected $exam;
    protected $my_class;
    public function __construct(ExamRepo $exam, MyClassRepo $my_class, MarkRepo $mark, TeacherRepo $teachers, UserRepo $user, MessageRepo $message_repo)
    {
        // $this->middleware('teamSA', ['except' => ['destroy',] ]);
        // $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->exam = $exam;
        $this->my_class = $my_class;
        $this->mark = $mark;
        $this->teachers = $teachers;
        $this->user = $user;
        $this->message_repo = $message_repo;
    }

    public function index()
    {
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['myclasses'] = $this->my_class->getAllMyClasses();
        $d['types'] = Qs::getUserType();
        $d['teachers'] = $this->teachers->getAllTeachers();
        $d['grades'] = $this->my_class->allClassTypeWithNotNull();
        // $d['subjects'] = $this->my_class->allSubjects();
        $d['subjects'] = $this->my_class->fifteenSubject();
        $d['deleteds'] = $this->exam->getAllExamFormsByDeleted();
        $d['last'] = $this->exam->last();
        $d['user'] = Qs::getUserName();
        $this->user->updateZero();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.index', $d);
    }
    public function show($id)
    {
        //
        $d['exam'] = $this->exam->find($id);
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.show', $d);
    }
    public function update(Request $req, $id)
    {
        $data['name'] = $req->exam_name;
        $res = $this->exam->update($id, $data);
        $data['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // if($res) return json_encode(['ok' => true, 'msg' => "Updated Successfully"]);
        return redirect()->route('exams.show', $id);
    }
    public function exam_manage_config($exam_id, $form_id){
        $d['exam'] = $this->exam->find($exam_id);
        $d['form'] = $this->exam->getForm($form_id);
        $d['types'] = Qs::getUserType();
        $d['subjects'] = $this->my_class->allSubjects();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_manage_config', $d);
    }
    public function exam_manage_upload($exam_id, $form_id){
        $d['exam'] = $this->exam->find($exam_id);
        $d['form'] = $this->exam->getForm($form_id);
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_manage_upload', $d);
    }
    public function exam_manage_add($exam_id){
        $d['exam_forms'] = $this->exam->getExamFormsByExamId($exam_id);
        $d['types'] = Qs::getUserType();
        $d['exam_id'] = $exam_id;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // print_r($d['exam_forms']);
        return view('pages.support_team.exams.exam_manage_add', $d);
    }
    public function exam_grading_add(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['grades'] = $this->mark->allGrades();
        $d['grades_max'] = $this->mark->maxGrades();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_grading_add', $d);
    }
    public function exam_grading_view($grade_id){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['grade'] = $this->exam->allGradesWithNoNull($grade_id);
        $d['class_type_name'] = $this->my_class->findType($grade_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_grading_view', $d);
    }
    public function exam_class_upload($class_subject_id, $exam_id, $teacher_id, $subject_id){
        $d['exam'] = $this->exam->find($exam_id);
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['class_subject'] = $this->my_class->getClassSubject($class_subject_id);
        $d['types'] = Qs::getUserType();
        $d['class_subject_id'] = $class_subject_id;
        $d['exam_id'] = $exam_id;
        $d['teacher_id'] = $teacher_id;
        $d['subject_id'] = $subject_id;
        $d['subject'] = $this->my_class->findSubject($subject_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_upload', $d);
        // return json_encode(['subject'=>$d['subject']]);
    }
    public function exam_class_upload_view($class_subject_id, $exam_id, $teacher_id, $subject_id){
        $d['exam'] = $this->exam->find($exam_id);
        $d['forms'] = $this->my_class->getAllForms();
        $d['class_subject'] = $this->my_class->getClassSubject($class_subject_id);
        $data['exam_id'] = $exam_id;
        $data['af'] = $subject_id;
        $d['marks'] = $this->exam->getRecord($data);
        $d['types'] = Qs::getUserType();
        $d['class_subject_id'] = $class_subject_id;
        $d['exam_id'] = $exam_id;
        $d['teacher_id'] = $teacher_id;
        $d['subject_id'] = $subject_id;
        $d['papers'] = $this->subject->getPapers($subject_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_upload_view', $d);
        // return json_encode(['data'=>$d]);
    }
    public function exam_class_view($exam_id, $teacher_id){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['class_subject'] = $this->my_class->getClassSubjectByTeacher($teacher_id);
        $data['exam_id'] = $exam_id;
        $d['marks'] = $this->exam->getRecord($data);
        $d['exam_id'] = $exam_id;
        $d['teacher_id'] = $teacher_id;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_view', $d);
    }
    public function exam_class_upload_mark(Request $req){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['myclasses'] = $this->my_class->getAllMyClasses();
        $d['types'] = Qs::getUserType();
        $d['teachers'] = $this->teachers->getAllTeachers();
        $d['grades'] = $this->my_class->allClassTypeWithNotNull();
        $d['subjects'] = $this->my_class->allSubjects();

        $class_exam_count = $req->class_exam_count;
        $data1['name'] =$req->exam_class_subject>0?"Paper".$req->exam_class_subject:'';
        $data['year'] = date('Y');
        $data['af'] = $req->subjectID;
        $data['exam_id'] = $req->exam_class_upload_exam;
        if($data1['name'] =='') return json_encode(['msg'=>'Upload Fail']);
        for ($i=0; $i < $class_exam_count; $i++) {
            $temp = '';
            // $temp ="Exam".$i;

            // $data['exam_id'] = $req->$temp;

            $temp = "student".$i;
            $record = [];
            $data['student_id'] = $req->$temp;

            $temp = "class".$i;
            $data['my_class_id'] = $req->$temp;

            $temp = "mark".$i;
            $data['pos'] = $req->$temp;

            $temp = "class".$i;
            $data1['my_class_id'] = $req->$temp;

            $temp = "teacher".$i;
            $data1['teacher_id'] = $req->$temp;
            // return json_encode(['temp'=>$temp, 'data'=>$req->$temp]);
            if($data1['my_class_id']>0 && $data1['teacher_id'] && $data1['name']!=''){
                $curSection = $this->my_class->getClassSection($data1['name']);
                if($curSection!=null){
                    $data['section_id'] = $curSection->id;
                    array_push($record, $this->exam->createRecord($data));
                    // return json_encode(['record'=>'ok']);
                }
                else{
                    $section = $this->my_class->createSection($data1);
                    $data['section_id'] = $section->id;
                    array_push($record, $this->exam->createRecord($data));
                    // return json_encode(['record'=>'ok']);
                }
            }
        }
        return redirect('/exams');
        // return json_encode(['msg'=>'Upload success', 'exam_reacord'=>$data, 'section'=>$data1, 'record'=>$record]);
    }
    public function exam_class_download(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        // return view('pages.support_team.exams.exam_class_upload', $d);
        return json_encode(['msg'=>'download success']);
    }
    public function exam_class_grant(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_grant', $d);
    }

    public function exam_class_detail_view(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_detail_view', $d);
    }
    public function exam_class_score(Request $req){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_detail_view', $d);
    }
    public function exam_subject_upload(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_class_upload', $d);
    }
    public function exam_manage_publish(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_manage_publish', $d);
    }
    public function exam_manage_analysis(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_manage_analysis', $d);
    }
    public function exam_manage_send(){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.index', $d);
    }
    public function grade_store(Request $req){

        $forms = json_decode($req->formData);
        // $grade_name = $req->gradeName;
        $data1['name'] = $req->gradeName;
        $data1['code'] = $this->user->generateRandomString();
        $class_type =$req->gradeName!=null?$this->my_class->createClassType($data1): '';
        // $temp = [];
        foreach ($forms as $form) {
            // $data['id'] = $form->id;
            $data['mark_from'] = $form->low;
            $data['mark_to'] = $form->high;
            $data['name'] = $form->name;
            $data['remark'] = $form->remark;
            if($class_type!='') {
                $data['class_type_id'] = $class_type->id;
                $grades = $this->exam->createGrade($data);
            }else{
                $this->exam->updateGrade($form->id, $data);
                // array_push($temp, $t);
            }
        }

        return json_encode(['ok' => true, 'msg' => "Created Successfully", 'data'=>$forms]);
    }
    public function exam_manage_send_msg(Request $req){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.exams.exam_manage_send', $d);
    }
    public function class_index(Request $req){
        $d['exams'] = $this->exam->all();
        $d['forms'] = $this->my_class->getAllForms();
        $d['teacher'] = $this->teachers->findTeacherbyUserID(Qs::getUserID());
        $d['teacher_name'] = $d['teacher']['user']['name'];
        $last = $this->exam->last();
        // return json_encode(['teacher'=>$d['teacher_name']]);
        if($req->exam > 0){
            $d['myclasses'] = $this->my_class->getClassByExam($req->exam);
            $d['myclasses1'] = $this->my_class->getAllMyExam1();
            $d['streams'] = $this->my_class->getClassByExamStream($req->exam);
            // $d['myclasses'] = $this->my_class->getClassByTeacher($req->exam);
            // $d['class_subjects'] = $this->my_class->findSubjectByTeacher($req->teacher);
        }else{
            // $d['myclasses'] = $this->my_class->getAllMyExam($last);
            $d['myclasses'] = $this->my_class->getClassByExam($last);
            $d['myclasses1'] = $this->my_class->getAllMyExam1();
            $d['streams'] = $this->my_class->getAllMyExamStream();
            // $d['myclasses'] = $this->my_class->getAllMyClasses();
            // $d['class_subjects'] = $this->my_class->allSubject();
        }

        $d['types'] = Qs::getUserType();
        $d['teachers'] = $this->teachers->getAllTeachers();
        // echo $req->teacher;
        // return view('pages.support_team.exams.index', $d);

        return json_encode(['exams'=>$d['exams'],'last'=>$last, 'forms'=>$d['forms'], 'myclasses'=>$d['myclasses'], 'myclasses1'=>$d['myclasses1'], 'types'=>$d['types'], 'teachers'=>$d['teachers'],'teacher'=>$d['teacher'],'teacher_name'=>$d['teacher_name'],'streams'=>$d['streams']]);
    }
    public function exam_index(Request $req) {
        if($req->year > 1){
            $exams = $this->exam->allByYear($req->year);
        }else{
            $exams = $this->exam->all();
        }
        $terms = $this->exam->terms();
        $forms = $this->my_class->getAllForms();
        $examforms = $this->exam->getAllExamForms();
        $deleteds = $this->exam->getAllExamFormsByDeleted();
        $grades = $this->my_class->allClassTypeWithNotNull();

        $myClasses = $this->my_class->getAllMyClasses();
        $marks = $this->mark->all();
        $teachers = $this->teachers->getAllTeachers();
        $user= Qs::getUserName();
        return json_encode(['exams' => $exams, 'forms' => $forms, 'examforms' => $examforms,
                'marks'=>$marks, 'terms'=>$terms, 'myclasses'=>$myClasses, 'teachers'=>$teachers, 'grades'=>$grades, 'deleteds'=>$deleteds, 'user'=>$user]);
    }

    public function examResults(Request $request){

        $std_res = array();
        $exams = $this->exam->getExamByForm($request->form_id);
        foreach ($exams as $key => $val) {
            array_push($std_res, array(
                'id' => $val->exam_id,
                'name' => $val->exam->name . 'of term '. $val->exam->term .' , '. $val->exam->year,
                // 'adm_no' => $val->adm_no,
                // 'user_id' => $val->user_id,
            ));
        }
        return json_encode($std_res);
    }
    public function storeExamForm(Request $req){
        // print_r($req);
        $data['exam_id'] = $req->exam_id;
        $forms = json_decode($req->forms, false);
        foreach($forms as $form) {
            $data['form_id'] = $form->id;
            $data['min_subject_cnt'] = $form->cnt;
            $examform = $this->exam->createExamForm($data);
        }
        return json_encode(['ok' => true, 'msg' => "Created Successfully"]);
    }
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'exam_type' => 'required|string',
            'exam_name' => 'required|string',
            'exam_term' => 'required|numeric',
            'exam_year' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $data['type'] = $req->exam_type;
        $data['name'] = $req->exam_name;
        $data['term'] = $req->exam_term;
        $data['year'] = $req->exam_year;
        if(!$exam = $this->exam->isExist($data)) {

            $exam = $this->exam->create($data);

            $exam_forms = json_decode($req->exam_forms);

            foreach($exam_forms as $value) {

                $data2['exam_id'] = $exam->id;
                $data2['form_id'] = $value->form_id;
                $data2['min_subject_cnt'] = $value->min_subject_cnt;
                $data2['state'] = false;
                $this->exam->createExamForm($data2);
                // return json_encode(['data'=>$data2]);
            }
            return json_encode(['ok' => true, 'msg' => "Created Successfully"]);
        }
        return json_encode(['ok' => true, 'msg' => "Already Exist"]);
    }

    public function exam_update(Request $req) {

        $data['name'] = $req->name;
        $data['type'] = $req->type;
        $data['term'] = $req->term;
        $data['year'] = $req->year;
        $res = $this->exam->update($req->id, $data);
        if($res) return json_encode(['ok' => true, 'msg' => "Updated Successfully"]);
        return json_encode(['ok' => true, 'msg' => "An error occured"]);
    }
    public function exam_delete(Request $req)
    {
        // return json_encode(['data' => $req->id]);
        $res = $this->exam->delete($req->id);
        if($res) return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
        return json_encode(['ok' => false, 'msg' => "An error occured"]);
    }
    public function exam_final_delete(Request $req)
    {
        // return json_encode(['data' => $req->id]);
        $res = $this->exam->each_delete_final($req->exam_id, $req->form_id);
        if($res) return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
        return json_encode(['ok' => false, 'msg' => "An error occured"]);
    }
    public function exam_final_recover(Request $req)
    {
        // return json_encode(['data' => $req->id]);
        $res = $this->exam->each_delete_recover($req->exam_id, $req->form_id);
        if($res) return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
        return json_encode(['ok' => false, 'msg' => "An error occured"]);
    }
    public function grade_delete(Request $req)
    {
        // return json_encode(['data' => $req->id]);
        $res = $this->exam->deleteGradeByClassTypeID($req->class_type_id);
        if($res) return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
        return json_encode(['ok' => false, 'msg' => "An error occured"]);
    }

    public function each_exam_delete(Request $req)
    {
        // return json_encode(['exam' => $req->exam_id, 'form'=>$req->form_id, 'ok' => true]);
        $res = $this->exam->each_delete($req->exam_id, $req->form_id);
        if(!$res) return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
        return json_encode(['ok' => false, 'msg' => "An error occured"]);
    }
}
