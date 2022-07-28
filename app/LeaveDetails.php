<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveDetails extends Model
{
    protected $fillable=['emp_id','casual_leave','sick_leave','total_leave','cl_taken','ml_taken','created_at','updated_at'];
    protected $table='leave_details';
    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');

    }
}
