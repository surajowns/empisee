<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=['emp_id','net_pay','bonus','leave_without_pay','loan','other_deduction','month','email_sent'];
    protected $table="payments";

    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');

    }
}
