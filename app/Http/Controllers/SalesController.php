<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SalesImport;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Sales;
use App\User;
use Validator;
use Auth;
class SalesController extends Controller
{
    public function __construct()
    {
      $this->middleware('CheckSession');
    }
    public function Index(Request $request)
    {        
             $employee=User::all();
             $sales=Sales::where('emp_id',Auth::user()->id)->orderBy('id','DESC')->get();
             return view('sales',compact('employee','sales'));
    }

    public function import(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|mimes:xls,xlsx',
        ]);
        if ($validator->fails()) {
            return back()->with([
                'error' => $validator->messages()->first(),
                'status' => 400,
            ]);
        }
        try{
            $emp_id= $request->emp_id;
             Excel::import(new SalesImport($emp_id), request()->file('import_file'));
             return back()->with(['success' =>'uploaded successfully', 'status' => 200]);

           }catch(\Exception $e){
            //    dd($e->getMessage());
              return back()->with(['error' => $e->getMessage(), 'status' => 400]);
         }
    }



    public function SalesExport(Request $request)
    {   
          
         $emp_id= $request->emp_id;
         $from= date('Y-m-d',strtotime($request->from));
         $to= date('Y-m-d',strtotime($request->to));
        return Excel::download(new SalesExport($emp_id,$from,$to),   $from.'_'.$to.'sales.xlsx');
        
    }
}
