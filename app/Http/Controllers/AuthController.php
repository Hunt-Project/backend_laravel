<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
       ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        
        $user->sendEmailVerificationNotification();

        return response()->json([
            'result'=>true,
            'access_token' => $token, 
            'token_type' => 'Bearer', 
        ]);

    }

    public function login(Request $request) {
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        //return $validator;

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'result' => false,
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([ 
            'result'=>true,
            'access_token' => $token, 
            'token_type' => 'Bearer', 
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();  // Disconnette tutte le sessioni
    }

    public function sessions(Request $request) {
        $sess = $request->user()->tokens()->get();
        return response()->json($sess);
    }

    public function me(Request $request) {
        return $request->user();
    }

    public function state(Request $request) {
        return response()->json([
            'result'=>true,
            'message' => 'OK'
        ]);
    }
}