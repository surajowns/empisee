<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Sidebar;
use App\SidebarPermission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
            // $sidebar_id=Sidebar::where('slug',Request::segment(1))->first();
            // if(empty($sidebar_id)){
            //     if($request->ajax()){
            //          return response()->json(['error'=>'You don`t have permission Please Contact your domain admin for help']);
            //         }
            //     return back()->with(['error'=>'Contact your domain admin for help']);
            // }
            // $checkpermission=SidebarPermission::where('emp_id',$request->session()->get('logid'))->where('sidebar_id',$sidebar_id['id'])->first();
            // if(Request::segment(1)=='dashboard'){
            //     return redirect('dashboard');
            // }
            // if(!empty($checkpermission)){
            //     return $next($request);
            // }else{
            //     return back()->with(['error'=>'Contact your domain admin for help']);

            // } 
     
        return $next($request);
    }
}
