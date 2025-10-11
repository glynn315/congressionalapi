<?php

namespace App\Http\Controllers;

use App\Models\Fundings;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FundingsController extends Controller
{
    public function displayFundings(){
        $displayList = Fundings::all();
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
