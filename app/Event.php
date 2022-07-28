<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=['title','description','categoryClass','start','end','status','created_at','updated_at'];
    protected $table="events";
}
