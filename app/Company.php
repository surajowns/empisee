<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable=['company_name','reg_comp_no','incorporat_date','vat_number','register_address','corporat_address','contact_no','email','company_url','city','country','pin_code'];
    protected $table="companies";
}
