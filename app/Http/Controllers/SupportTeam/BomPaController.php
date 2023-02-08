<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\BomPaRepo;
// use App\Repositories\TeacherRepo;
use App\Repositories\UserRepo;

// use App\Models\Teacher;
use App\Models\BomPaRecord;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;
class BomPaController extends Controller
{
    protected $bompa_repo, $user;
    public function __construct(BomPaRepo $bompa_repo, UserRepo $user, MessageRepo $message_repo)
    {
        // $this->middleware('teamSA', ['except' => ['destroy',] ]);
        // $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->bompa_repo = $bompa_repo;
        $this->user = $user;
        $this->message_repo = $message_repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $d['all_bompa'] = $this->bompa_repo->getAllBompas();
        $d['group'] = $this->bompa_repo->getAllGroup();
        $d['all_group'] = $this->bompa_repo->getAllGroup();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        $d['user'] =Auth::user();
        return view('pages.support_team.bompa.index', $d);
    }

    public function specificBomMembers(){
        $specific_bom_members = $this->bompa_repo->getAllBompa1();
        return json_encode($specific_bom_members);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.support_team.bompa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //

        $groups = "";
        if($req->group){
            foreach ($req->group as $key => $value) {
                $groups .= $value . ",";
            }
            $groups = rtrim($groups, ",");
        }
        // echo($groups);
        // return;
        $default_password = 'qwerQWER1234!@#$_teacher';
        $model = new User;

        $model['name'] = $req->full_name;
        $model['email'] = $req->email;
        $model['code'] = $this->user->generateRandomString();
        $model['user_type_id'] = 6;
        $model['phone'] = $req->phone_number;
        $model['tsc_no'] = $req->tsc_no;
        $model['gender'] = $req->gender;
        $model['national_id_no'] = $req->national_id_no;
        $model['photo'] = Qs::getDefaultUserImage();
        $model['password'] = Hash::make($default_password);
        if($this->user->getUserEmail($req->email))
            $model->save();
        else
            return back()->with('flash_warning', __('msg.exit_db'));
        $user = User::latest()->first();

        $model1 = new BomPaRecord;
        $model1['user_id'] = $user->id;
        $model1['group_id'] = $groups;//$req->group;
        $model1['code'] = $this->user->generateRandomString();
        $model1->save();
        return back()->with('flash_success', __('msg.store_ok'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $d['bompa'] = $this->bompa_repo->findBompa($id);
        $d['group'] = $this->bompa_repo->getAllGroup();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.bompa.edit', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $groups = "";
        if($req->group){
            foreach ($req->group as $key => $value) {
                $groups .= $value . ",";
            }
            $groups = rtrim($groups, ",");
        }
        // $groupname ="";
        // if($req->group){

        //     $groupforbompa = $req->group;
        //     $groupname = $this->bompa_repo->findGroup($groupforbompa)['name'];
        // }
        // if(stripos($groupname, 'bom')>0 || stripos($groupname, 'pa')>0 || stripos($groupname, 'bom/pa')>0){
        //     return back()->with('flash_danger', __('msg.no_changes'));
        // }else{
        $data['name'] = $req->full_name;
        $data['email'] = $req->email;
        $data['phone'] = $req->phone_number;
        $data['tsc_no'] = $req->tsc_no;
        $data['gender'] = $req->gender;
        $data['national_id_no'] = $req->national_id_no;
        $data['group'] = $groups;
        $this->bompa_repo->updateBompa($id, $data);


        $d['bompa'] = $this->bompa_repo->findBompa($id);
        $d['group'] = $groups;

        return back()->with('flash_success', __('msg.update_ok'));
        // }

    }
    public function Bompa_search(Request $req){
        return redirect('/bompa');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->bompa_repo->deleteBompa($id);
        return redirect('/bompa');
    }
}
