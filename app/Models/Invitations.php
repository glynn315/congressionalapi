<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitations extends Model
{
    protected $table ='invitations_information';

    protected $fillable = [
        'name_inviter',
        'dateInvitation',
        'purpose',
        'dateCreated',
        'reveivedBy',
        'is_active',
    ];
}
