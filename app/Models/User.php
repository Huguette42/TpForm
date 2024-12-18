<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    use Notifiable;
    protected $fillable = ['email','firstname','lastname', 'password'];
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
