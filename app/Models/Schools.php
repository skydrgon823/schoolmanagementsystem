<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Schools extends Model
{
    protected $fillable = ['user_id', 'name', 'short_name', 'phone', 'email', 'head_id','title_id', 'hod_id', 'postal', 'gender_id', 'status_id', 'logo'];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
