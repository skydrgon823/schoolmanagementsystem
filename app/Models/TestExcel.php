<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestExcel extends Model
{
    use HasFactory;
    protected $fillable = ['sort_id', 'name'];
}
