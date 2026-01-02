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
    public function displayBudgetsbyID($id){
        $displayList = BudgetFundings::where('fundings_id' , $id)->get();
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
        $budgetTotals = DB::table('budget_fundings')
            ->select('fundings_id', DB::raw('SUM(amount) as total_budget'))
            ->groupBy('fundings_id');

        $requestTotals = DB::table('request_forms')
            ->select('provider_id', DB::raw('SUM(amount) as total_requested'))
            ->groupBy('provider_id');

        return DB::table(DB::raw("({$budgetTotals->toSql()}) as bf"))
            ->mergeBindings($budgetTotals)
            ->leftJoin(DB::raw("({$requestTotals->toSql()}) as rf"), 'rf.provider_id', '=', 'bf.fundings_id')
            ->mergeBindings($requestTotals)
            ->select(
                'bf.fundings_id',
                DB::raw('bf.total_budget - IFNULL(rf.total_requested, 0) as total_remaining_budget')
            )
            ->get();
    }

}
