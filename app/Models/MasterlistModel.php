<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterlistModel extends Model
{
    protected $table = 'masterlist_information';
    protected $primaryKey = 'personel_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
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
