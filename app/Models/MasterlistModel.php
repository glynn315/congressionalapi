<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterlistModel extends Model
{
    protected $table = 'masterlist_information';
    protected $primaryKey = 'personel_id';
    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'extension',
        'birthday',
        'sex',
        'civil_status',
        'purok',
        'municipality_city',
        'contact_number',
        'affiliate',
        'type',
        'parallel_id',
        'area_id',
        'created_by',
        'is_active',
        'date_created',
    ];
}
