<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Qs;
use App\Models\Message;
use App\Repositories\MessageRepo;
use App\Repositories\UserRepo;
use App\Repositories\TeacherRepo;
use App\Repositories\BomPaRepo;
use App\Repositories\StaffRepo;
use App\Repositories\StudentRepo;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;
class MessagesController extends Controller
{
    protected $message_repo;
    // private $username = "ALVINCY";
    // private $apiKey  = "f1064bcd73ba9182fee7aacb7708b893a5276ee3716cbd05b1a7bb94b79274ea";

    public function __construct(MessageRepo $message_repo, UserRepo $user, TeacherRepo $teacher_repo, BomPaRepo $bompa_repo, StaffRepo $staff_repo, StudentRepo $student) {
        // $this->middleware('teamSA', ['except' => ['destroy',] ]);
        // $this->middleware('super_admin', ['only' => ['destroy',] ]);
        $this->message_repo = $message_repo;
        $this->AT= new AfricasTalking(env('TALKING_USERNAME'), env('TALKING_API_KEY'));
        $this->to = "+254203570095,+254729891801,+254715223003";
        $this->message = "Test communication";
        $this->from = env('TALKING_USERNAME');
        $this->user = $user;
        $this->teacher_repo = $teacher_repo;
        $this->bompa_repo = $bompa_repo;
        $this->staff_repo = $staff_repo;
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $application = $this->AT->application();
        try {
            // Fetch the application data
            $data = $application->fetchApplicationData();
            // echo(explode(" ", $data['data']->UserData->balance)[1]);
            $d['balance'] = explode(" ", $data['data']->UserData->balance)[1];
        } catch(Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        $d['all_messages'] = $this->message_repo->all();
        $d['sms_messages'] = $this->message_repo->getAllMessage1();
        $d['types'] = Qs::getUserType();
        $sum=0;
        foreach ($d['sms_messages'] as $key => $d['sms_message']) {
            $sum += $d['sms_message']['credits'];
        }
        $d['balance']-=$sum;
        // print_r($d['messages']);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        $this->user->updateZero();
        return view('pages.support_team.messages.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function send($phone){
        try {
            // Thats it, hit send and we'll take care of the rest
            $sms = $this->AT->sms();
            $result = $sms->send([
                'to'      => $phone,
                'message' => $this->message,
                'from'    => $this->from
            ]);

            // print_r($result);
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }

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
        // $name = $req->phonenumber; //here name is the name of your form's name[] field
        // foreach ($name as $key => $value) {
        //     echo $value;
        // }
        // return;
        $model = new Message;
        $model['sender_id'] = Auth::user()->id;
        $calls = '';
        $ids = [];
        // foreach ($_POST['message_type_category'] as $selectedOption)
        //     echo $selectedOption."\n";
        // print_r($req->phonenumber);
        switch ($req->receiver_type) {
            case 'Students':
                if ($req->Specific_Students_Message) {
                    $model['receiver_type'] =12;
                } else if($req->Specific_Classes_Message) {
                    $model['receiver_type'] =13;
                }else if($req->Exam_Results_Message) {
                    $model['receiver_type'] =14;
                }else{
                    $model['receiver_type'] =11;
                    $students = $this->student->getAllStudents();
                    $phones = '';
                    foreach ($students as $key => $student) {
                        if($student->user->phone){
                            // echo $this->validating(substr($student->user->phone, 1, strlen($student->user->phone)));
                            // echo $this->validating($student->user->phone);
                            if($this->validating($student->user->phone))
                                    $calls .= $this->validating($student->user->phone) . ",";
                            $phones .= $student->user->phone . ",";
                        }

                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;
                }
                // return;
                break;
            case 'Teachers':
                if ($req->Specific_Teachers_Message) {
                    foreach ($_POST['message_type_category'] as $selectedOption)
                        array_push($ids, $selectedOption);
                    // print_r($ids);
                    $model['receiver_type'] =22;
                    $phones = '';
                    // $userforphone = $this->user->find($req->message_type_category);
                    $userforphones = $this->user->getUsersByID($ids);
                    // print_r($userforphones);
                    foreach ($userforphones as $key => $userforphone) {
                        if($userforphone->phone){
                            if($this->validating($userforphone->phone))
                                $calls .= $userforphone->phone . ",";
                            $phones .= $userforphone->phone . ",";
                        }
                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                } else if($req->Teachers_Groups_Message) {
                    $model['receiver_type'] =23;
                    $groupforphones = $this->teacher_repo->findTeacherGroup($req->message_type_category);
                    $phones = '';
                    foreach ($groupforphones as $key => $groupforphone) {
                        if($groupforphone->user->phone){
                            if($this->validating($groupforphone->user->phone))
                                $calls .= $groupforphone->user->phone . ",";
                            $phones .= $groupforphone->user->phone . ",";
                        }

                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                }else{
                    $model['receiver_type'] =21;
                    $teahcers = $this->teacher_repo->getAllTeachers();
                    $phones = '';
                    foreach ($teahcers as $key => $teacher) {
                        if($teacher->user->phone ){
                            if($this->validating($teacher->user->phone))
                                $calls .= $teacher->user->phone . ",";
                            $phones .= $teacher->user->phone . ",";
                        }
                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                }
                break;
            case 'BOM/PA':

                if ($req->Specific_BOM_Message) {
                    foreach ($_POST['message_type_category'] as $selectedOption)
                        array_push($ids, $selectedOption);
                    $model['receiver_type'] =32;
                    $phones = '';
                    $userforphones = $this->user->getUsersByID($ids);
                    foreach ($userforphones as $key => $userforphone) {
                        if($userforphone->phone )
                        {
                            if($this->validating($userforphone->phone))
                                $calls .= $userforphone->phone . ",";
                            $phones .= $userforphone->phone . ",";
                        }
                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                } else if($req->BOM_Groups_Message){
                    $model['receiver_type'] =33;
                    $groupforphones = $this->bompa_repo->findBompaGroup($req->message_type_category);
                    $phones = '';
                    foreach ($groupforphones as $key => $groupforphone) {
                        if($groupforphone->user->phone)
                        {
                            if($this->validating($groupforphone->user->phone))
                                $calls .= $groupforphone->user->phone . ",";
                            $phones .= $groupforphone->user->phone . ",";
                        }

                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                }else{
                    $model['receiver_type'] =31;
                    $bompas = $this->bompa_repo->getAllBompas();
                    $phones = '';
                    foreach ($bompas as $key => $bompa) {
                        if($bompa->user->phone)
                        {
                            if($this->validating($bompa->user->phone))
                                $calls .= $bompa->user->phone . ",";
                            $phones .= $bompa->user->phone . ",";
                        }

                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                }
                // echo $calls;
                break;
            case 'Staff':

                if ($req->Specific_Staff_Message) {
                    foreach ($_POST['message_type_category'] as $selectedOption)
                            array_push($ids, $selectedOption);
                    $model['receiver_type'] =42;
                    $phones = '';
                    $userforphones = $this->user->getUsersByID($ids);
                    foreach ($userforphones as $key => $userforphone) {
                        if($userforphone->phone)
                        {
                            if($this->validating($userforphone->phone))
                                $calls .= $userforphone->phone . ",";
                            $phones .= $userforphone->phone . ",";
                        }
                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;


                } else if($req->Staff_Groups_Message){
                    $model['receiver_type'] =43;
                    $groupforphones = $this->staff_repo->findStaffGroup($req->message_type_category);
                    $phones = '';
                    foreach ($groupforphones as $key => $groupforphone) {
                        if($groupforphone->user->phone){
                            if($this->validating($groupforphone->user->phone))
                                $calls .= $groupforphone->user->phone . ",";
                            $phones .= $groupforphone->user->phone . ",";
                        }
                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                }else{
                    $model['receiver_type'] =41;
                    $staffs = $this->staff_repo->getAllStuffs();
                    $phones = '';
                    foreach ($staffs as $key => $staff) {
                        if($staff->user->phone){
                            if($this->validating($staff->user->phone))
                                $calls .= $staff->user->phone . ",";
                            $phones .= $staff->user->phone . ",";
                        }

                    }
                    $phones = rtrim($phones, ",");
                    $calls = rtrim($calls, ",");
                    if($phones)
                        $model['receiver'] = $phones;

                }
                break;
            case 'Alumni':
                $model['receiver_type'] =51;
                // $model['receiver'] =$req->alumni_category;
                $model['receiver'] = $this->to;
                break;
            case 'Other':
                $arrphones = $req->phonenumber;
                $phones = '';
                foreach ($arrphones as $key => $phone) {
                    if($phone){
                        if($this->validating($phone))
                            $calls .= $this->validating($phone).",";
                        $phones .= $phone . ".";
                    }
                }
                $phones = rtrim($phones, ",");
                $calls = rtrim($calls, ",");
                if($phones)
                    $model['receiver'] = $phones;
                $model['receiver_type'] =61;

                break;

            default:
                break;
        }

        $model['subject'] =$req->message_subject;
        $model['message_type'] =$req->message_category;
        $model['content'] =$req->message_content;
        // echo($calls." ".$req->message_content." ".$this->from);
        // echo($model['subject']." ".$model['message_type']." ".$model['content']);
        try {
            // Thats it, hit send and we'll take care of the rest
            $sms = $this->AT->sms();
            $result = $sms->send([
                'to'      => $calls,
                'message' => $req->message_content,
                'from'    => $this->from
            ]);
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        // echo $calls;
        if($model['receiver']){
            $model->save();
            return back()->with('flash_success', __('msg.store_ok'));
        }else{
            return back()->with('flash_warning', __('msg.no_changes'));
        }




    }

    function validating($phone){
        // if(preg_match('/^[0-9]{10}+$/', $phone)) {
        //     echo "Valid Phone Number";
        //     return true;
        // } else {
        //     echo "Invalid Phone Number";
        //     return false;
        // }
        $valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        return $valid_number;
    }
    public function updateMessageAll(){
        $application = $this->AT->application();
        try {
            // Fetch the application data
            $data = $application->fetchApplicationData();
            // echo(explode(" ", $data['data']->UserData->balance)[1]);
            $d['balance'] = explode(" ", $data['data']->UserData->balance)[1];
        } catch(Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        $d['all_messages'] = $this->message_repo->all();
        $d['sms_messages'] = $this->message_repo->getAllMessage1();
        $d['types'] = Qs::getUserType();
        $sum=0;
        foreach ($d['sms_messages'] as $key => $d['sms_message']) {
            $sum += $d['sms_message']['credits'];
        }
        $d['balance']-=$sum;
        // print_r($d['messages']);
        $receiver = $this->user->find(Auth::user()->id);
        // echo $receiver['phone'];
        // return;
        $this->message_repo->updateMessageStateAll($receiver['phone']);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.messages.index', $d);
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
        $d['selected'] = true;
        $d['message'] = $this->message_repo->findMessage($id);
        $this->message_repo->updateMessageState($id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.messages.show', $d);
    }
    public function buy(){
        $application = $this->AT->application();
        try {
            // Fetch the application data
            $data = $application->fetchApplicationData();
            // echo(explode(" ", $data['data']->UserData->balance)[1]);
            $d['balance'] = explode(" ", $data['data']->UserData->balance)[1];
        } catch(Exception $e) {
            echo "Error: ".$e->getMessage();
        }
        // $d['messages'] = $this->message_repo->all();
        $d['sms_messages'] = $this->message_repo->getAllMessage1();
        $sum=0;
        foreach ($d['sms_messages'] as $key => $d['sms_message']) {
            $sum += $d['sms_message']['credits'];
        }
        $d['balance']-=0.8*$sum;
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.messages.buy', $d);
    }
    public function receipt($receipt_id){
        // $d['message'] = $this->message_repo->findMessage1($receipt_id);
        // $d['phones'] = $this->message_repo->findMessage2($receipt_id);
        return view('pages.support_team.messages.receipt');
    }
    public function msggroup($message_id)
    {
        //
        $d['message'] = $this->message_repo->findMessage1($message_id);
        $d['phones'] = $this->message_repo->findMessage2($message_id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        // print_r($d['phones']);
        return view('pages.support_team.messages.msggroup', $d);
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
        $d['message'] = $this->message_repo->findMessage($id);
        $d['messages'] = $this->message_repo->getMessages(Auth::user()->phone);
        return view('pages.support_team.messages.index', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
