<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\User;
use Mail;

class RegistrationController extends Controller
{
    // GET: /register
    public function register() {
        return view('authentication.register');
    }

    // POST: /register
    public function postRegister(Request $request) {
        // Register a new user
        //$user = Sentinel::registerAndActivate($request->all());
        $user = Sentinel::register($request->all());

        // Create an activation for that user
        $activation = Activation::create($user);

        // Give the user a role of 'tutor'
        $role = Sentinel::findRoleBySlug('tutor');
        $role->users()->attach($user);
        
        // Email activation code to user
        $this->sendEmail($user, $activation->code);

        return redirect('/');
    }

    // GET: /activate
    public function activate($activationCode) {
        // Find user from activation code
        $userId = Activation::whereCode($activationCode)->first()->user_id;
        $user = User::whereId($userId)->first();

        // Activate user's account
        if(Activation::complete($user, $activationCode)) {    // function takes user and activation code
            return redirect('/login');
        } else {
            return redirect('/');
        }
    }

    /*
     * Private function to send activation code to a user by email
     */
    private function sendEmail($user, $activationCode) {
        Mail::send('emails.activation', [
            'user' => $user,
            'code' => $activationCode
        ], function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Activate your TMS-Plus Account");
        });
    }
}
