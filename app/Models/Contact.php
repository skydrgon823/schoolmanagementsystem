<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;

class Contact extends Eloquent
{
    protected $fillable = ['name', 'email', 'message', 'phone'];
    use HasFactory;
    protected $table = 'contacts';
}
