<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Tutor;

class LoginController extends Controller
{
    // GET: /login
    public function login() {
        return view('authentication.login');
    }

    // POST: /login
    public function postLogin(Request $request) {

        try {
            // Handle 'Remember me' option
            $rememberMe = false;
            if(isset($request->remember_me)) {
                $rememberMe = true;
            }

            // Check log in credentials of a user
            if(Sentinel::authenticate($request->all(), $rememberMe)) {
                // Get the role of the authenticated user
                $slug =Sentinel::getUser()->roles()->first()->slug;

                if($slug == 'tutor') {
                    // Check if tutor profile is setup or not
                    $tutorProfile = Tutor::whereUserId(Sentinel::getUser()->id)->first();
                    if(count($tutorProfile) == 0) {
                        return redirect('/profile-setup');
                    }

                    // Else, redirect to tutor dashboard
                    return redirect('/dashboard');

                } elseif($slug == 'admin') {
                    return redirect('/');
                    // TODO: Redirect admin to their dashboard
                }
            } else {
                // If login fails, redirect back with an error message
                return redirect()->back()->with(['error' => 'Username/Password incorrect.']);
            }

        } catch (ThrottlingException $ex) {
            $delay = $ex->getDelay();
            return redirect()->back()->with(['error' => "Your account has been suspended for $delay seconds."]);

        } catch (NotActivatedException $ex) {
            return redirect()->back()->with(['error' => "Your account is not activated."]);
        }

    }

    // POST: /logout
    public function logout() {
        Sentinel::logout();
        return redirect('/login');
    }

}
