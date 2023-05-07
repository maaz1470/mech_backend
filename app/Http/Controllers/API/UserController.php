<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|email|unique:users,email',
            'password'  => 'required'
        ]);

        if($validator->fails()){
            return Response()->json([
                'status'    => 401,
                'errors'    => $validator->errors()->all()
            ]);
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        

        if($user->save()){
            return Response()->json([
                'status'    => 200,
                'message'   => 'User saved successfully'
            ]);
        }


    }


    public function userLogin(Request $request){
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email|max:255',
            'password'  => 'required'
        ]);
        if($validator->fails()){
            return Response()->json([
                'status'    => 401,
                'errors'    => $validator->errors()->all()
            ]);
        }

        $user = User::where('email',$request->email)->get();
        return $user;
        
    }
}
