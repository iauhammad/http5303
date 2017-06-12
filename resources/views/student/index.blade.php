@extends('shared.tutor-layout')
@section('title', 'Student')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <!-- Display success message (if any) -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Links to manage students -->
            <div class="pull-right">
                <!-- Link to register new student -->
                <a href="{{ url('/students/create') }}" class="btn btn-primary" title="Click to register a new student">
                    <i class="material-icons">person_add</i>&nbsp;&nbsp;New Registration
                </a>
                <!-- Link to go to enrollment page -->
                <a href="{{ route('students.enroll') }}" class="btn btn-primary" title="Enroll students in courses">
                    <i class="material-icons">assignment</i>&nbsp;&nbsp;Enrollment
                </a>
            </div>



            <!-- Table listing all students -->
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Students</h4>
                    <p class="category">List of registered students</p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Grade</th>
                            <th>Parent Name</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @if(count($students) == 0)
                            <tr>
                                <td colspan="6" class="text-warning">You currently have no registered students.</td>
                            </tr>
                        @else
                            @foreach($students as $objStudent)
                                <tr>
                                    <td>{{ $objStudent->first_name }}</td>
                                    <td>{{ $objStudent->last_name }}</td>
                                    <td>{{ ($objStudent->gender == "M")? "Male" : "Female" }}</td>
                                    <td>Grade {{ $objStudent->grade }}</td>
                                    <td>{{ $objStudent->parent_fname }}</td>
                                    <td>
                                        <a href="{{ url('/students', $objStudent->id) }}">Details</a> |
                                        <a href="{{ route('students.edit', $objStudent->id) }}">Edit</a> |
                                        <a href="{{ url('/delete-student', $objStudent->id) }}">Delete</a>
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