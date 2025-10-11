<?php

namespace App\Http\Controllers;

use App\Models\BudgetFundings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetFundingController extends Controller
{
    public function displayBudgets(){
        $displayList = BudgetFundings::all();
        return response()->json($displayList);
    }

    public function storeBudgets(Request $request){
        $BudgetField = $request->validate([
            'fundings_id' => 'integer|required',
            'amount' => 'integer|required',
            'created_by' => 'integer|required',
        ]);
        $BudgetField['is_active'] = true;
        $BudgetField['date_created'] = Carbon::now();

        $budgetForm = BudgetFundings::create($BudgetField);

        return response()->json(['Store Budget Success' , $budgetForm] , 201);
    }

    public function countBudgetsPerFunding()
    {
        return BudgetFundings::query()
            ->select('fundings_id', DB::raw('SUM(amount) as total_budgets'))
            ->groupBy('fundings_id')
            ->get();
    }
}
