<?php

namespace App\Http\Controllers;

use App\Models\Fundings;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FundingsController extends Controller
{
    public function displayFundings()
    {
        $displayList = Fundings::with(['budgetFundings' => function ($query) {
                $query->select('fundings_id', 'amount');
            }])
            ->where('id', '!=', 3)
            ->get(['id', 'funding_information', 'dateCreated', 'is_active']);

        return response()->json($displayList);
    }

    public function displayFundingPettyCash()
    {
        $displayList = Fundings::with(['budgetFundings' => function ($query) {
                $query->select('fundings_id', 'amount', 'date_created')
                    ->whereDate('date_created', Date::today());
            }])
            ->where('id', 3)
            ->first();

        if (!$displayList) {
            return response()->json([
                'id' => 3,
                'funding_information' => 'Petty Cash',
                'total_remaining_budget' => 0,
                'budgetFundings' => [],
            ]);
        }

        return response()->json($displayList);
    }



    public function storeFundings(Request $request){
        $InvitationField = $request->validate([
            'funding_information' => 'string|required',
        ]);
        $InvitationField['is_active'] = true;
        $InvitationField['dateCreated'] = Carbon::now();

        $invitationForm = Fundings::create($InvitationField);

        return response()->json(['Store Fundings Success' , $invitationForm] , 201);
    }
}
