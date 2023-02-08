<?php

namespace App\Imports;

use App\User;
use App\Models\Student;
use App\Models\MyClass;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Helpers\Qs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class StudentTempImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            
            $default_password = 'qwerQWER1234!@#$_student';
            $user = User::where('email', $row[4])->first();
            if ($row[3] != 'NAME' && $row[4] != 'E-mail' && $row[5] != 'GENDER' && $user == null) {
                
                $user = User::create([
                    'name'     => $row[3],
                    'email'    => $row[4],
                    'gender'     => $row[5],
                    'dob'    => $row[7],
                    'code' => $this->generateRandomString(),
                    'photo' => Qs::getDefaultUserImage(),
                    'user_type_id' => 2,
                    'password' => Hash::make($default_password),
                ]);
        
                $myclass = MyClass::where('form_id', $row[1])->where('stream', $row[2])->first();

                $student = Student::create([
                    'user_id' => $user->id,
                    'my_class_id' => $myclass->id,
                    'adm_no' => $row[0],
                ]);
            }    
        }
    }
   
    
    public function generateRandomString($length = 20) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
