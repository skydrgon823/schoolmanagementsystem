<?php

namespace App\Exports;

use App\Models\StudentTemp;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentTempExport implements FromCollection, WithHeadings, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings(): array
    {
        return ['ADMNO', 'Form', 'Stream', 'Name', 'E-mail', 'GENDER', 'UPI', 'DOB', 'KCPE'];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function collection()
    {
        return StudentTemp::select('adm_no', 'form', 'stream', 'name', 'email', 'gender', 'upi', 'dob', 'kcpe')->get();
    }
}
