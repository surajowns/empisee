<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastCompanyDetails extends Model
{
    protected $fillable=['emp_id','company_name','com_joining_date','com_last_date','hr_name','hr_contact','hr_email','tl_name','tl_contact','tl_email','com_contact','com_address','reason_for_left','created_at','updated_at'];
    protected $table="last_com_details";
}
