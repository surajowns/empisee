<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leave extends Model
{
    
    protected $fillable=['emp_id','leave_type','leave_day','from_date','to_date','leave_reason','approved_by','status','created_at','updated_at'];
    protected $table="leaves";


    public function employee()
    {
          return $this->hasOne('App\User','id','emp_id') ;
    }
    public function leavetype()
    {
        return $this->hasOne('App\LeaveType','id','leave_type');
    }
}
