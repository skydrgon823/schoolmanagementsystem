<?php

namespace App\Http\Controllers\SupportTeam;
use Illuminate\Http\Request;
use App\Helpers\Qs;
use App\Http\Requests\Subject\SubjectCreate;
use App\Http\Requests\Subject\SubjectUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $d['my_classes'] = $this->my_class->all();
        $d['teachers'] = $this->user->getUserByType('teacher');
        $d['subjects'] = $this->my_class->getAllSubjects();
        $this->user->updateZero();
        return view('pages.support_team.subjects.index', $d);
    }

    public function store(SubjectCreate $req)
    {
        $data = $req->all();
        $this->my_class->createSubject($data);

        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $d['s'] = $sub = $this->my_class->findSubject($id);
        $d['my_classes'] = $this->my_class->all();
        $d['teachers'] = $this->user->getUserByType('teacher');

        return is_null($sub) ? Qs::goWithDanger('subjects.index') : view('pages.support_team.subjects.edit', $d);
    }

    public function update(SubjectUpdate $req, $id)
    {
        $data = $req->all();
        $this->my_class->updateSubject($id, $data);

        return Qs::jsonUpdateOk();
    }
    public function update_subject(Request $req){
        $data['id'] = $req->id;
        $data['out_x'] = $req->out_x;
        $data['out_y'] = $req->out_y;
        $data['out_z'] = $req->out_z;
        $data['con_x'] = $req->con_x;
        $data['con_y'] = $req->con_y;
        $data['con_z'] = $req->con_z;
        $this->my_class->updateSubjectRatio($req->id, $data);
        // return Qs::jsonUpdateOk();
        return json_encode(['ok' => true, 'msg' => "Updated Successfully", 'data'=>$data]);
    }
    public function update_paper(Request $req){
        $data['id'] = $req->id;
        $data['status_x'] = $req->status_x=="true"?1:0;
        $data['status_y'] = $req->status_y=="true"?1:0;
        $data['status_z'] = $req->status_z=="true"?1:0;
        $this->my_class->updatePaperRatio($req->id, $data);
        // return Qs::jsonUpdateOk();
        return json_encode(['ok' => true, 'msg' => "Papers successfully modified", 'data'=>$data]);
    }
    public function destroy($id)
    {
        $this->my_class->deleteSubject($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }
}
