<?php

namespace App\Http\Controllers;

use App\Models\MasterlistModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MasterListController extends Controller
{
    public function displayPersonel(){
        $displayPersonel = MasterlistModel::all();
        return response()->json($displayPersonel);
    }
    public function displayPersonelbyID($id){
        $displayPersonel = MasterlistModel::where('area_id' , $id)->get();

        return response()->json($displayPersonel);
    }
    
    public function storePersonel(Request $request){
        $PersonelFields = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|integer',
            'affiliate' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'parallel_id' => 'nullable|integer|max:255',
            'area_id' => 'required|integer|max:255',
            'created_by' => 'nullable|integer',
        ]);

        $PersonelFields['is_active'] = true;
        $PersonelFields['date_created'] = Carbon::now();

        $Personel = MasterlistModel::create($PersonelFields);

        return response()->json(['message' => 'Personel Added successfully', 'data' => $Personel], 201);
    }
}
