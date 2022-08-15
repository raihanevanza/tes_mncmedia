<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => $validator->getMessageBag()
            ], 200);
        }

        $input = $request->all();
        $input['password'] = $input['password'];
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return  response()->json(['message' => 'User register successfully.', 'data' => $success]);
    }

    public function login(Request $request)
    {
        $user = User::where(['email' => $request->email, 'password' => $request->password])->first();
        if (!$user) {
            return response()->json([
                'message' => 'unauthorized'
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'message' => 'success',
            'data' =>  $user,
            'token' => $token
        ], 200);
    }
}
