<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SidebarPermission extends Model
{
    protected $fillable=['sidebar_id','role_id','emp_id','created_at','updated_at'];
    protected $table='sidebar_permission';

     public function sidebar()
     {
          return $this->hasMany('App\Sidebar','id','sidebar_id');
     }
 

}
