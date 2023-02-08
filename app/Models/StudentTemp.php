<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTemp extends Model
{
    use HasFactory;
    protected $fillable = ['adm_no', 'form', 'stream', 'name', 'email', 'gender', 'upi', 'dob', 'kcpe'];
}
