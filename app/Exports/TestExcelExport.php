<?php

namespace App\Exports;

use App\Models\TestExcel;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class TestExcelExport implements FromCollection, WithHeadings, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return ['People', 1, 2, 3];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function collection()
    {   
        return TestExcel::select('sort_id', 'name')->get();
    }
}
