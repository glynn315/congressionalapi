<?php

namespace App\Http\Controllers;

use App\Models\AccountManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountManagementController extends Controller
{
     public function displayAccounts()
    {
        $accounts = AccountManagement::all();
        return response()->json($accounts);
    }

    /**
     * Store a new account.
     */
    public function storeAccount(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:account_management,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'created_by' => 'nullable|integer',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;
        $validated['is_newaccount'] = true;
        $validated['date_created'] = Carbon::now();

        $account = AccountManagement::create($validated);

        return response()->json(['message' => 'Account created successfully', 'data' => $account], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid username or password'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
