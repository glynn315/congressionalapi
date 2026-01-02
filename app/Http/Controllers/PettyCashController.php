<?php

namespace App\Http\Controllers;

use App\Models\PettyCash;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PettyCashController extends Controller
{
    public function displayPettyCash(){
        $displayList = PettyCash::all();
        return response()->json($displayList);
    }

    public function storePettyCash(Request $request){
        $PettyCashField = $request->validate([
            'requestName' => 'string|required',
            'pettycashDescription' => 'string|required',
            'pettycashAmount' => 'integer|required',
            'receivedBy' => 'integer|required',
        ]);
        $PettyCashField['is_active'] = true;
        $PettyCashField['dateCreated'] = Carbon::now();

        $PettyCashForm = PettyCash::create($PettyCashField);

        return response()->json(['Store Petty Success' , $PettyCashForm] , 201);
    }
}
