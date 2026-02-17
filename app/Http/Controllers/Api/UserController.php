<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterUserRequest $request)
    {
        $data = $request->safe()->all();
        $hashed = Hash::make($data['password']);

        $register = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $hashed,
            'role'     => $data['role']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'create user sucessfully',
            'data' => $register
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LoginUserRequest $request, User $user)
    {
        $data = $request->safe()->all();
        $user = User::where('email', $data['email'])->first();

        $comparePassword = Hash::check($data['password'], $user->password);

        if (!$user ||  !$comparePassword) {
            return response()->json([
                'success' => false,
                'message' => 'invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'login user sucessfully',
            'token' => $token
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'logout user sucessfully',
        ], 200);
    }
}
