<?php

namespace App\Http\Controllers;

use App\Models\Invitations;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InvitationController extends Controller
{
    public function displayInvitations(){
        $displayList = Invitations::all();
        return response()->json($displayList);
    }

    public function storeRequest(Request $request){
        $InvitationField = $request->validate([
            'name_inviter' => 'string|required',
            'purpose' => 'string|required',
            'reveivedBy' => 'integer|required',
            'dateInvitation' => 'date|required',
        ]);
        $InvitationField['is_active'] = true;
        $InvitationField['dateCreated'] = Carbon::now();

        $invitationForm = Invitations::create($InvitationField);

        return response()->json(['Store Invitations Success' , $invitationForm] , 201);
    }
}
