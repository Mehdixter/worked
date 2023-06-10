<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(request $request){
        $fields = $request->validate([
            'username'=>'required|string',
            'password'=>'required|string'
        ]);
    
        //check email
        $user = User::where('username', $fields['username'])->first();
        //check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'nad creds'
            ], 401);
        }
    
        $token = $user->createToken('myapptoken')->plainTextToken;
    
        $response =[
            'user'=> $user,
            'token'=> $token
        ];
    
        return response($response, 201);
        
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        return[
            'message' => 'Logged out'
        ];
    }
}
