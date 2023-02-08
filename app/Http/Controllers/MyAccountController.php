<?php

namespace App\Http\Controllers;


use App\Helpers\Qs;
use App\Http\Requests\UserChangePass;
use App\Http\Requests\UserUpdate;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use AfricasTalking\SDK\AfricasTalking;
use App\Repositories\TeacherRepo;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Repositories\MessageRepo;
class MyAccountController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user, TeacherRepo $teacher_repo, MessageRepo $message_repo)
    {
        $this->user = $user;
        $this->teacher_repo = $teacher_repo;
        $this->message_repo = $message_repo;
        $this->AT= new AfricasTalking(env('TALKING_USERNAME'), env('TALKING_API_KEY'));
    }
    public function show_pass(){
        $d['my'] = Auth::user();
        // echo $d['my'];
        $email = $d['my']->email;
        $code = $this->user->codeByUserEmail($email);
        // $phone = $req->phone;
        // return json_encode(["phone"=>$code[0]->code, "code"=>$code[0]->phone, 'from'=>env('TALKING_USERNAME')]);
        $message = '';
        $d['code'] = $code[0]->code;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        try {
            // Thats it, hit send and we'll take care of the rest
            // return json_encode($message);
            $message = $code[0]->code." is your Zeraki Password reset code";
            $sms = $this->AT->sms();
            $result = $sms->send([
                'to'      =>$code[0]->phone,
                'message' => $message,
                'from'    =>env('TALKING_USERNAME'),
            ]);

            // print_r($result);
            // return json_encode($result);
            return view('pages.support_team.my_pass', $d);
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        return view('pages.support_team.my_pass', $d);
    }
    public function edit_profile()
    {
        $d['my'] = Auth::user();
        $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        return view('pages.support_team.my_account', $d);
    }
    public function show_pass_reset()
    {
        // $d['my'] = Auth::user();
        // $d['all_teachers'] = $this->teacher_repo->getAllTeachers();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.my_pass_reset', $d);
    }

    public function update_profile(Request $req)
    {
        $user = Auth::user();
        $data['school_name'] = strtoupper($req->name);
        $data['school_short_name'] = strtoupper($req->short_name);
        $data['school_phone'] = $req->phone;
        $data['school_email'] = $req->email;
        $data['school_head_id'] = $req->head_id;
        $data['school_title_id'] = $req->title_id;
        $data['school_hod_id'] = $req->hod_id;
        $data['school_postal'] = $req->postal;
        $data['school_gender_id'] = $req->gender_id;
        $data['school_status_id'] = $req->status_id;
        $data['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // if(!$user->username && !$req->username && !$req->email){
        //     return back()->with('pop_error', __('msg.user_invalid'));
        // }

        // $user_type = $user->user_type;
        // $code = $user->code;

        if($req->hasFile('school_photo')) {
            $photo = $req->file('school_photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $user->id."." . $f['ext'];
            $f['path'] = $photo->storeAs("school_number/", $f['name']);
            $data['school_logo'] = $f['name'];
        }

        $this->user->update($user->id, $data);
        $this->user->updateZero();
        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function change_pass(UserChangePass $req)
    {
        $user_id = Auth::user()->id;
        $my_pass = Auth::user()->password;
        $my_code = Auth::user()->code;
        $old_pass = $req->current_password;
        $new_pass = $req->password;
        $reset_code = $req->reset_code;
        if(strcmp($reset_code, $my_code) == 0){
            $data['password'] = Hash::make($new_pass);
            $this->user->update($user_id, $data);
            // return back()->with(['flash_success'=> __('msg.p_reset'), 'messages'=>$this->message_repo->getMessages(Auth::user()->phone)]);
            $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
            echo $d['messages'];
            return;
            // return view('pages.support_team.my_pass', $d);
        }

        // return back()->with(['flash_danger'=> __('msg.p_reset_fail'), 'messages'=>$this->message_repo->getMessages(Auth::user()->phone)]);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        return view('pages.support_team.my_pass', $d);
    }

}
