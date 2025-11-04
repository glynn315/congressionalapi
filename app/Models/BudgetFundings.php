<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetFundings extends Model
{
    protected $table ='budget_fundings';

    protected $fillable = [
        'fundings_id',
        'amount',
        'created_by',
        'is_active',
        'date_created'
    ];

    public function funding()
    {
        return $this->belongsTo(Fundings::class, 'fundings_id', 'id');
    }
}
