<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;    

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function my_class() {
        return $this->belongsTo(MyClass::class, 'my_class_id', 'id');
    }
    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    public function students_taken_this_subject() {
        return $this->hasMany(StudentSubject::class);
    }
}
