<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->first();
        if ($user) {
            $user->email_verified_at = Carbon::now();
            $user->verification_token = null;
            $user->save();
            return redirect('/')->with('message', 'Email verified successfully');
        }
        return redirect('/')->with('message', 'Invalid verification link');
    }
}
