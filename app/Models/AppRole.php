<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppRole extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'rolecode',
        'rolename'
    ];

    public function rolePermissions() {
        return $this->belongsTo(AppRolesPermission::class);
    }
}
