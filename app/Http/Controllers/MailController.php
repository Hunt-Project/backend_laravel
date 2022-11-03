<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Foundation\Auth\VerifiesEmails;

class MailController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    public function sendMail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    }

    public function resend(Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    protected function redirectTo() {
        return '/home';
    }

    



    public function confirmMail(Request $request) {
        //event(new Registered($user));
    }
}
