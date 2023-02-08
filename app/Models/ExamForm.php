<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamForm extends Model
{
    use HasFactory;
    protected $fillable = ['exam_id', 'form_id', 'min_subject_cnt', 'state'];

    public function exam() {
        return $this->belongsTo(Exam::class);
    }
    public function form() {
        return $this->belongsTo(Form::class);
    }
}
