<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=['emp_id','doc_name','document','created_at','updated_at'];
    protected $table="emp_document";
}
