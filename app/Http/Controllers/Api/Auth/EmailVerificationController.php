<?php


namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('token', $token)->first();
        if($user->status == 0){
            $user->update(['status' => 1,'email_verified_at' => now()]);

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }
        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'already verified'
        ]);
    }
}
