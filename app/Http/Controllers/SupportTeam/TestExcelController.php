<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TestExcelImport;
use App\Exports\TestExcelExport;

class TestExcelController extends Controller
{
    public function index()
    {     
        return view('pages.support_team.testexcel.index');
    }

    public function fileImportExport()
    {
       return view('pages.support_team.testexcel.file-import');
    }   
    
    public function fileImport(Request $request) 
    {
        Excel::import(new TestExcelImport, $request->file('file')->store('temp'));
        return back();
    }
    
    public function fileExport() 
    {
        return Excel::download(new TestExcelExport, 'users-collection114.xlsx');

        // return Excel::download(new TestExcelExport, 'users-' . time() . '.csv');
        // return Excel::download(new TestExcelExport, 'users-' . time() . '.xlsx');
    }   
}
