<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Helpers\Mk;
use App\Http\Requests\Student\StudentRecordUpdate;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use App\Repositories\TeacherRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Message;
use App\Repositories\MessageRepo;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentTempExport;
use App\Imports\StudentTempImport;
use File;

class StudentRecordController extends Controller
{
    protected $loc, $my_class, $user, $student, $teacher_repo;

   public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user, StudentRepo $student, TeacherRepo $teacher_repo, MessageRepo $message_repo)
   {
       $this->middleware('teamSA', ['only' => ['edit','update', 'reset_pass', 'create', 'store', 'graduated'] ]);
       $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->user = $user;
        $this->student = $student;
        $this->teacher_repo = $teacher_repo;
        $this->message_repo = $message_repo;
   }

    public function reset_pass($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        $data['password'] = Hash::make('student');
        $this->user->update($st_id, $data);
        return back()->with('flash_success', __('msg.p_reset'));
    }

    public function index()
    {
        $data['form'] = $f = $this->my_class->getAllForms();
        $data['stream'] = $this->my_class->getClass($f[0]->id);
        $data['form1'] = $this->my_class->findForm(1);
        $data['residence'] = $this->student->getResidences();
        $data['types'] = Qs::getUserType();
        $data['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        return view('pages.support_team.students.index', $data);
    }

    public function store(Request $req)
    {
        $default_password = 'qwerQWER1234!@#$_student';
        $model['name'] = $req->full_name;
        $model['email'] = $req->email;
        $model['code'] = $this->user->generateRandomString();
        $model['photo'] = Qs::getDefaultUserImage();
        $model['user_type_id'] = 2;
        $model['password'] = Hash::make($default_password);
        $user = $this->user->create($model); // Create User

        $my_class = $this->my_class->searchMyClass($req->form, $req->stream);
        $sr['user_id'] = $user->id;
        $sr['my_class_id'] = $my_class['id'];
        $sr['adm_no'] = $req->admission_number;
        $this->student->createStudent($sr); // Create Student
        return back()->with('flash_success', __('msg.store_ok'));
    }

    public function studentGroup(){
        $group = $this->my_class->getAllForms();
        return json_encode($group);
    }
    public function specificStudents(Request $request){

        $std_res = array();
        $classes = $this->my_class->getClass($request->form_id);
        foreach ($classes as $key => $class) {
            $students = $this->student->findStudentsByClass1($class->id);
            foreach($students as $key=>$val) {
                array_push($std_res, array(
                    'id' => $val->user_id,
                    'name' => $val->user->name,
                    'adm_no' => $val->adm_no,
                    'user_id' => $val->user_id,
                ));
            }
        }
        return json_encode($std_res);
    }
    public function specificClasses(Request $request){

        $std_res = array();
        $classes = $this->my_class->getClass($request->form_id);
        foreach ($classes as $key => $val) {
            array_push($std_res, array(
                'id' => $val->id,
                'name' => $val->stream,
            ));
        }
        return json_encode($std_res);
    }

    public function std_search_adm_num(Request $request) {

        return $this->student->searchStudent('std_adm_num', $request->std_adm_num);


    }
    public function std_search_name(Request $request) {

        return $this->student->searchStudent('std_name', $request->std_name, $request->std_form_id);


    }
    public function std_search_phone(Request $request) {

        return $this->student->searchStudent('std_phone_num', $request->std_phone_num);


    }
    public function std_search_upi(Request $request) {

        return $this->student->searchStudent('std_upi', $request->std_upi);


    }


    public function std_search_index_num(Request $request) {

        return $this->student->searchStudent('std_index_num', $request->std_index_num);
    }

    public function getStreamAboutForm(Request $request) {

        $claeess =  $this->my_class->getClass($request->formId);
        return json_encode(['classes' => $claeess]);
    }

    public function getStreamAboutForm2(Request $request) {

        $buff =  $this->my_class->getClass($request->destination_form_id);

        $claeess = array();
        foreach($buff as $value) {
            if ($request->origin_form_id == $request->destination_form_id) {
                if ($value->stream != $request->origin_stream) {
                    array_push($claeess, array(
                        'id' => $value->id,
                        'form_id' => $value->form_id,
                        'stream' => $value->stream,
                        'teacher_id' => $value->teacher_id
                    ));
                }
            } else {
                array_push($claeess, array(
                    'id' => $value->id,
                    'form_id' => $value->form_id,
                    'stream' => $value->stream,
                    'teacher_id' => $value->teacher_id
                ));
            }
        }

        return json_encode(['classes' => $claeess]);
    }

    public function getStudentForMoving(Request $request) {
        $myclass = $this->my_class->findClass($request->formId, $request->stream);
        $students_moving = array();
        foreach($myclass->students as $val) {
            array_push($students_moving, array(
                'id' => $val->id,
                'adm_no' => $val->adm_no,
                'name' => $val->user->name,
                'destination_id' => $val->destination_class_id,
                'destination_form_id' => ($val->destination_class_id != 0) ? $val->destination_class->form_id : 0,
                'destination_stream' => ($val->destination_class_id != 0) ? $val->destination_class->stream : '',
            ));
        }
        return json_encode(['students_moving' => $students_moving]);
    }

    public function getStudentForApproving(Request $request) {

        $my_class = $this->my_class->findClass($request->origin_form_id, $request->origin_stream);
        $buff = $this->student->findPendingStudents($my_class->id);

        $approving_students = array();
        foreach($buff as $val) {
            array_push($approving_students, array(
                'id' => $val->id,
                'adm_no' => $val->adm_no,
                'name' => $val->user->name,
                'my_class_id' => $val->my_class_id,
                'current_form_id' => $val->my_class->form_id,
                'current_stream' => $val->my_class->stream,
            ));
        }

        return json_encode(['approving_students' => $approving_students]);
    }

    public function moveStudents(Request $request) {

        $origin_class = $this->my_class->findClass($request->origin_form_value, $request->origin_stream_value)->id;
        $destination_class = $this->my_class->findClass($request->destination_form_value, $request->destination_stream_value)->id;

        $students_to_move = json_decode($request['students_to_move']);
        foreach($students_to_move as $slist) {
            if($slist->id != 0 && $slist->check_status == true) {
                $this->student->moveStudent($slist->id, $destination_class);
            }
        }
        $buff = $this->student->findStudentPending($origin_class);
        $students_pending = array();
        foreach($buff as $val) {
            array_push($students_pending, array(
                'id' => $val->id,
                'adm_no' => $val->adm_no,
                'name' => $val->user->name,
                'destination_id' => $val->destination_class_id,
                'destination_form_id' => $val->destination_class->form_id,
                'destination_stream' => $val->destination_class->stream,
            ));
        }


        return json_encode(['ok' => true, 'msg' => "Moved Successfully", 'students_pending' => $students_pending]);
    }

    public function cancelMoveStudent(Request $request) {
        $this->student->cancelMoveStudent($request->id);
        return Qs::jsonUpdateOk();
    }

    public function acceptMoveStudent(Request $request) {
        $this->student->acceptMoveStudent($request->id);
        return json_encode(['ok' => true, 'msg' => "Moved Successfully"]);
    }

    public function rejectApproveStudentsAll(Request $request) {

        $my_class = $this->my_class->findClass($request->origin_form_id, $request->origin_stream);
        $this->student->rejectApproveStudentsAll($my_class->id);
        return json_encode(['ok' => true, 'msg' => "Moved Successfully"]);
    }

    public function acceptApproveStudentsAll(Request $request) {

        $my_class = $this->my_class->findClass($request->origin_form_id, $request->origin_stream);
        $this->student->acceptApproveStudentsAll($my_class->id);
        return json_encode(['ok' => true, 'msg' => "Moved Successfully"]);
    }

    public function createResidence(Request $request) {

        $residences = json_decode($request['residences']);
        foreach($residences as $res) {
            $data['name'] = $res->value;
            $this->student->createResidence($data);
        }

        return json_encode(['ok' => true, 'msg' => "Created Successfully"]);
    }

    public function updateResidence(Request $request) {

        $this->student->updateResidence($request->id, $request->updated_name);
        return json_encode(['ok' => true, 'msg' => "Updated Successfully"]);
    }

    public function getResidences(Request $request) {

        $residences = $this->student->getResidences();
        return json_encode(['residences' => $residences]);
    }

    public function deleteResidence(Request $request) {

        $this->student->deleteResidence($request->id);
        return json_encode(['ok' => true, 'msg' => "Created Successfully"]);
    }

    public function downloadTemplate() {

        return Excel::download(new StudentTempExport, 'Students-Template.xlsx');

        // return Excel::download(new TestExcelExport, 'users-' . time() . '.csv');
        // return Excel::download(new TestExcelExport, 'users-' . time() . '.xlsx');
    }

    public function fileImport2(Request $request) {
        $this->validate($request, [
            'profile'  => 'required|mimes:xls,xlsx'
        ]);
        // $path = $request->file('profile')->getRealPath();
        // dd($path);
        // "C:\xampp\tmp\phpB543.tmp"

        // dd($request->file('profile')->store('temp'));
        // "temp/7QXOQ63X6YhBMVp0GJoPyBRC1FYj8lk5hY9viedr.xlsx"

        Excel::import(new StudentTempImport, $request->file('profile')->store('temp'));
        return back()->with('msg', 'Created Successfully');
    }

    public function updatePhotos(Request $request) {

        if($request->hasfile('files'))
        {

            foreach($request->file('files') as $key => $file)
            {
                $name = $file->getClientOriginalName();
                $i = strpos($name, '.');
                $real_name = substr($name, 0, $i);
                if($request->photo_name_after == 'admission_number') {

                    $student = $this->student->findStudentbyAdmission($real_name);
                    //if it already exist, delete it.
                    if($student->user->photo != 'user.png') {
                        if($student->user->photo_by == 'admission_number') {

                            $is_photo = public_path("admission_number/{$student->user->photo}");
                            if (File::exists($is_photo)) @unlink($is_photo);
                        } else {

                            $is_photo = public_path("index_number/{$student->user->photo}");
                            if (File::exists($is_photo)) @unlink($is_photo);
                        }
                    }
                    //save db and store into folder

                    $student->user->update(['photo' => $name, 'photo_by' => 'admission_number']);
                    // $path = $file->storeAs('admission_number', $name);  //save store path for cpanel
                    $path = $file->move(public_path('/admission_number'),$name);  //save public path for developing
                } else if($request->photo_name_after == 'index_number') {

                    $student = $this->student->findStudent($real_name);
                    //if it already exist, delete it.
                    if($student->user->photo != 'user.png') {
                        if($student->user->photo_by == 'admission_number') {

                            $is_photo = public_path("admission_number/{$student->user->photo}");
                            if (File::exists($is_photo)) @unlink($is_photo);
                        } else {

                            $is_photo = public_path("index_number/{$student->user->photo}");
                            if (File::exists($is_photo)) @unlink($is_photo);
                        }
                    }

                    //save db and store into folder
                    $student->user->update(['photo' => $name, 'photo_by' => 'index_number']);
                    // $path = $file->storeAs('index_number', $name);  //save store path for cpanel
                    $path = $file->move(public_path('/index_number'),$name);  //save public path for developing
                }
            }
            return back()->with('flash_success', __('msg.store_ok'));
        }
        return back();
    }




    public function listByClass($class_id)
    {
        $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
        $data['students'] = $this->student->findStudentsByClass($class_id);
        $data['sections'] = $this->my_class->getClassSections($class_id);

        return is_null($mc) ? Qs::goWithDanger() : view('pages.support_team.students.list', $data);
    }

    public function graduated()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['students'] = $this->student->allGradStudents();

        return view('pages.support_team.students.graduated', $data);
    }

    public function not_graduated($sr_id)
    {
        $d['grad'] = 0;
        $d['grad_date'] = NULL;
        $d['session'] = Qs::getSetting('current_session');
        $this->student->updateRecord($sr_id, $d);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function show($studentId)
    {
        $d['this_user'] = $this->student->findStudent($studentId);
        return view('pages.support_team.students.show', $d);
    }

    public function edit($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['dorms'] = $this->student->getAllDorms();
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.edit', $data);
    }

    public function update(StudentRecordUpdate $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['id' => $sr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d['name'] = ucwords($req->name);

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($sr->user->id, $d); // Update User Details

        $srec = $req->only(Qs::getStudentData());

        $this->student->updateRecord($sr_id, $srec); // Update St Rec

        /*** If Class/Section is Changed in Same Year, Delete Marks/ExamRecord of Previous Class/Section ****/
        Mk::deleteOldRecord($sr->user->id, $srec['my_class_id']);

        return Qs::jsonUpdateOk();
    }

    public function destroy($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        if(!$st_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['user_id' => $st_id])->first();
        $path = Qs::getUploadPath('student').$sr->user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($sr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }

}
