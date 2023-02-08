<?php

namespace App\Models;
use App\Models\ClassType;
use Eloquent;

class Grade extends Eloquent
{
    protected $fillable = ['name', 'class_type_id', 'mark_from', 'mark_to', 'remark'];
    public function class_type(){
        return $this->belongsTo(ClassType::class, 'class_type_id');
    }
}
