<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class requestForm extends Model
{
    protected $table ='request_forms';
    protected $primaryKey ='request_form_id';
    public $incrementing = false;
    protected $keyType ='string';

    protected $fillable = [
        'request_form_id',
        'control_number',
        'patients_name',
        'representative_name',
        'address',
        'contact_number',
        'provider_id',
        'is_active',
        'amount',
        'account_id',
    ];
}
