<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetails extends Model
{
    protected $fillable=['emp_id','job_title','team_lead','company_id','department','personal_email','role','d_o_b','gender','per_address','pres_address','address_prof','joining_date','guardian','marital_status','emeg_contact','fami_members','guardian_cont','relation','blood_group','birth_marks','created_at','updated_at'];
    protected $table='employee_details';

    public function emp_details()
    {
        return $this->hasOne('App\User','id','emp_id');
    }
    public function departments()
    {
        return $this->hasOne('App\Department','id','department');
    }
    public function companies()
    {
        return $this->hasOne('App\Company','id','company_id');
    }
    public function roles()
    {
        return $this->hasOne('App\Role','id','role');
    }

}
