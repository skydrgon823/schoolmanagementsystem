<?php

namespace App\Repositories;

use App\Models\Teacher;
use App\Models\StaffRecord;
use App\Models\Section;
use App\Models\ClassSubject;
use App\Models\Group;
use App\Models\Form;
use App\Models\SubjectTeacher;
use App\Models\MyClass;
use App\User;

class StaffRepo
{
    /************* Stuff *******************/
        public function getAllStuffs() {
            return StaffRecord::orderBy('id', 'asc')->get();
        }
        public function getAllStuff1()
        {
            $bbb = array();
            $aaa = StaffRecord::orderBy('id', 'asc')->get();
            foreach($aaa as $val) {
                array_push($bbb, array(
                    'id' => $val->user_id,
                    'name' => $val->user->name,
                    'user_id' => $val->user_id,
                ));
            }
            return $bbb;
        }
        public function getAllStaff2(){
            $bbb = array();
            $aaa = StaffRecord::select('group_id')->groupBy('group_id')->get();
            foreach ($aaa as $val) {
                array_push($bbb, array(
                    'id'=>$val->group_id,
                    'name'=>$val->group->name,
                ));
            }
            return $bbb;
        }
        public function findStaff($id) {
            return StaffRecord::find($id);
        }
        public function findStaffGroup($group_id){
            return StaffRecord::where('group_id', $group_id)->get();
        }
        public function updateStaff($id, $data) {
            StaffRecord::where('id', $id)->update(['group_id'=>$data['group']]);
            return StaffRecord::find($id)->user->update($data);
        }

    /************* Group *******************/
        public function getAllGroup() {
            return Group::get();
        }

        public function updateGroupName($id, $data) {
            return Group::where('id', $id)->update(['name' => $data]);
        }

        public function deleteGroup($id) {
            Teacher::where('group_id', $id)->update(['group_id' => 0]);
            return Group::where('id', $id)->delete();
        }

        public function addGroup($name) {
            return Group::create([
                'name' => $name,
            ]);
        }

        public function findGroup($id) {
            return Group::find($id);
        }

        public function deleteStaff($id) {
            return StaffRecord::where('id', $id)->delete();
        }
}
