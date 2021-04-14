<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    public $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'title', 'name', 'email', 'phone', 'dob', 'bank', 'bank_account', 'notes',
        'address', 'last_login_at'
    ];
}
