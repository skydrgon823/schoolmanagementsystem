<?php

namespace App\Models;

use App\User;
use Eloquent;

class BomPaRecord extends Eloquent
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function group() {
    //     return $this->belongsTo(Group::class);
    // }
}
