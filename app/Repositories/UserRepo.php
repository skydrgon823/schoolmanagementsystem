<?php

namespace App\Repositories;

use App\Models\BloodGroup;
use App\Models\StaffRecord;
use App\Models\UserType;
use App\Models\Contact;
use App\User;


class UserRepo {


    public function update($id, $data)
    {
        User::where('state', 1)->update(['state'=>0]);
        return User::find($id)->update($data);
    }
    public function updateZero(){
        return User::where('state', 1)->update(['state'=>0]);
    }
    public function updatePassword($email, $data){
        return User::where(['email'=>$email])->update($data);
    }
    public function delete($id)
    {
        return User::destroy($id);
    }
    public function createContactMessage($data){
        return Contact::create($data);
    }
    public function create($data)
    {
        return User::create($data);
    }

    public function getUserByType($type)
    {
        return User::where(['user_type' => $type])->orderBy('name', 'asc')->get();
    }
    public function getUsersByPhone($phones){
        return User::whereIn('phone', $phones)->orderBy('name', 'asc')->get();
    }
    public function getUsersByID($ids){
        // print_r($ids);
        // echo User::whereIn('id', $ids)->orderBy('name', 'asc')->get();
        return User::whereIn('id', $ids)->orderBy('name', 'asc')->get();
    }
    public function getUserEmail($email){
        if(strpos($email, '@')>0){
            $user= User::where('email','=',$email)->first();
        }else{
            $user= User::where('name','=',$email)->first();
        }
        if($user===null){
            return true;
        }
        return false;
    }
    public function existPhoneWithUnUser($phone, $email){
        if(strpos($email, '@')>0){
            if(str_contains($phone, '+')){
                $user= User::where('phone',$phone)->orWhere('phone', "0".substr($phone, 4, -1))->where('email','=',$email)->first();
            }else{
                $user= User::where('phone',$phone)->orWhere('phone', "+254".substr($phone, 1, -1))->where('email','=',$email)->first();
            }

        }else{
            if(str_contains($phone, '+')){
                $user= User::where('phone',$phone)->orWhere('phone', "0".substr($phone, 4, -1))->where('name','=',$email)->first();
            }else{
                $user= User::where('phone',$phone)->orWhere('phone', "+254".substr($phone, 1, -1))->where('name','=',$email)->first();
            }
        }
        if($user===null){
            return false;
        }
        return true;
    }
    public function codeByUserEmail($email){
        if(strpos($email, '@')>0){
            $user= User::select('phone', 'password', 'id', 'code', 'school_logo', 'school_name')->where('email','=',$email)->get();
        }else{
            $user= User::select('phone', 'password', 'id', 'code', 'school_logo', 'school_name')->where('name','=',$email)->get();
        }

        return $user;
    }
    public function codeByUserPhone($phone){
        if(str_contains($phone, '+')){
            $user= User::select('name', 'email', 'id', 'code')->where('phone',$phone)->orWhere('phone', "0".substr($phone, 4, -1))->get();
        }else{
            $user= User::select('name', 'email', 'id', 'code')->where('phone',$phone)->orWhere('phone', "+254".substr($phone, 1, -1))->get();
        }
        return $user;
    }
    public function getAllTypes()
    {
        return UserType::all();
    }

    public function findType($id)
    {
        return UserType::find($id);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function getAll()
    {
        return User::orderBy('name', 'asc')->get();
    }

    public function getPTAUsers()
    {
        return User::where('user_type_id', '<>', 4)->orderBy('name', 'asc')->get();
    }

    /********** STAFF RECORD ********/
    public function createStaffRecord($data)
    {
        return StaffRecord::create($data);
    }

    public function updateStaffRecord($where, $data)
    {
        return StaffRecord::where($where)->update($data);
    }

    /********** BLOOD GROUPS ********/
    public function getBloodGroups()
    {
        return BloodGroup::orderBy('name')->get();
    }


    public function generateRandomString($length = 5)
    {
        $characters = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
