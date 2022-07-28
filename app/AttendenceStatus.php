<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendenceStatus extends Model
{
     protected $fillable=['name'];
     protected $table="attendence_status";
}
