<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Mail;
use Sentinel;

class ForgotPasswordController extends Controller
{
    // GET: /forgot-password
    public function forgotPassword() {
        return view('authentication.forgot-password');
    }

    // POST: /forgot-password
    public function postForgotPassword(Request $request) {
        // Find user to reset password
        $user = User::whereEmail($request->email)->first();

        // Avoid user from exploiting this functionality
        if(count($user) == 0) {
            return redirect()->back()->with(['success' => 'Reset code was sent to your email.']);
        }

        // Generate reset code, or find reset code for the user
        $reminder = Reminder::exists($user) ?: Reminder::create($user);
        $this->sendEmail($user, $reminder->code);
        return redirect()->back()->with(['success' => 'Reset code was sent to your email.']);
    }

    // GET: /reset/{resetCode}
    public function resetPassword($resetCode) {

        // Find user from activation code
        $userId = Reminder::whereCode($resetCode)->first()->user_id;
        $user = User::whereId($userId)->first();

        // Check if user exists
        if(count($user) == 0) {
            abort(404);
        }

        // Check if there is a reset code and it equals the one sent by the user
        if($reminder = Reminder::exists($user)) {
            if($resetCode == $reminder->code) {
                return view('authentication.reset-password');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }

    // POST: /reset
    public function postResetPassword(Request $request, $resetCode) {

        // Perform form validations
        $this->validate($request, [
            'password' => 'confirmed|required|min:5|max:10',
            'password_confirmation' => 'required|min:5|max:10'
        ]);

        // Find user from activation code
        $userId = Reminder::whereCode($resetCode)->first()->user_id;
        $user = User::whereId($userId)->first();

        // Check if user exists
        if(count($user) == 0) {
            abort(404);
        }

        // Check if there is a reset code and it equals the one sent by the user
        if($reminder = Reminder::exists($user)) {
            if($resetCode == $reminder->code) {
                Reminder::complete($user, $resetCode, $request->password);
                return redirect('/login')->with('success', 'Your password was changed successfully.');
            } else {
                return redirect('/login')->with('error', 'Unable to reset password.');
            }
        } else {
            return redirect('/login')->with('success', 'Unable to reset password.');
        }
    }

    /*
     * Function to send reset password code to user by email
     */
    private function sendEmail($user, $code) {
        Mail::send('emails.reset-password', [
            'user' => $user,
            'code' => $code
        ], function($message) use ($user) {
            $message->to($user->email);
            $message->subject('TMS-Plus password reset');
        });
    }
}
