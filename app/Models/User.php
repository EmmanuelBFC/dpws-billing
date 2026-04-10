<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'firstLogin',
        'currentBridge',
        'shift',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function signature(){
        return $this->hasONE(Signature::class);
    }

    public function predictions(){
        return $this->hasMany(Prediction::class);
    }
    public function reporting(){
         return $this->hasMany(Report::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isChefGuerite()
    {
        return $this->role === 'user';
    }

    public function isSupport()
    {
        return $this->role === 'support';
    }

    public function isAccount()
    {
        return $this->role === 'account';
    }
    public function isCoordo()
    {
        return $this->role === 'coordo';
    }
    public function isAdministration()
    {
        return $this->role === 'administration';
    }

    public function isSuperAdmin(){

        return $this->role === 'super_admin';
    }

    public function isOperateur(){

        return $this->role === 'ope';
    }
}
