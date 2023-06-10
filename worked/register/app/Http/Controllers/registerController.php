<?php

namespace App\Http\Controllers;

use App\Models\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
//     public function register(Request $request){
//         $user = register::create([

//             'username' => $request->input('username'),
//             'password' => $request->input('password'),
//         ]);

//     return response()->json(["message"=>"user created", 'infos' => $user] );
// }

public function register(request $request){
    $fields = $request->validate([
        'username'=>'required|string',
        'password'=>'required|string|'
    ]);

    $user = register::create([
        'username'=> $fields['username'],
        'password'=> $fields['password']
    ]);

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response =[
        'user'=> $user,
        'token'=> $token
    ];

    return response($response, 201);
    
}


}
