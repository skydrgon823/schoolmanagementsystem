<?php

namespace App\Repositories;

use App\Helpers\Qs;
use App\Models\Dorm;
use App\Models\Student;
use App\Models\Promotion;
use App\Models\MyClass;
use App\Models\StudentSubject;
use App\Models\Residence;
use App\User;

class StudentRepo {


    public function findStudentsByClass($class_id)
    {
        return $this->activeStudents()->where(['my_class_id' => $class_id])->with(['my_class', 'user'])->get()->sortBy('user.name');
    }
    public function findStudentsByClass1($class_id)
    {
        return Student::where('my_class_id', $class_id)->get();
    }
    public function getAllStudents() {
        return Student::orderBy('id', 'asc')->get();
    }
    public function activeStudents()
    {
        return Student::where(['grad' => 0]);
    }

    public function gradStudents()
    {
        return StudentRecord::where(['grad' => 1])->orderByDesc('grad_date');
    }

    public function allGradStudents()
    {
        return $this->gradStudents()->with(['my_class', 'section', 'user'])->get()->sortBy('user.name');
    }

    public function findStudentsBySection($sec_id)
    {
        return $this->activeStudents()->where('section_id', $sec_id)->with(['user', 'my_class'])->get();
    }

        public function createStudent($data)
        {
            return Student::create($data);
        }

        public function searchStudent($type, $data, $data2 = 'default') {
            if($data != null) {
                switch ($type) {
                    case 'std_adm_num':
                        {
                            $students = Student::where('adm_no', $data)->get();
                            $std_res = array();
                            foreach($students as $val) {
                                $myclass = MyClass::find($val->my_class_id);
                                array_push($std_res, array(
                                    'id' => $val->id,
                                    'name' => User::find($val->user_id)->name,
                                    'adm_no' => $val->adm_no,
                                    'classname' => ($myclass->form_id." ".$myclass->stream),
                                ));
                            }
                        }
                        break;
                    case 'std_name':
                        {
                            $std_res = array();
                            $cids = MyClass::where('form_id', $data2)->get();

                            $ar = array();
                            foreach ($cids as $val) {
                                array_push($ar, $val->id);
                            }
                            $buff = Student::whereIn('my_class_id', $ar)->get();
                            foreach ($buff as $val) {

                                $user = User::where('id', $val->user_id)->first();

                                $myclass = MyClass::find($val->my_class_id);

                                if($data == $user->name) {
                                    array_push($std_res, array(
                                        'id' => $val->id,
                                        'name' => $user->name,
                                        'adm_no' => $val->adm_no,
                                        'classname' => ($myclass->form_id." ".$myclass->stream),
                                    ));
                                }
                            }
                        }
                        break;
                    case 'std_phone_num':
                        {
                            $std_res = array();
                            $all_students = Student::get();
                            foreach ($all_students as $val) {

                                $user = User::where('id', $val->user_id)->first();
                                $myclass = MyClass::find($val->my_class_id);
                                if($data == $user->name) {
                                    array_push($std_res, array(
                                        'id' => $val->id,
                                        'name' => $user->name,
                                        'adm_no' => $val->adm_no,
                                        'classname' => ($myclass->form_id." ".$myclass->stream),
                                    ));
                                }
                            }
                        }
                        break;
                    case 'std_upi':
                        {
                            $students = Student::where('upi', $data)->get();
                            $std_res = array();
                            foreach($students as $val) {
                                $myclass = MyClass::find($val->my_class_id);
                                array_push($std_res, array(
                                    'id' => $val->id,
                                    'name' => User::find($val->user_id)->name,
                                    'adm_no' => $val->adm_no,
                                    'classname' => ($myclass->form_id." ".$myclass->stream),
                                ));
                            }
                        }
                        break;
                    case 'std_index_num':
                        {
                            $students = Student::where('id', $data)->get();
                            $std_res = array();
                            foreach($students as $val) {
                                $myclass = MyClass::find($val->my_class_id);
                                array_push($std_res, array(
                                    'id' => $val->id,
                                    'name' => User::find($val->user_id)->name,
                                    'adm_no' => $val->adm_no,
                                    'classname' => ($myclass->form_id." ".$myclass->stream),
                                ));
                            }
                        }
                        break;
                }

                return json_encode(['ok' => true, 'msg' => "Search Result", 'students' => $std_res]);
            } else {
                return json_encode(['ok' => true, 'msg' => "Empty value!"]);
            }
        }

        public function cancelMoveStudent($id) {
            return Student::where('id', $id)->update(['destination_class_id' => 0]);
        }

        public function acceptMoveStudent($id) {
            $destination_class_id = Student::where('id', $id)->first()->destination_class_id;
            return Student::where('id', $id)->update(['my_class_id' => $destination_class_id, 'destination_class_id' => 0]);
        }

        public function rejectApproveStudentsAll($class_id) {
            return Student::where('destination_class_id', $class_id)->update(['destination_class_id' => 0]);
        }

        public function acceptApproveStudentsAll($class_id) {
            return Student::where('destination_class_id', $class_id)->update(['my_class_id' => $class_id, 'destination_class_id' => 0]);
        }

        public function findStudent($id) {
            return Student::find($id);
        }

        public function findStudentbyAdmission($adm_no) {
            return Student::where('adm_no', $adm_no)->first();
        }

        public function moveStudent($id, $class_id) {
            return Student::where('id', $id)->update(['destination_class_id' => $class_id]);
        }

        public function findStudentPending($id) {
            return Student::where('my_class_id', $id)->where('destination_class_id', '!=', 0)->get();
        }

        public function findPendingStudents($class_id) {
            return Student::where('destination_class_id', $class_id)->get();
        }

        public function createResidence($data) {
            return Residence::create($data);
        }

        public function getResidences() {
            return Residence::get();
        }

        public function deleteResidence($id) {
            return Residence::where('id', $id)->delete();
        }

        public function updateResidence($id, $updated_name) {
            return Residence::where('id', $id)->update(['name' => $updated_name]);
        }
    public function updateRecord($id, array $data)
    {
        return StudentRecord::find($id)->update($data);
    }

    public function update(array $where, array $data)
    {
        return StudentRecord::where($where)->update($data);
    }

    public function getRecord(array $data)
    {
        return $this->activeStudents()->where($data)->with('user');
    }

    public function getRecordByUserIDs($ids)
    {
        return $this->activeStudents()->whereIn('user_id', $ids)->with('user');
    }

    public function findByUserId($st_id)
    {
        return $this->getRecord(['user_id' => $st_id]);
    }

    public function getAll()
    {
        return $this->activeStudents()->with('user');
    }

    public function getGradRecord($data=[])
    {
        return $this->gradStudents()->where($data)->with('user');
    }

    public function getAllDorms()
    {
        return Dorm::orderBy('name', 'asc')->get();
    }

    public function exists($student_id)
    {
        return $this->getRecord(['user_id' => $student_id])->exists();
    }

    /************* Promotions *************/
    public function createPromotion(array $data)
    {
        return Promotion::create($data);
    }

    public function findPromotion($id)
    {
        return Promotion::find($id);
    }

    public function deletePromotion($id)
    {
        return Promotion::destroy($id);
    }

    public function getAllPromotions()
    {
        return Promotion::with(['student', 'fc', 'tc', 'fs', 'ts'])->where(['from_session' => Qs::getCurrentSession(), 'to_session' => Qs::getNextSession()])->get();
    }

    public function getPromotions(array $where)
    {
        return Promotion::where($where)->get();
    }

}
