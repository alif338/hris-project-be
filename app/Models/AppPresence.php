<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class AppPresence extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'presenceid';

    protected $fillable = [
        'userid',
        'precensedate',
        'checkintime',
        'checkouttime'
    ];
}
