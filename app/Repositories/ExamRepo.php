<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\ExamForm;
use App\Models\ExamRecord;
use App\Models\Grade;
use App\Models\Mark;
use App\Models\Skill;
use App\Models\Form;
use App\Models\ClassType;
use Illuminate\Support\Facades\DB;
class ExamRepo
{

    public function all()
    {
        return Exam::orderBy('term', 'asc')->get();
    }
    public function last()
    {
        $exam = Exam::orderBy('term', 'desc')->orderBy('created_at', 'desc')->first();
        return $exam->id;
    }
    public function terms()
    {
        return Exam::select('term')->groupBy('term')->orderBy('term', 'desc')->get();
    }
    public function allByYear($year)
    {
        return Exam::where('year', $year)->orderBy('created_at', 'desc')->orderBy('name', 'asc')->get();
    }

    public function getExam($data)
    {
        return Exam::where($data)->get();
    }

    public function getAllExamForms() {
        return ExamForm::where('state', 0)->get();
    }
    public function getAllExamFormsByDeleted() {
        return ExamForm::where('state', 1)->get();
    }
    public function getExamFormsByExamId($exam_id){
        $ccc = ExamForm::where('exam_id', $exam_id)->get();
        $bbb = array();
        $aaa = Form::orderBy('id', 'asc')->get();
        foreach($aaa as $val) {
            $count = 0;
            foreach ($ccc as $item) {
                if($item->form_id == $val->id){
                    $count = 1;
                    break;
                }
            }
            if($count == 0){
                array_push($bbb, array(
                    'id' => $val->id,
                    'name' => $val->name,
                ));
            }
        }
        return $bbb;
    }
    public function getForm($id){
        return Form::find($id);
    }
    public function find($id)
    {
        return Exam::find($id);
    }
    public function getExamByForm($form_id){
        return ExamForm::where('form_id', $form_id)->get();
    }
        public function create($data)
        {
            return Exam::create($data);
        }

        public function createExamForm($data)  {
            return ExamForm::create($data);
        }

        public function isExist($data) {
            return Exam::where('type', $data['type'])->where('name', $data['name'])
                ->where('term', $data['term'])->where('year', $data['year'])->first();
        }

    public function createRecord($data)
    {
        return ExamRecord::firstOrCreate($data);
    }
    public function allExamRecord(){
        return ExamRecord::orderBy('created_at', 'desc')->get();
    }
    public function update($id, $data)
    {
        return Exam::find($id)->update($data);
    }

    public function updateRecord($where, $data)
    {
        return ExamRecord::where($where)->update($data);
    }

    public function getRecord($data)
    {
        return ExamRecord::where($data)->get();
    }
    public function getGradeRecord(){
        return DB::table('exam_records')->select('year', DB::raw('count(id) as counts'), DB::raw('sum(pos) as mean'), DB::raw('sum(af) as mark'))->groupBy('year')->get();
    }
    public function findRecord($id)
    {
        return ExamRecord::find($id);
    }

    public function delete($id)
    {
        ExamForm::where('exam_id', $id)->delete();
        return Exam::destroy($id);
    }
    public function each_delete($exam_id, $form_id)
    {
        // ExamForm::where('exam_id', $exam_id)->where('form_id', $form_id)->delete();
        ExamForm::where('exam_id', $exam_id)->where('form_id', $form_id)->update(['state'=>1]);
        if(count(ExamForm::where('exam_id', $exam_id)->get()) == 0){
            return Exam::destroy($exam_id);
        }
        return false;
        // echo $exam_id;
    }
    public function each_delete_final($exam_id, $form_id)
    {
        ExamForm::where('exam_id', $exam_id)->where('form_id', $form_id)->where('state', 1)->delete();
        if(count(ExamForm::where('exam_id', $exam_id)->get()) == 0){
            return Exam::destroy($exam_id);
        }
        return null;
        // echo $exam_id;
    }
    public function each_delete_recover($exam_id, $form_id)
    {
        ExamForm::where('exam_id', $exam_id)->where('form_id', $form_id)->update(['state'=>0]);
        if(count(ExamForm::where('exam_id', $exam_id)->get()) == 0){
            return Exam::destroy($exam_id);
        }
        return null;
        // echo $exam_id;
    }

    /*********** Grades ***************/

    public function allGrades()
    {
        return Grade::orderBy('name')->get();
    }
    public function allGradesWithNoNull($grade_id)
    {
        return Grade::where("class_type_id", $grade_id)->orderBy('remark', 'desc')->get();
    }

    public function getGrade($data)
    {
        return Grade::where($data)->get();
    }

    public function findGrade($id)
    {
        return Grade::find($id);
    }

    public function createGrade($data)
    {
        return Grade::create($data);
    }

    public function updateGrade($id, $data)
    {
        $grades = Grade::all();
        $flag = 0;
        foreach ($grades as $key => $grade) {
            if($grade->id == $id){
                $flag = 1;
                break;
            }
        }
        if ($flag >0 ) {
            return Grade::find($id)->update($data);

        }else{
            return Grade::create($data);
        }
        // return $flag;

    }

    public function deleteGrade($id)
    {
        return Grade::destroy($id);
    }
    public function deleteGradeByClassTypeID($class_type_id)
    {
        Grade::where('class_type_id', $class_type_id)->delete();
        return ClassType::destroy($class_type_id);
    }

    /*********** Marks ***************/

    public function createMark($data)
    {
        return Mark::firstOrCreate($data);
    }

    public function destroyMark($id)
    {
        return Mark::destroy($id);
    }

    public function updateMark($id, $data)
    {
        return Mark::find($id)->update($data);
    }

    public function getExamYears($student_id)
    {
        return Mark::where('student_id', $student_id)->select('year')->distinct()->get();
    }

    public function getMark($data)
    {
        return Mark::where($data)->with('grade')->get();
    }

    /*********** Skills ***************/

    public function getSkill($where)
    {
        return Skill::where($where)->orderBy('name')->get();
    }

    public function getSkillByClassType($class_type = NULL, $skill_type = NULL)
    {
        return ($skill_type)
            ? $this->getSkill(['class_type' => $class_type, 'skill_type' => $skill_type])
            : $this->getSkill(['class_type' => $class_type]);
    }

}
