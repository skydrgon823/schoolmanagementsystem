<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sitecomment;

class SitecommentsController extends Controller
{
    public function store(Request $req)
    {
        $model = new Sitecomment;
        $model['user_id'] = Auth::user()->id;
        $model['content'] = $req->sitecomment;
        $model->save();        
        return json_encode(['ok' => true, 'msg' => "Sent comment Successfully"]);
        // dd($req);
        /*          
      "event_name" => "parent meeting"
      "event_participants" => "teacher"
      "specific_teacher" => "admins"
      "event_dates" => "event_single"
      "date" => "2022-07-21T17:19"
         */
        // //create my_class
        // $myclass = new MyClass;
        // $myclass['form_id'] = $req->form_id;
        // $myclass['stream'] = $req->stream;
        // $myclass->save();

        // //create class_subject
        // $last_id = MyClass::orderBy('id', 'DESC')->first();
        // $subject_list = json_decode($req['subject_list']);                

        // foreach($subject_list as $slist) {
        //     if($slist->check_status == true) {

        //         $classsubject = new ClassSubject;
        //         $classsubject['my_class_id'] = $last_id->id;
        //         $classsubject['subject_id'] = $slist->id;
        //         $classsubject->save();
        //     }
        // }
        // return Qs::jsonStoreOk();
    }
}
