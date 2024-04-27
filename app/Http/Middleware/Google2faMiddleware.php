<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class Google2faMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->google2fa_secret) {
            if ($request->route()->getName() !== '2fa.setup') {
                // Check if user has already passed 2FA verification
                if (!session()->has('2fa_passed')) {
                    // If not, check if the request contains the 2FA code
                    if (!$request->has('code')) {
                        // If code is not provided, redirect to setup with an error
                        return redirect()->route('2fa.setup')->withErrors(['google2fa_code' => 'Google Authenticator code is required'])->withInput();
                    }

                    $code = $request->input('code');
                    $hashedSecret = Auth::user()->google2fa_secret;

                    // Verify the provided code
                    $google2fa = new Google2FA();
                    $isValid = $google2fa->verifyKey($hashedSecret, $code);

                    if (!$isValid) {
                        // If code is invalid, redirect to setup with an error
                        return redirect()->route('2fa.setup')->withErrors(['google2fa_code' => 'Invalid Google Authenticator code'])->withInput();
                    }

                    // Mark 2FA verification as passed for this session
                    session(['2fa_passed' => true]);
                }
            }
        }

        return $next($request);
    }
}

