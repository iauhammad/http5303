<?php

namespace App\Http\Controllers;

use App\SelectedSubject;
use App\Subject;
use App\Tutor;
use App\User;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TutorController extends Controller
{
    // GET: /dashboard
    public function index() {
        return view('tutor.index')->with('menu', 'dashboard');
    }

    // GET: /profile-setup
    public function setup() {

        // Find logged in user
        $user = User::find(Sentinel::getUser()->id);

        // Check if tutor profile is setup or not
        $tutor = Tutor::whereUserId($user->id)->first();
        if(count($tutor) == 0) {
            $tutor = new Tutor();
        }

        return view('tutor.profile-setup')->with('user', $user)
                                          ->with('tutor', $tutor)
                                          ->with('province', $this->province)
                                          ->with('menu', 'profile');
    }

    // POST: /profile-setup
    public function postSetup(Request $request) {
        // Add tutor's details to the DB
        $this->validate($request, $this->rules);

        // Find current user
        $user = User::find($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->display_name = $request->display_name;
        $user->save();

        // Find tutor profile of logged in user
        $objTutor = Tutor::whereUserId($user->id)->first();
        if(count($objTutor) == 0)
            $objTutor = new Tutor();

        $objTutor->user_id = $request->user_id;
        $objTutor->street_address = $request->street_address;
        $objTutor->city = $request->city;
        $objTutor->province = $request->province;
        $objTutor->postal_code = $request->postal_code;
        $objTutor->phone_number = $request->phone_number;
        $objTutor->gender = $request->gender;
        $objTutor->biography = $request->biography;
        $objTutor->save();

        // Redirect to profile details again
        return redirect(url('/profile-setup'));
    }

    // GET: /profile-details/id
    public function show($id) {
        $tutor = Tutor::find($id);
        $user = User::find($tutor->user_id);
        return $tutor;
        //return view('tutor.show')->with('tutor', $tutor);
    }

    // GET: /subjects
    public function subjects() {
        // Get ID of current user
        $userId = Sentinel::getUser()->id;
        // Get a list of subjects that tutor doesn't teach
        $availableSubjects = DB::select('SELECT * FROM subjects s
                                          WHERE NOT EXISTS (SELECT 1
                                                              FROM list_of_subjects los
                                                             WHERE los.subject_id = s.id
                                                               AND los.tutor_id = ?)
                                          ORDER BY s.name', [$userId]);
        // Get a list of subjects that are taught by tutor
        $selectedSubjects = DB::select('SELECT * FROM subjects s
                                         WHERE EXISTS (SELECT 1
                                                         FROM list_of_subjects los
                                                        WHERE los.subject_id = s.id
                                                          AND los.tutor_id = ?)
                                         ORDER BY s.name', [$userId]);
        return view('tutor.subjects')->with('lstAvailableSubjects', $availableSubjects)
                                     ->with('lstSelectedSubjects', $selectedSubjects)
                                     ->with('menu', 'subjects');
    }

    // POST: /addSubject
    public function addSubject(Request $request) {
        if($request->ajax()){

            $subject = new SelectedSubject();
            $subject->tutor_id = Sentinel::getUser()->id;
            $subject->subject_id = $request->input('subjectId');
            $subject->save();

            $subject = Subject::find($request->input('subjectId'));
            return view("tutor.ajax-subject")->with("subject", $subject);
        }
    }

    // POST: /delSubject
    public function delSubject(Request $request) {
        if($request->ajax()) {
            $tempSubject = Subject::find($request->input('subjectId'));
            SelectedSubject::where(['tutor_id' => Sentinel::getUser()->id,
                                    'subject_id' => $request->input('subjectId')])
                             ->delete();
            return view("tutor.ajax-subject")->with("subject", $tempSubject);
        }
    }

    public function newSubject(Request $request)
    {
        if($request->ajax()) {
            // Add new subject
            $subject = new Subject();
            $subject->name = ucfirst(strtolower($request->input('subject_name')));
            $subject->save();

            // Add subject to current tutor's list
            $selectSubject = new SelectedSubject();
            $selectSubject->tutor_id = Sentinel::getUser()->id;
            $selectSubject->subject_id = $subject->id;
            $selectSubject->save();

            // Return new subject as a list item
            return view("tutor.ajax-subject")->with("subject", $subject);
        }
    }

    // Validation rules
    private $rules = [
        'street_address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'postal_code' => 'required|regex:/^[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ] ?[0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]$/i',
        'phone_number' => ['required', 'regex:/^[0-9]{3}[ |-]?[0-9]{3}[ |-]?[0-9]{4}$/'],
        'gender' => 'required'
    ];

    // List of Provinces
    private $province = array(
        "ON" => "Ontario",
        "QC" => "Quebec",
        "BC" => "British Columbia",
        "AB" => "Alberta",
        "MB" => "Manitoba",
        "SK" => "Saskatchewan",
        "NS" => "Nova Scotia",
        "NB" => "New Brunswick",
        "NL" => "Newfoundland and Labrador",
        "PE" => "Prince Edward Island",
        "NT" => "Northwest Territories",
        "YT" => "Yukon",
        "NU" => "Nunavut"
    );

}
