<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    public function subject_type() {
        return $this->belongsTo(SubjectType::class);
    }
    public function teacher() {
        return $this->hasOne(SubjectTeacher::class);
    }
}
