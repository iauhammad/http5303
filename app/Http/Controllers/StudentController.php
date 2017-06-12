<?php

namespace App\Http\Controllers;

use App\Enrollment;
use App\SelectedSubject;
use App\Student;
use App\Subject;
use App\User;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // List of students
        //$students = Student::all();
        $students = Student::where('tutor_id', Sentinel::getUser()->id)->get();
        return view('student.index')->with('students', @$students)
                                    ->with('menu', 'students');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Display form to register a new student
        $user = User::find(Sentinel::getUser()->id); // Find logged in user
        return view('student.create')->with('user', $user)
                                     ->with('lstGrades', $this->lstGrades)
                                     ->with('menu', 'students');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add new student's detail to the DB
        $this->validate($request, $this->rules);

        $student = new Student();
        $student->tutor_id = $request->tutor_id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->grade = $request->grade;
        $student->parent_fname = $request->parent_fname;
        $student->parent_lname = $request->parent_lname;
        $student->parent_phone_number = $request->parent_phone_number;
        $student->parent_email = $request->parent_email;
        $student->save();

        return redirect(url('/students'))->with(['success' => 'Student was registered successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Display student details
        $student = Student::find($id);
        if(count($student) == 0)
            return "<h1>404 - Page Not Found</h1>";

        return view('student.show')->with('student', $student)
                                   ->with('lstGrades', $this->lstGrades)
                                   ->with('menu', 'students');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Display edit form
        $student = Student::find($id);

        if(count($student) == 0)
            return "<h1>404 - Page Not Found</h1>";

        return view('student.edit')->with('student', $student)
                                    ->with('lstGrades', $this->lstGrades)
                                    ->with('menu', 'students');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update changes to student's profile
        $student = Student::find($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->date_of_birth;
        $student->grade = $request->grade;
        $student->parent_fname = $request->parent_fname;
        $student->parent_lname = $request->parent_lname;
        $student->parent_phone_number = $request->parent_phone_number;
        $student->parent_email = $request->parent_email;
        $student->save();

        return redirect(url('/students'))->with(['success' => 'Student details updated successfully.']);
    }

    // GET: /delete-student
    public function confirmDelete($id)
    {
        // Display confirm delete view
        $student = Student::find($id);

        if(count($student) == 0)
            return "<h1>404 - Page Not Found</h1>";

        return view('student.delete')->with('student', $student)
                                     ->with('lstGrades', $this->lstGrades)
                                     ->with('menu', 'students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // Delete student would just dis-activate student's account to still keep lessons history
        return ("Delete student $id");
    }

    // GET: /students/enroll
    public function enrollStudent()
    {
        // -- Find list of students for current tutor
        $lstStudents = Student::where('tutor_id', Sentinel::getUser()->id)->get();
        return view('student.enrollment')->with('lstStudents', $lstStudents)
                                         ->with('menu', 'students');
    }

    // POST: /coursesEnrolled
    public function coursesEnrolled(Request $request)
    {
        $student = Student::find($request->input('studentId'));
        $subjects = DB::table('subjects')
                    ->join('enrollments', 'subjects.id', '=', 'enrollments.subject_id')
                    ->where('enrollments.student_id', '=', $student->id)
                    ->get();

        return view('student.coursesEnrolled')->with('student', $student)
                                              ->with('subjects', $subjects);
    }

    // POST: /coursesAvailable
    public function coursesAvailable(Request $request)
    {
        $tutorId = Sentinel::getUser()->id;

        $subjects = DB::table('subjects')
                    ->join('list_of_subjects', 'list_of_subjects.subject_id', '=', 'subjects.id')
                    ->where('list_of_subjects.tutor_id', '=', $tutorId)
                    ->whereNotExists(function($query) use($request) {
                        $query->select(DB::raw(1))
                            ->from('enrollments')
                            ->where('student_id', '=', $request->input('studentId'))
                            ->whereRaw('enrollments.subject_id = subjects.id');
                    })
                    ->get();

        return view('student.courses-available')->with('subjects', $subjects);
    }

    // POST: /enrollStudent
    public function enrollToCourse(Request $request)
    {
        // Enroll student to course
        $enrollStudent = new Enrollment();
        $enrollStudent->student_id = $request->student_id;
        $enrollStudent->subject_id = $request->subject_id;
        $enrollStudent->save();

        // Return new id
        return $enrollStudent->id;
    }

    // POST: /disenrollStudent
    public function disenrollCourse(Request $request)
    {
        if($request->ajax()) {
            $enrollment = Enrollment::find($request->input('id'));
            $enrollment->delete();
            return "DELETED";
        }
    }


    // -- Validation rules
    private $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'gender' => 'required',
        'date_of_birth' => 'required|before:today',
        'grade' => 'required',
        'parent_fname' => 'required',
        'parent_lname' => 'required',
        'parent_phone_number' => ['required', 'regex:/^[0-9]{3}[ |-]?[0-9]{3}[ |-]?[0-9]{4}$/'],
        'parent_email' => 'required|email'
    ];

    // -- List of school grade options
    private $lstGrades = array(
        " " => "-- Select a grade --",
        "1" => "Grade 1",
        "2" => "Grade 2",
        "3" => "Grade 3",
        "4" => "Grade 4",
        "5" => "Grade 5",
        "6" => "Grade 6",
        "7" => "Grade 7",
        "8" => "Grade 8",
        "9" => "Grade 9",
        "10" => "Grade 10",
        "11" => "Grade 11",
        "12" => "Grade 12",
        "100" => "Self-Learning"
    );
}
