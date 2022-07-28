<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillabe=['name','created_at','updated_at'];
    protected $table='leave_type';
}
