<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Message extends Model
{
    use HasFactory;
    protected $fillable = ['state'];
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    protected $table = "messages";
}
