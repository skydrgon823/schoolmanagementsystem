<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Helpers\Qs;
use App\Repositories\UserRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\TeacherRepo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\Message;
use App\Repositories\MessageRepo;
use App\Repositories\ExamRepo;
class HomeController extends Controller
{
    protected $user, $my_class, $teacher;
    public function __construct(UserRepo $user, MyClassRepo $my_class, TeacherRepo $teacher, MessageRepo $message_repo,ExamRepo $exam)
    {
        $this->user = $user;
        $this->my_class = $my_class;
        $this->teacher = $teacher;
        $this->message_repo = $message_repo;
        $this->exam = $exam;
        $this->AT= new AfricasTalking(env('TALKING_USERNAME'), env('TALKING_API_KEY'));
    }


    public function index()
    {
        return redirect()->route('dashboard');
    }
    public function getUser(Request $req){
        $email = $req->form_id;
        if(strpos($email, "@")==false){
            $email .="@bibirionihigh";
        }
        // echo $email;
        $code = $this->user->codeByUserEmail($email);
        // echo $code;
        // return json_encode(['msg'=>'fail']);
        if(count($code)===0){
            return json_encode(['msg'=>'fail']);
        }
        else{
            return json_encode(["code"=>substr($code[0]->phone, strlen($code[0]->phone)-3, strlen($code[0]->phone)), 'password'=>$code[0]->password, 'id'=>$code[0]->id,'ident'=>$code[0]->code, 'phone'=>$code[0]->phone, 'logo'=>$code[0]->school_logo, 'school_name'=>$code[0]->school_name]);
            // return json_encode(['msg'=>'success']);
        }

    }
    public function getForgotUser(Request $req){
        $phone = $req->phone;

        // echo $email;
        $code = $this->user->codeByUserPhone($phone);
        // echo $code;
        // return json_encode(['msg'=>$code]);

        if(count($code)===0){
            return json_encode(['msg'=>'There was a problem']);
        }
        else{
            $message = '';
            $total_email = '';
            try {
                // Thats it, hit send and we'll take care of the rest

                for ($i=0; $i < count($code); $i++) {
                    $total_email .=$code[$i]->email."\r\n";
                }

                $message = "The following Zeraki Analytics usernames are linked to " .$phone. ":\r\n".$total_email;
                // return json_encode(['msg'=>$message]);
                $sms = $this->AT->sms();
                $result = $sms->send([
                    'to'      =>$phone,
                    'message' => $message,
                    'from'    =>env('TALKING_USERNAME'),
                ]);

                // print_r($result);
                // return json_encode($result);
                return json_encode(["ok"=>'success',"msg"=>"Your username sent to your phone!","name"=>$phone, 'email'=>$total_email, 'result'=>$result]);
            } catch (Exception $e) {
                echo "Error: ".$e->getMessage();
                // return json_encode(["ok"=>'danger', 'msg'=>'There was a problem']);
            }
            // return json_encode(["ok"=>'success',"msg"=>"Your username sent to your phone!","name"=>$code[0]->name, 'email'=>$code[0]->email, 'id'=>$code[0]->id]);
            // return json_encode(['msg'=>'success']);
        }

    }
    public function sendCode(Request $req){
        $email = $req->form_id;
        // echo $email;
        // return json_encode(['email'=>$email]);
        $code = $this->user->codeByUserEmail($email);
        // $phone = $req->phone;
        // return json_encode(["phone"=>$code[0]->code, "code"=>$code[0]->phone, 'from'=>env('TALKING_USERNAME')]);
        $message = '';
        $model = new Message;
        $model['sender_id'] = Auth::user()->id;
        try {
            // Thats it, hit send and we'll take care of the rest
            // return json_encode($message);
            $message = $code[0]->code." is your Zeraki Analytics reset code";
            $sms = $this->AT->sms();
            $result = $sms->send([
                'to'      =>$code[0]->phone,
                'message' => $message,
                'from'    =>env('TALKING_USERNAME'),
            ]);
            $model['subject'] ="Password Reset";
            $model['message_type'] =1;
            $model['content'] =$message;
            $model['receiver'] = $code[0]->phone;
            $model['receiver_type'] = 71;
            $model->save();
            // print_r($result);
            // return json_encode($result);
            return json_encode(["msg"=>"success", 'to'=>$code[0]->phone, 'code'=>$message, 'from'=>env('TALKING_USERNAME'),
            'result'=>$result]);
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }


    }
    public function existPhone(Request $req){
        $phone =$req->phone;
        $email = $req->email;
        // echo $email;
        $existPhone = $this->user->existPhoneWithUnUser($phone, $email);
        // return json_encode($existPhone);
        // if(str_contains($phone, '+')){
        //     $phone = "0".substr($phone, 4, -1);
        // }else{
        //     $phone = "+254".substr($phone, 1, -1);
        // }
        return json_encode(['email'=>$email, 'phone'=>$existPhone]);
    }
    public function setPassword(Request $req){
        $id = $req->id;
        $password = $req->password;
        // echo $email;
        $data['password'] = Hash::make($password);
        $this->user->update($id, $data);

        return json_encode(['ok'=>'success', "msg"=>"Password successfully updated"]);
        // return json_encode(['email'=>$email, 'phone'=>$phone]);
    }
    public function passwordRequest(Request $req){
        $email = $req->email;
        $data['code'] = $this->user->generateRandomString();
        $data['password'] = '';
        $this->user->updatePassword($email, $data);
        return json_encode(['msg'=>'password successfully updated']);
    }
    public function contactRequest(Request $req){
        $data['name'] = $req->name;
        $data['email'] = $req->email;
        $data['phone'] = $req->phone;
        $data['message'] = $req->message;
        $this->user->createContactMessage($data);
        return json_encode(['ok' => true, 'msg'=>'Message successfully sent to support team']);
    }
    public function setAdmin(Request $req){
        $id = $req->form_id;
        // echo $email;
        $data['user_type_id'] = $req->user_type_id;
        $data['state'] = 1;
        $this->user->update($id, $data);
        return json_encode(['msg'=>'success', 'data'=>$data['user_type_id']]);
        // return json_encode(['type'=>$data['user_type_id']]);
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }
    // public function login(Request $req){
    //     return redirect()->route('dashboard');
    // }
    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }
    public function landing(){
        return view('pages.support_team.landing');
    }

    public function dashboard()
    {
        $d=[];
        // echo Auth::user()->id;
        // return;
        // if(Qs::userIsTeamSAT()){
        $d['users'] = $this->user->getAll();
        $d['stream'] = $this->my_class->all();
        $d['all_forms'] = $this->my_class->getAllForms();
        $d['teacher'] = optional($this->teacher->findTeacherbyUserID(Auth::user()->id));
        $d['class_subjects'] = $this->my_class->getClassSubjects($d['teacher']->id);
        $d['grade_subjects'] = $this->exam->getGradeRecord();
        $d['all_groups'] = $this->teacher->getAllGroup();
        $d['types'] = Qs::getUserType();
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $d['all_myclasses'] = $this->my_class->getAllMyClass();
        // }
        // // echo(Qs::getUserType());
        // print_r ($d['grade_subjects']);
        // return;
        return view('pages.support_team.dashboard', $d);
    }
    public function updateMessageState(Request $req){
        $this->message_repo->updateMessageState($req->messageID);
        return ['state'=>'success'];
    }
}
