<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable 
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_code','name' ,'email','role','mobile','profile_image','signature','location','latitude','longitude','fcm_token','otp','token','referrer_id','status','password',
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        public function hasRole($role)
        {
            return null !== Role::where('name',$role)->first();
        }

         public static function hasPermission($emp_id)
         {
            return SidebarPermission::where('emp_id',$emp_id)->get();
         }
  
        public function roles()
        {
            return $this->hasOne('App\Role','id','role');
        }
        public function emp_details()
        {
            return $this->hasMany('App\EmployeeDetails','emp_id','id');
        }
        public function last_comapny_details()
        {
            return $this->hasOne('App\LastCompanyDetails','emp_id','id');
        }
        public function emp_salary()
        {
            return $this->hasMany('App\EmployeeSalary','emp_id','id');
        }
        public function exp_details()
        {
            return $this->hasOne('App\Expense','emp_id','id');
        }
    

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
    public static function generateVerificationCode()
    {
        return str_random(40);
    }
    
}
