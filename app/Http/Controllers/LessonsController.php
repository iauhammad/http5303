<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Student;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonsController extends Controller
{
    // GET: /lessons
    public function index()
    {
        $lessons = Lesson::where('status', '=', 'Upcoming')
                   ->orderBy('lesson_date', 'asc')
                   ->get();

        return view('lessons.index')->with('lessons', $lessons)
                                    ->with('menu', 'lessons');
    }

    // GET: /lessons/create
    public function create()
    {
        // Get ID of current user
        $userId = Sentinel::getUser()->id;

        // Get a list of tutor's students
        $lstStudents = Student::where('tutor_id', $userId)->get();

        // Get a list of subjects that are taught by tutor
        $lstSubjects = DB::select('SELECT * FROM subjects s
                                         WHERE EXISTS (SELECT 1
                                                         FROM list_of_subjects los
                                                        WHERE los.subject_id = s.id
                                                          AND los.tutor_id = ?)
                                         ORDER BY s.name', [$userId]);

        return view('lessons.create')->with('lstStudents', $lstStudents)
                                     ->with('lstSubjects', $lstSubjects)
                                     ->with('menu', 'lessons');
    }

    // POST: /lessons
    public function store(Request $request)
    {
        // -- Validate form on submission
        $this->validate($request, $this->rules);

        // -- Save new lesson schedule
        $lesson = new Lesson();
        $lesson->tutor_id = Sentinel::getUser()->id;
        $lesson->student_id = $request->student_id;
        $lesson->subject_id = $request->subject_id;
        $lesson->lesson_date = $request->lesson_date;
        $lesson->start_time = $request->start_time;
        $lesson->end_time = $request->end_time;
        $lesson->duration = $request->duration;
        $lesson->location = $request->location;
        $lesson->fee = $request->fee;
        $lesson->status = 'Upcoming';
        $lesson->save();

        return redirect(url('/lessons'))->with(['success' => 'New lesson was scheduled successfully.']);
    }

    // GET: /lessons/{id}
    public function show($id)
    {
        // Display lesson details
        $lesson = Lesson::find($id);
        if(count($lesson) == 0)
            abort(404, 'Page Not found');

        return view('lessons.show')->with('lesson', $lesson)
                                   ->with('menu', 'lessons');
    }

    // GET: /lessons/{id}/edit
    public function edit($id)
    {
        // Display lesson details
        $lesson = Lesson::find($id);
        if(count($lesson) == 0)
            abort(404, 'Page Not found');

        return view('lessons.edit')->with('lesson', $lesson)
                                   ->with('lessonStatus', $this->lessonStatus)
                                   ->with('menu', 'lessons');
    }

    // POST: /lessons/{id}
    public function update(Request $request, $id)
    {
        // -- Validate form on submission
        $this->validate($request, $this->updateRules);

        // -- Update lesson's itinerary
        $lesson = Lesson::find($id);
        $lesson->lesson_date = $request->lesson_date;
        $lesson->start_time = $request->start_time;
        $lesson->end_time = $request->end_time;
        $lesson->duration = $request->duration;
        $lesson->fee = $request->fee;
        $lesson->status = $request->status;
        $lesson->save();

        return redirect(url('/lessons'))->with(['success' => 'Lesson\'s itinerary has been updated successfully.']);
    }

    // POST: /lessons/{id}
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect(url('/lessons'))->with(['success' => 'Lesson has been deleted.']);
    }

    // POST: /studentCourses
    public function coursesEnrolled(Request $request)
    {
        if($request->ajax()) {
            $student = Student::find($request->input('studentId'));
            $subjects = DB::table('subjects')
                        ->join('enrollments', 'subjects.id', '=', 'enrollments.subject_id')
                        ->where('enrollments.student_id', '=', $student->id)
                        ->get();

            return view('lessons.courses-available')->with('subjects', $subjects);
        }
    }

    // GET: /lessons/history
    public function history() {
        $lessons = Lesson::where('status', '<>', 'Upcoming')
                   ->orderBy('lesson_date', 'desc')
                   ->get();

        return view('lessons.history')->with('lessons', $lessons)
                                      ->with('menu', 'lessons');
    }

    // -- Validation rules
    private $rules = [
        'student_id' => 'required',
        'subject_id' => 'required',
        'lesson_date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'duration' => 'required|numeric|min:0.5',
        'location' => 'required',
        'fee' => 'required|integer|min:1'
    ];

    private $updateRules = [
        'lesson_date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'duration' => 'required|numeric|min:0.5',
        'location' => 'required',
        'fee' => 'required|integer|min:1'
    ];

    // List of Provinces
    private $lessonStatus = array(
        "Upcoming" => "Upcoming",
        "Done" => "Done",
        "Cancelled" => "Cancelled"
    );

}
