<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function index()
    {
        $staffs = DB::table('users')
        ->where('role', '!=', 'customer')
        ->orderBy('id', 'desc')
        ->get();

        return response([
            'staffs' => $staffs,
        ]);
    }



    public function register(StoreAuthRequest $request)
    {
        $data = $request->validated();


        $user = User::create([
            'name' => $data['full_name'],
            'other_name' => $data['other_name'],
            'role_id' => $data['role_id'],
            'branch_id' => $data['branch_number'],
            // 'staff_created_by' => $data['staff_created_by'],
            'role' => $data['role'],
            'email' => $data['email'],
            'number' => $data['phone_number'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'number' => 'required|numeric|exists:users,number',
            'password' => [
                'required'
            ],
            'remember' => 'boolean',
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => 'The Provided credentials are not correct'
            ], 422);
        }
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        // var_dump($user->role);

        return response([
            'user' => $user,
            'token' => $token,
            'uer_role' => $user->role
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response([
            'success' => true
        ]);
    }

    public function deleteStaff(User $user)
    {
        $user->delete();
        return response('', 204);
    }

    public function countStaffs()
    {
        $staffs = DB::table('users')
        ->where('role', '!=', 'customer')
        ->count();

        return [
            'staffsCount' => $staffs,
        ];
    }
}
