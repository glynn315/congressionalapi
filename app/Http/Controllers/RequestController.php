<?php

namespace App\Http\Controllers;

use App\Models\requestForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;
use Ramsey\Uuid\Uuid;

class RequestController extends Controller
{
    public function displayRequest(){
        $displayList = requestForm::all();
        return response()->json($displayList);
    }

    public function displayRecentRequests()
    {
        $threeMonthsAgo = now()->subMonths(3);
        $displayList = requestForm::where('request_date', '>=', $threeMonthsAgo)->get();
        return response()->json($displayList);
    }

    public function storeRequest(Request $request){
        $countID = requestForm::count();
        $requestField = $request->validate([
            'control_number' => 'integer|required',
            'patients_name' => 'string|required',
            'representative_name' => 'string|required',
            'address' => 'string|required',
            'contact_number' => 'integer|required',
            'provider_id' => 'integer|required',
            'account_id' => 'integer|required',
            'amount' => 'integer|required',
            'request_provided' => 'string|required',
            'hospital_name' => 'string|nullable',
        ]);
        $requestField['request_date'] = Carbon::now();
        $requestField['control_number'] ='DND-125-' . $countID;
        $requestField['request_form_id'] = Uuid::uuid4()->toString();
        $requestField['is_active'] = true;
        $requestField['is_cancel'] = false;

        $requestForm = requestForm::create($requestField);

        return response()->json(['Store Request Success' , $requestForm] , 201);
    }
    public function updateRequest(Request $request, $request_form_id)
    {
        $requestForm = requestForm::where('request_form_id', $request_form_id)->first();

        if (!$requestForm) {
            return response()->json([
                'message' => 'Request not found'
            ], 404);
        }

        $validated = $request->validate([
            'patients_name' => 'required|string',
            'representative_name' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'required|integer',
            'provider_id' => 'required|integer',
            'account_id' => 'required|integer',
            'amount' => 'required|integer',
            'request_provided' => 'required|string',
            'request_date' => 'required|date',

            'is_cancel' => 'required|boolean',
            'cancel_information' => 'nullable|string',
        ]);

        if ($validated['is_cancel']) {
            if (empty($validated['cancel_information'])) {
                return response()->json([
                    'message' => 'Cancel information is required when cancelling a request'
                ], 422);
            }

            $validated['is_active'] = false;
        }

        /**
         * If not cancelled → clear cancel info
         */
        if (!$validated['is_cancel']) {
            $validated['cancel_information'] = null;
        }

        $requestForm->update($validated);

        return response()->json([
            'message' => 'Request updated successfully',
            'data' => $requestForm
        ], 200);
    }


}
