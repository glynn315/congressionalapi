<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
    protected $table = 'area_information';
    protected $primaryKey = 'area_id';
    public $timestamps = true;

    protected $fillable = [
        'areaInformation',
        'municipality',
        'created_by',
        'is_active',
        'date_created',
    ];
}
