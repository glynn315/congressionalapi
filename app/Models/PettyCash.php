<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    protected $table = "petty_cashes";

    protected $fillable = [
        'requestName',
        'pettycashDescription',
        'pettycashAmount',
        'dateCreated',
        'receivedBy',
        'is_active',
    ];
}
