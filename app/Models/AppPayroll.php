<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppPayroll extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'payrollid';
    public $incrementing = false;
    
    protected $fillable = [
        'userid',
        'payrolldate',
        'purposes',
        'bank_account',
        'status'
    ];
}
