<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class AppUser extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $primaryKey = 'userid';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'companycode',
        'rolecode',
        'fullname',
        'dateofbirth',
        'phonenumber',
        'address',
        'departmentid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dateofbirth' => 'date',
    ];

    public function company()
    {
        return $this->hasOne(AppCompany::class, 'companycode', 'companycode');
    }

    public function role()
    {
        return $this->hasOne(AppRole::class, 'rolecode', 'rolecode');
    }

    public function department()
    {
        return $this->hasOne(AppDepartment::class, 'departmentid', 'departmentid');
    }

    public function presences()
    {
        return $this->belongsTo(AppPresence::class);
    }

    public function payrolls()
    {
        return $this->belongsTo(AppPayroll::class);
    }
}
