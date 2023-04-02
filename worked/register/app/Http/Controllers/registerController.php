<?php

namespace App\Http\Controllers;

use App\Models\register;
use Illuminate\Http\Request;

class registerController extends Controller
{
    public function register(Request $request){
        $user = register::create([

            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

    return response()->json(["message"=>"user created", 'infos' => $user] );
}
}
