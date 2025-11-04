<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AccountManagement extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'account_management';
    protected $primaryKey = 'account_id';
    public $timestamps = true;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'province',
        'municipality',
        'barangay',
        'username',
        'password',
        'role',
        'created_by',
        'is_active',
        'date_created',
        'is_newaccount',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_newaccount' => 'boolean',
        'date_created' => 'date',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'role' => $this->role,
        ];
    }
}
