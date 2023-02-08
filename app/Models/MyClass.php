<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyClass extends Model
{
    use HasFactory;
    
    protected $fillable = ['form_id', 'stream'];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    public function class_subject() {
        return $this->hasMany(ClassSubject::class);
    }
    public function students() {
        return $this->hasMany(Student::class);
    }
    public function form() {
        return $this->belongsTo(Form::class);
    }
    
}
