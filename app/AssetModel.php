<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    protected $fillable=['emp_id','product_name','model_no','action_by','quantity','allotted_date','return_date','remarks','status','created_at','updated_at'];
    protected $table="assets";

    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');

    }
}
