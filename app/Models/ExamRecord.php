<?php

namespace App\Models;

use Eloquent;

class ExamRecord extends Eloquent
{
    protected $fillable = ['exam_id', 'my_class_id', 'student_id', 'section_id', 'af', 'af_id', 'ps', 'ps_id','t_comment', 'p_comment', 'year', 'total', 'ave', 'class_ave', 'pos'];
    public function my_class() {
        return $this->belongsTo(MyClass::class, 'my_class_id', 'id');
    }
    public function subject() {
        return $this->belongsTo(Subject::class, 'af', 'id');
    }
    public function exam() {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

}
