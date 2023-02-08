<?php

namespace App\Imports;

use App\Models\TestExcel;
use Maatwebsite\Excel\Concerns\ToModel;


use Maatwebsite\Excel\Concerns\WithHeadingRow;
class TestExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TestExcel([
            'sort_id'     => $row[0],
            'name'    => $row[1],
        ]);
    }
}
