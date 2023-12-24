<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppPermission extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'permissioncode',
        'permissionname',
        'permissiondesc',
    ];

    public function rolePermssions() {
        return $this->belongsTo(AppRolesPermission::class);
    }
}
