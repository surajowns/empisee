<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
    public function Role(Request $request)
    {
        $data=Role::get();
        return view('employee_role',compact('data'));
    }

    public function AddRole(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
           ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                 'status' => 400,
            ]);
        }
            
          try{    
                $data=$request->all();
                Role::create($data);
                return response()->json(['success'=>'Role added successfully','status' =>200]);

            }catch(\Exception $e){
                //  dd($e->getMessage());
              return response()->json(['error'=>$e->getMessage(),'status' => 400]);

             }
    }
    public function ChangeRoleName(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
           ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                 'status' => 400,
            ]);
        }
            
          try{    
            
                Role::where('id',$request->role_id)->update(['name'=>$request->name]);
                return response()->json(['success'=>'Role Updated successfully','status' =>200]);

            }catch(\Exception $e){
                //  dd($e->getMessage());
              return response()->json(['error'=>$e->getMessage(),'status' => 400]);

             }
    }

    
}
