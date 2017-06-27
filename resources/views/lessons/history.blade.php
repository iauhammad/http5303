@extends('shared/tutor-layout')
@section('title', 'Lessons')

@section('body')
<div class="row">
    <div class="col-md-12">
        <!-- Display success message (if any) -->
        @if(session('success'))
        <div class="alert alert-success green-text">
            {{ session('success') }}
        </div>
        @endif

        <!-- Links to manage lessons -->
        <div class="pull-right">
            <!-- Link to create a new lesson session -->
            <a href="{{ url('/lessons/create') }}" class="btn btn-primary" title="Click to add a new lesson session">
                <i class="material-icons">note_add</i>&nbsp;&nbsp;Add Lesson
            </a>
            <!-- Link to go to enrollment page -->
            <a href="{{ route('students.enroll') }}" class="btn btn-primary" title="Enroll students in courses">
                <i class="material-icons">info_outline</i>&nbsp;&nbsp;Lessons History
            </a>
        </div>



        <!-- Table listing all future lesson sessions -->
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Lessons History</h4>
                <p class="category">List of lesson sessions taught or cancelled</p>
            </div>
            <div class="card-content table-responsive">
                <table class="table">
                    <thead class="text-primary">
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @if(count($lessons) == 0)
                    <tr>
                        <td colspan="6" class="text-warning">You currently have no upcoming lessons.</td>
                    </tr>
                    @else
                    @foreach($lessons as $objLesson)
                    <tr
                        @if($objLesson->status == 'Cancelled')
                            class="cancelled-session" title="Cancelled session"
                        @endif
                    >
                        <td>{{ $objLesson->student->first_name }}</td>
                        <td>{{ $objLesson->subject->name }}</td>
                        <td>{{ $objLesson->lesson_date }}</td>
                        <td>{{ $objLesson->getStartTime() . ' - ' . $objLesson->getEndTime() }}</td>
                        <td>{{ $objLesson->location }}</td>
                        <td>
                            <a href="{{ route('lessons.show', $objLesson->id) }}">Details</a> |
                            <a href="#"
                               onclick="document.getElementById('delete-lesson{{$objLesson->id}}').submit()">Delete</a>
                            <form action="{{ route('lessons.destroy', $objLesson->id) }}"
                                  method="post" id="delete-lesson{{$objLesson->id}}">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection