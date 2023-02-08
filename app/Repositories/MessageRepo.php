<?php
namespace App\Repositories;
use App\Models\Message;
use App\User;
use Illuminate\Support\Facades\DB;
class MessageRepo{
    public function all(){
        return Message::orderBy('created_at', 'asc')->get();
    }
    public function findMessage($id){
        return Message::find($id);
    }
    public function getAllMessage1()
    {
        $bbb = array();
        $aaa = Message::orderBy('id', 'asc')->get();
        foreach($aaa as $val) {
            array_push($bbb, array(
                'id' => $val->id,
                'title'=>$val->subject,
                'name' => $val->sender->name,
                'user_id' => $val->sender_id,
                'type'=> $val->message_type,
                'recipients'=>count(explode(",", $val->receiver)),
                'delivered'=>count(explode(",", $val->receiver)),
                'failed'=>0,
                'credits'=>count(explode(",", $val->receiver)),
                'date'=>$val->created_at,
            ));
        }
        return $bbb;
    }
    public function findMessage1($message_id)
    {
        $bbb = array();
        $aaa = Message::find($message_id);
        // echo($aaa->message_type);
        array_push($bbb, array(
            'id' => $aaa->id,
            'subject'=>$aaa->subject,
            'content'=>$aaa->content,
            'sender' => $aaa->sender->name,
            'user_id' => $aaa->sender_id,
            'message_type'=> $aaa->message_type,
            'receiver_type'=>$this->getMessageType($aaa->receiver_type),
            'recipients'=>count(explode(",", $aaa->receiver)),
            'delivered'=>count(explode(",", $aaa->receiver)),
            'failed'=>0,
            'credits'=>2* count(explode(",", $aaa->receiver)),
            'date'=>$aaa->created_at
        ));
        return $bbb;
    }
    public function findMessage2($message_id)
    {
        $ccc = array();
        $aaa = Message::find($message_id);
        // echo($aaa->message_type);
        $bbb = array_map('trim',array_filter(explode(',',$aaa->receiver)));
        // print_r($ddd);

        $ccc = User::whereIn('phone',$bbb)->get();
        // $ccc = User::whereIn('phone',['+254203570095', '+254715223003', '+254729891801'])->get();
        // print_r($ccc);
        return $ccc;
    }

    public function getMessages($phone){
        $bbb = array();
        if(str_contains($phone, '+')){
            $phones = [$phone, "0".substr($phone, 4)];
            // $messages= DB::select( DB::raw("SELECT * FROM messages WHERE receiver in  $phones and state=0"));
            $messages= Message::whereIn('receiver',$phones)->where('state', 0)->get();
        }else{
            $phones = [$phone, "+254".substr($phone, 1)];
            $messages= Message::where('receiver',$phones)->where('state', 0)->get();
        }
        // $messages = Message::where(['receiver'=>$phone, 'state'=>0])->select('id', 'subject', 'state')->get();
        // $messages = [$phone, "0".substr($phone, 4, -1)];
        return $messages;
        // return $messages;
    }
    public function updateMessageState($id){
        return Message::find($id)->update(['state'=>1]);
    }
    public function updateMessageStateAll($phone){
        if(str_contains($phone, '+')){
            $phones = [$phone, "0".substr($phone, 4)];
            // $messages= DB::select( DB::raw("SELECT * FROM messages WHERE receiver in  $phones and state=0"));
            return Message::whereIn('receiver',$phones)->update(['state'=>1]);
        }else{
            $phones = [$phone, "+254".substr($phone, 1)];
            return Message::where('receiver',$phones)->update(['state'=>1]);
        }
    }
    private function getMessageType($message_type){
        $msg_types = '';
        switch ($message_type) {
            case "11":
                $msg_types = "All Students";
                break;
            case "12":
                $msg_types = "Specific Students";
                break;
            case "13":
                $msg_types = "Specific Classes";
                break;
            case "14":
                $msg_types = "Exam Results";
                break;
            case "21":
                $msg_types = "All Teachers";
                break;
            case 22:
                $msg_types = "Specific Teachers";
                break;
            case 23:
                $msg_types = "Teachers Groups";
                break;
            case 31:
                $msg_types = "All BOM/PA members";
                break;
            case 32:
                $msg_types = "Specific BOM/PA members";
                break;
            case 33:
                $msg_types = "BOM/PA Groups";
                break;
            case 41:
                $msg_types = "All Staff members";
                break;
            case 42:
                $msg_types = "Specific Staff members";
                break;
            case 43:
                $msg_types = "Staff Groups";
                break;

            case 51:
                $msg_types = "Alumni";
                break;
            case 61:
                $msg_types = "Other";
                break;
            default:
                # code...
                break;
        }
        return $msg_types;
    }
}
?>
