<?php

namespace App\Http\Controllers;

use App\Models\AreaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function dropdownArea(){
        $dropdownArea = AreaModel::all();

        return response()->json($dropdownArea);
    }

    public function storeArea(Request $request){
        $areaFields = $request->validate([
            'areaInformation' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'created_by' => 'nullable|integer',
        ]);

        $areaFields['is_active'] = true;
        $areaFields['date_created'] = Carbon::now();

        $Area = AreaModel::create($areaFields);

        return response()->json(['message' => 'Area Added successfully', 'data' => $Area], 201);
    }
}
