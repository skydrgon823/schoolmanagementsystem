<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\StaffRepo;
// use App\Repositories\TeacherRepo;
use App\Repositories\UserRepo;

// use App\Models\Teacher;
use App\Models\StaffRecord;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Repositories\MessageRepo;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $staff_repo, $user;
    public function __construct(StaffRepo $staff_repo, UserRepo $user, MessageRepo $message_repo)
    {
        // $this->middleware('teamSA', ['except' => ['destroy',] ]);
        // $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->staff_repo = $staff_repo;
        $this->user = $user;
        $this->message_repo = $message_repo;
    }
    public function index()
    {
        //
        $d['all_staffs'] = $this->staff_repo->getAllStuffs();
        $d['group'] = $this->staff_repo->getAllGroup();
        $d['all_group'] = $this->staff_repo->getAllGroup();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $d['user'] =Auth::user();
        $this->user->updateZero();
        return view('pages.support_team.staffs.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.support_team.staffs.create');
    }


    public function specificStaffMembers(){
        $specific_staff_members = $this->staff_repo->getAllStuff1();
        return json_encode($specific_staff_members);
    }
    public function groupStaffs(){
        // $group_staff_members = $this->staff_repo->getAllGroup();
        $group_staff_members = $this->staff_repo->getAllStaff2();
        return json_encode($group_staff_members);
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
        $default_password = 'qwerQWER1234!@#$_teacher';
        $model = new User;
        $model['name'] = $req->full_name;
        $model['email'] = $req->email;
        $model['code'] = $this->user->generateRandomString();
        $model['user_type_id'] = 1;
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
        $model->save();
        $user = User::latest()->first();

        $model1 = new StaffRecord;
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
        $d['staff'] = $this->staff_repo->findStaff($id);
        $d['group'] = $this->staff_repo->getAllGroup();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.staffs.edit', $d);

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
        $groups = "";
        if($req->group){
            foreach ($req->group as $key => $value) {
                $groups .= $value . ",";
            }
            $groups = rtrim($groups, ",");
        }
        //
        $data['name'] = $req->full_name;
        $data['email'] = $req->email;
        $data['phone'] = $req->phone_number;
        $data['tsc_no'] = $req->tsc_no;
        $data['gender'] = $req->gender;
        $data['user_type_id'] = 1;
        $data['national_id_no'] = $req->national_id_no;
        $data['group'] = $groups;
        $this->staff_repo->updateStaff($id, $data);


        $d['staff'] = $this->staff_repo->findStaff($id);
        $d['group'] = $groups;
        // $d['group'] = $this->staff_repo->getAllGroup();

        // return back()->with('flash_success', __('msg.update_ok'));
        return redirect('/staffs')->with('flash_success', "Details updated successfully!");
    }
    public function staff_search(Request $req){
        return redirect('/staffs');
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
        $this->staff_repo->deleteStaff($id);
        return redirect('/staffs');
    }
}
