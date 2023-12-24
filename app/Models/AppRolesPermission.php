<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppRolesPermission extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'rolecode',
        'companycode',
        'permissioncode'
    ];

    public function company()
    {
        return $this->hasOne(AppCompany::class, 'companycode', 'companycode');
    }
}
