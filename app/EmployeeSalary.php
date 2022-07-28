<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $fillable=['emp_id','emp_salary','basic_salary','hra','medical_allowance','conveyance','mix_allowance','mobile_expenses','tds','pf','esic','remarks','start_date','end_date','created_at','update_at'];
    protected $table="salary_details";

    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');

    }


}
