<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\EmailVerification as Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

class EmailIsVerified
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = User::where('email', $request['email'])->first();
        if ($user->status == 0) {
            // Mail::to($request->$request['email'])->send(new EmailVerification($user));
            return response()->json(['message' => 'email not Verified'],401);
        }
        return $next($request);
    }
}
