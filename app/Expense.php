<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable=['emp_id','exp_type','exp_date','from','to','amount','vendor_name','purpose','exp_invoice','notes','approved','rejected','settled','status','created_at','updated_at','approved_by'];
    protected $table="expnese";


    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');
    }
}
