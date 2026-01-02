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
        'event_address',
        'status',
        'remarks',
        'contact_number',
        'dateCreated',
        'reveivedBy',
        'is_active',
    ];
}
