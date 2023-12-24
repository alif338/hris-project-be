<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppDepartment extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'departmentid';
    public $incrementing = false;

    protected $fillable = [
        'companyid',
        'departmentname',
        'departmentdesc',
    ];

    public function users()
    {
        return $this->belongsTo(AppUser::class, 'departmentid', 'departmentid');
    }

    public function company()
    {
        return $this->hasOne(AppCompany::class, 'companyid', 'companyid');
    }
}
