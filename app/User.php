<?php

namespace App;

use App\Models\BloodGroup;
use App\Models\Lga;
use App\Models\Nationality;
use App\Models\StaffRecord;
use App\Models\State;
use App\Models\Student;
use App\Models\UserType;
use App\Models\StudentRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'dob', 'gender', 'photo','sign', 'photo_by', 'address', 'tsc_no', 'national_id_no',  'password',   'code', 'user_type_id', 'email_verified_at',
        'phone', 'phone2', 'bg_id','nal_id', 'state_id', 'lga_id',
        'school_name', 'school_short_name', 'school_phone', 'school_email', 'school_head_id','school_title_id', 'school_hod_id', 'school_postal', 'school_gender_id', 'school_status_id', 'school_logo'
        ,'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function student_record()
    {
        return $this->hasOne(StudentRecord::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nal_id');
    }

    public function blood_group()
    {
        return $this->belongsTo(BloodGroup::class, 'bg_id');
    }

    public function staff()
    {
        return $this->hasMany(StaffRecord::class);
    }
    public function student() {
        return $this->hasOne(Student::class);
    }
    public function teacher() {
        return $this->hasOne(Teacher::class);
    }
    public function user_type() {
        return $this->belongsTo(UserType::class);
    }
}
