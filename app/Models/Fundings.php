<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fundings extends Model
{
    protected $table ='fundings';

    protected $fillable = [
        'funding_information',
        'dateCreated',
        'is_active',
    ];

    public function budgetFundings()
    {
        return $this->hasMany(BudgetFundings::class, 'fundings_id', 'id');
    }
}
