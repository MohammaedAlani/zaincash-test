<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Requsest;
use App\User;
use JWTFactory;
use Validator;
use Response;
use JWTAuth;

class APIRgister extends Controller
{
    public function register( Request $request){
        //input information of the user
        $validator = Validator::make($request -> all(),[
         'email' => 'required|string|email|max:255|unique:users', //uniqe , email fashion and non empty
         'name' => 'required', //non empty
         'age'=> 'required|integer' // vrifed is integer and non empty
        ]);
        
        if($validator -> fails()) {
           
            return response()->json(['status' => false,$validator->errors()]);
            
        }
        else{
            User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'age'=> $request->get('age'),
            ]);
            $user = User::first();
            $token = JWTAuth::fromUser($user);
            return Response::json(true);
            }

        
    }
}
