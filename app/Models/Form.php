<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function my_classes() {
        return $this->hasMany(MyClass::class);
    }
}
