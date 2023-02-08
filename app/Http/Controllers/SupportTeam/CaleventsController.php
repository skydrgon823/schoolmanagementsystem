<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calevent;

use App\Repositories\MyClassRepo;
use App\Repositories\TeacherRepo;
use App\Helpers\Qs;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;
class CaleventsController extends Controller
{
    protected $my_class, $teacher;

    public function __construct(MyClassRepo $my_class, TeacherRepo $teacher, UserRepo $user, MessageRepo $message_repo)
    {
        $this->my_class = $my_class;
        $this->teacher = $teacher;
        $this->user = $user;
        $this->message_repo = $message_repo;
    }
    public function index(){
        $d=[];
        // if(Qs::userIsTeamSAT()){
        $d['users'] = $this->user->getAll();
        $d['stream'] = $this->my_class->all();
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['class_subjects'] = $this->my_class->getClassSubjects(Auth::user()->id);
        $d['all_groups'] = $this->teacher->getAllGroup();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        // }
        return view('pages.support_team.calevents.index', $d);
    }
    public function store(Request $req)
    {
        if(Calevent::where('name', $req->event_name)->first()) {
            return json_encode(['ok' => false, 'msg' => "Already Exist that name event"]);
        }

        $model = new Calevent;
        if($req->event_participants == 'teacher')  {

            $model['name'] = $req->event_name;
            $model['participants'] = $req->event_participants;
            $model['specific_teacher'] = $req->specific_teacher;

        } else if($req->event_participants == 'parent')  {

            $model['name'] = $req->event_name;
            $model['participants'] = $req->event_participants;
            $model['specific_form'] = $req->specific_form;

        }

        if($req->date_type == 'single') {

            $model['date_type'] = $req->date_type;
            $model['event_date'] = $req->event_date;
        } else if($req->date_type == 'range') {
            if($req->start_date > $req->end_date) {
                return json_encode(['ok' => false, 'msg' => "Not correct date range"]);
            } else {
                $model['date_type'] = $req->date_type;
                $model['start_date'] = $req->start_date;
                $model['end_date'] = $req->end_date;
            }
        }
        $model->save();
        return json_encode(['ok' => true, 'msg' => "Created Successfully"]);
    }

    public function getCalevent(Request $req) {
        $all_calevents = Calevent::get();
        return json_encode(['all_calevents' => $all_calevents]);
    }

    public function findCalevent(Request $req) {
        $calevent = Calevent::where('name', $req->calevent_name)->first();

        $data_arr =([
            'id' => $calevent->id,
            'name' => $calevent->name,
            'participants' => $calevent->participants,
            'specific_teacher' => $this->findTeacherGroup($calevent->specific_teacher),
            'specific_form' => $this->findForm($calevent->specific_form),
            'date_type' => $calevent->date_type,
            'event_date' => $calevent->event_date,
            'start_date' => $calevent->start_date,
            'end_date' => $calevent->end_date,
        ]);

        return json_encode(['ok' => true, 'calevent' => $data_arr]);
    }

    public function findTeacherGroup($id) {
        if($id != null) {
            return $this->teacher->findGroup($id)->name;
        }
        return null;
    }

    public function findForm($id) {
        if($id != null) {
            return $this->my_class->findForm($id)->name;
        }
        return null;
    }

    public function updateCalevent(Request $req) {

        if(Calevent::where('name', $req->event_name)->first()) {

            if($req->event_participants == 'teacher')  {

                $model['name'] = $req->event_name;
                $model['participants'] = $req->event_participants;
                $model['specific_teacher'] = $req->specific_teacher;

            } else if($req->event_participants == 'parent')  {

                $model['name'] = $req->event_name;
                $model['participants'] = $req->event_participants;
                $model['specific_form'] = $req->specific_form;

            }

            if($req->date_type == 'single') {

                $model['date_type'] = $req->date_type;
                $model['event_date'] = $req->event_date;
            } else if($req->date_type == 'range') {
                if($req->start_date > $req->end_date) {
                    return json_encode(['ok' => false, 'msg' => "Not correct date range"]);
                } else {
                    $model['date_type'] = $req->date_type;
                    $model['start_date'] = $req->start_date;
                    $model['end_date'] = $req->end_date;
                }
            }
            if(Calevent::where('name', $req->event_name)->update($model)) return json_encode(['ok' => true, 'msg' => "Updated Successfully"]);
            else return json_encode(['ok' => true, 'msg' => "An error occured in updating in controller"]);
        } else {
            return json_encode(['ok' => false, 'msg' => "There isn't this event anymore"]);
        }
    }

    public function deleteCalevent(Request $req) {
        Calevent::where('name', $req->event_name)->delete();
        return json_encode(['ok' => true, 'msg' => "Deleted Successfully"]);
    }
}
