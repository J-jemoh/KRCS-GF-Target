<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Log;

class TwoFactorAuthController extends Controller
{
    //
    public function show2faForm (){
        return view('auth.2fa');
    }
       public function verifyGoogleAuthenticator(Request $request)
    {
        // Validate the Google Authenticator code
        $request->validate([
            'code' => 'required|string',
        ]);
        // Store the code in the session
        $request->session()->put('code', $request->input('code'));

        // Retrieve the hashed secret key from the database
        $hashedSecret = Auth::user()->google2fa_secret;
        // Verify the Google Authenticator code
        $google2fa = new Google2FA();
        $isValid = $google2fa->verifyKey($hashedSecret, $request->code);
        Log::debug('Is valid code: ' . ($isValid ? 'true' : 'false'));
        if ($isValid) {
        // Code is valid, proceed to dashboard
        $request->session()->put('2fa_authenticated', true);
        return redirect('/admin/dashboard');
        } else {
            // Invalid code, return back to verification page with error message
            return redirect()->route('2fa.setup')->withErrors(['google2fa_code' => 'Invalid Google Authenticator code'])
                ->withInput(); // Retain the input data (code) in the form
        }
    }
}
