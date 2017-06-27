@extends('shared/tutor-layout')
@section('title', 'Session Details')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Lesson Session</h4>
                    <p class="category">Details of a lesson session</p>
                </div>
                <div class="card-content">
                    <h5 class="text-info">Student Details</h5>
                    <!-- Student & Subject -->
                    <div class="row">
                        <!-- Student -->
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label for="student" class="control-label">Student Name</label>
                                <input type="text" id="student" class="form-control" disabled
                                       value="{{ $lesson->student->getFirstName() . ' ' . $lesson->student->getLastName() }}" />
                            </div>
                        </div>
                        <!-- Subject -->
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label for="subject" class="control-label">Subject</label>
                                <input type="text" id="subject" class="form-control" disabled
                                       value="{{ $lesson->subject->name }}" />
                            </div>
                        </div>
                    </div>

                    <h5 class="text-info">Lesson Itinerary</h5>
                    <!-- Date, Start & End Times, Duration -->
                    <div class="row">
                        <!-- Lesson Date -->
                        <div class="col-md-3">
                            <div class="form-group label-floating">
                                <label id="lessonDate" class="control-label">Lesson Date</label>
                                <input type="text" class="form-control" name="lesson_date" id="lessonDate" disabled
                                       value="{{ $lesson->lesson_date }}" >
                            </div>
                        </div>
                        <!-- Start Time -->
                        <div class="col-md-3">
                            <div class="form-group label-floating">
                                <label for="start_time" class="control-label">Start Time</label>
                                <input type="text" id="start_time" name="start_time" class="form-control" disabled
                                       value="{{ $lesson->getStartTime() }}">
                            </div>
                        </div>
                        <!-- End Time -->
                        <div class="col-md-3">
                            <div class="form-group label-floating">
                                <label for="end_time" class="control-label">End Time</label>
                                <input type="text" id="end_time" name="end_time" class="form-control" disabled
                                       value="{{ $lesson->getEndTime() }}">
                            </div>
                        </div>
                        <!-- Lesson Duration -->
                        <div class="col-md-3">
                            <div class="form-group label-floating">
                                <label for="courseDuration" class="control-label">Duration</label>
                                <input type="text" class="form-control" name="duration" id="courseDuration" disabled
                                       value="{{ $lesson->duration }}"
                                       readonly="readonly" />
                            </div>
                        </div>
                    </div>

                    <!-- Location, Price, Status -->
                    <div class="row">
                        <!-- Location -->
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label for="location" class="control-label">Location</label>
                                <input type="text" class="form-control" id="location" disabled
                                       value="{{ $lesson->location }}" />
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label for="fee" class="control-label">Lesson Fee</label>
                                <input type="text" class="form-control" name="fee" id="fee" disabled
                                       value="{{ $lesson->getLessonFee() }}" />
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label for="status" class="control-label">Status</label>
                                <input type="text" class="form-control" id="status" value="{{ $lesson->status }}" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ url('/lessons') }}">Back to List</a>
            </div>
        </div>
    </div>
@endsection