<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClockInOut extends Model
{
      protected $fillable=['emp_id','clock_in','clock_out','comment','is_clock_in','created_at','updated_at'];
      protected $table="clockinout";


      public function attendence_status()
      {
            return $this->hasOne('App\AttendenceStatus','id','status');
      }
      public function emp_details()
      {
            return $this->hasOne('App\User','id','emp_id');
      }
}
