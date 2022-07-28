<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $fillabe=['name','slug','parent_id','visible','sort_order','created_at','updated_at'];

    protected $table="sidebar";

    public function sidebar_permission()
    {
         return $this->hasOne('App\SidebarPermission','sidebar_id','id');
    }


}
