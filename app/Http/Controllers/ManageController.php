<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use DB;
use App\Sidebar;
use Validator;
use App\SidebarPermission;
class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckSession');
        $this->middleware('CheckPermission');

    }
    public function Index(Request $request)
    {

        $employee=User::with('emp_details')->where('status',1)->orderBy('id','DESC')->get()->toArray();
        return view('manage',compact('employee'));
    }

    public function ViewPermission(Request $request,$id)
    {      
         $emp_id=$id;
         $side_bar=Sidebar::with(['sidebar_permission'=>function($query) use ($id)
         {
            $query->select('*')->where('emp_id',$id);
         }])->where('parent_id',0)->get()->toArray();

         $employee=User::with('roles')->where('id',$emp_id)->first();

         $other_permission=Sidebar::with(['sidebar_permission'=>function($query) use ($id)
         {
            $query->select('*')->where('emp_id',$id);
         }])->where('parent_id','!=',0)->get()->toArray();

         return view('viewpermission',compact('side_bar','other_permission','emp_id','employee'));
    }

    public function UpdatePermission(Request $request)
    {
           
        $validator = Validator::make($request->all(), [
            'emp_id' => 'required',
            'sidebar_id' => 'required',

           ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()->first(),
                 'status' => 400,
            ]);
        }
            
          try{    
                $data=$request->all();
                $emp_id=$request->emp_id;
                $user=User::where('id',$emp_id)->first();
                $data['role_id']=$user['role'];
                $check_permission=SidebarPermission::where('emp_id',$emp_id)->where('role_id',$user['role'])->where('sidebar_id',$request->sidebar_id)->first();
                if($check_permission){
                    SidebarPermission::where('emp_id',$emp_id)->where('role_id',$user['role'])->where('sidebar_id',$request->sidebar_id)->delete();
                }else{
                    SidebarPermission::create($data);
                }

                return response()->json(['success'=>'Permission Changed successfully','status' =>200]);

            }catch(\Exception $e){
                //  dd($e->getMessage());
              return response()->json(['error'=>$e->getMessage(),'status' => 400]);

             }
    }
}
