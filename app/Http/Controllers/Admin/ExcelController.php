<?php

namespace App\Http\Controllers\Admin;
use App\Imports\ServersImport;
use App\Models\Server;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    use ValidatesRequests;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {

        $message = Session::get('msg');
        echo $message;

        return view('admin/excel');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    function importData(Request $request){
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('uploaded_file');

        Excel::import(new ServersImport(), $the_file);



        return back()->withSuccess('Great! Data has been successfully uploaded.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    function clearData(Request $request){

        Server::truncate();

        return back()->withSuccess('Great! Data has been deleted.');
    }

}
