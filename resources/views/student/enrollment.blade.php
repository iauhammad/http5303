@extends('shared.tutor-layout')
@section('customMetas')
<meta name="csrf-token" content="{!! csrf_token() !!}">
@endsection
@section('title', 'Student Enrollment')

@section('body')
    <div class="row">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Students' Enrollment</h4>
                <p class="category">Use the form below to enroll students in a particular course.</p>
            </div>
            <div class="card-content">
                <h5 class="text-info">Student Enrollment</h5>
                <!-- Students & Subjects -->
                <div class="row">
                    <!-- List of Students -->
                    <div class="col-md-5">
                        <div class="form-group label-floating">
                            <label for="sltStudent" class="control-label">Student</label>
                            <select name="student" id="sltStudent" class="form-control">
                                <option value="0">-- Select a student --</option>
                                @foreach($lstStudents as $objStudent)
                                    <option value="{{ $objStudent->id }}" >
                                        {{ $objStudent->getFirstName() .' ' . $objStudent->getLastName() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-danger" id="errStudent"></div>
                    </div>
                    <!-- Subject -->
                    <div class="col-md-5">
                        <div class="form-group label-floating">
                            <label for="sltSubject" class="control-label">Subjects</label>
                            <select name="subject" id="sltSubject" class="form-control" disabled>
                                <option value=" ">-- Select a subject --</option>
                            </select>
                        </div>
                        <div class="text-danger" id="errSubject"></div>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="button" id="btnEnrollStudent" class="btn btn-primary pull-right"
                                data-background-color="blue">Enroll</button>
                    </div>
                </div>

                <!-- Page section to display a student's enrollment details -->
                <div id="enrollmentDetails"></div>

            </div>
        </div>
        <div>
            <a href="{{ url('/students') }}">Back to List</a>
        </div>
    </div>
    <script src="{{ asset('js/enrollments.js') }}" type="text/javascript"></script>
@endsection