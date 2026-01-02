<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitations extends Model
{
    protected $table ='solicitations';

    protected $fillable = [
        'name_solicitor',
        'dateSolicitate',
        'purpose',
        'particular',
        'amount',
        'dateCreated',
        'reveivedBy',
        'is_active',
    ];
}
