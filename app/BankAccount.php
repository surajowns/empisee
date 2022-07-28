<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable=['emp_id','account_full_name','bank_account_no','bank_name','ifsc_code','branch_name','address','pan_card_no','pf_or_uan_no','esic_no'];
    protected $table='emp_bank_account';

    public function employee()
    {
        return $this->hasOne('App\User','id','emp_id');

    }
}
