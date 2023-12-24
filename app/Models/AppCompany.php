<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppCompany extends Model
{
    use HasFactory, HasApiTokens;
    protected $primaryKey = 'companyid';

    protected $fillable = [
        'companycode',
        'companyname',
        'industry',
        'address',
        'contactnumber',
    ];

    public function departments()
    {
        return $this->belongsTo(AppDepartment::class, 'companyid', 'companyid');
    }

    public function users()
    {
        return $this->belongsTo(AppUser::class, 'companycode', 'companycode');
    }
}
