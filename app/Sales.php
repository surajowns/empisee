<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable=['emp_id','date','company_name','contact_person','contact_no','designation','contact_email','address','remarks','created_at','updated_at'];
    protected $table="sales";

    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');
    }
}
