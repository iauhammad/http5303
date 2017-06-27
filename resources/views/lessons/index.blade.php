@extends('shared/tutor-layout')
@section('title', 'Lessons')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <!-- Display success message (if any) -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Links to manage lessons -->
            <div class="pull-right">
                <!-- Link to create a new lesson session -->
                <a href="{{ url('/lessons/create') }}" class="btn btn-primary" title="Add a new lesson session">
                    <i class="material-icons">note_add</i>&nbsp;&nbsp;Add Lesson
                </a>
                <!-- Link to go to enrollment page -->
                <a href="{{ route('lessons.history') }}" class="btn btn-primary" title="View history of past lesson sessions">
                    <i class="material-icons">info_outline</i>&nbsp;&nbsp;Lessons History
                </a>
            </div>



            <!-- Table listing all future lesson sessions -->
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Upcoming Lessons</h4>
                    <p class="category">List of scheduled lesson sessions</p>
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
                                    @if(strtotime($objLesson->lesson_date) < strtotime('now'))
                                        class="past-date"
                                        title='The lesson date is in the past. Please update the status.'
                                    @endif
                                >
                                    <td>{{ $objLesson->student->first_name }}</td>
                                    <td>{{ $objLesson->subject->name }}</td>
                                    <td>{{ $objLesson->lesson_date }}</td>
                                    <td>{{ $objLesson->getStartTime() . ' - ' . $objLesson->getEndTime() }}</td>
                                    <td>{{ $objLesson->location }}</td>
                                    <td>
                                        <a href="{{ route('lessons.show', $objLesson->id) }}">Details</a> |
                                        <a href="{{ route('lessons.edit', $objLesson->id) }}">Edit</a> |
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