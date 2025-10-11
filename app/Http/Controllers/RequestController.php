<?php

namespace App\Http\Controllers;

use App\Models\requestForm;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Ramsey\Uuid\Uuid;

class RequestController extends Controller
{
    public function displayRequest(){
        $displayList = requestForm::all();
        return response()->json($displayList);
    }

    public function storeRequest(Request $request){
        $requestField = $request->validate([
            'control_number' => 'integer|required',
            'patients_name' => 'string|required',
            'representative_name' => 'string|required',
            'address' => 'string|required',
            'contact_number' => 'integer|required',
            'provider_id' => 'integer|required',
            'account_id' => 'integer|required',
            'amount' => 'integer|required',
        ]);
        $requestField['request_form_id']= Uuid::uuid4()->toString();
        $requestField['is_active'] = true;

        $requestForm = requestForm::create($requestField);

        return response()->json(['Store Request Success' , $requestForm] , 201);
    }
}
