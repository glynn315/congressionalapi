<?php

namespace App\Http\Controllers;

use App\Models\Solicitations;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SolicitationController extends Controller
{
    public function displaySolicitations(){
        $displayList = Solicitations::all();
        return response()->json($displayList);
    }

    public function storeRequest(Request $request){
        $SolicitationField = $request->validate([
            'name_solicitor' => 'string|required',
            'purpose' => 'string|required',
            'particular' => 'string|required',
            'amount' => 'integer|required',
            'reveivedBy' => 'integer|required',
            'date_event' => 'date|nullable',
        ]);
        $SolicitationField['is_active'] = true;
        $SolicitationField['dateCreated'] = Carbon::now();
        $SolicitationField['dateSolicitate'] = Carbon::now();

        $SolicitationForm = Solicitations::create($SolicitationField);

        return response()->json(['Store Solicitations Success' , $SolicitationForm] , 201);
    }
}
