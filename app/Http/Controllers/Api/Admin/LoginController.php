<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->validated()) && auth()->user()->is_admin == 1) {
            info(auth()->user()->createToken('aasasasas'));
            $accessToken = auth()->user()->createToken('aasasasas')->accessToken;
            $userResponse = User::with('userable')->where('id', auth()->id())->first();
            
            return response()->json([
                'token' => $accessToken,
                'space_name' => auth()->user()->userable_type == 'App\Models\Candidate' ? 'candidate' :'enterprise',
                'user' => $userResponse,
            ], 200);


        } else {
            return response()->json([
                'error' => __('LoginFailed'),
                'message' => 'failed',
        ], 401);
        }
    }
    public function logout (Request $request) {
        $accessToken = auth()->user()->token();
        $token= $request->user()->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);
        }
}
