@extends('shared/tutor-layout')
@section('customMetas')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
@endsection
@section('title', 'New Lesson')

@section('body')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Lesson Registration</h4>
                    <p class="category">Complete the following form to register a new lesson for a student</p>
                </div>
                <div class="card-content">
                    <form action="{{ url('/lessons') }}" method="post">
                        <!-- CSRF Token -->
                        {{ csrf_field() }}

                        <h5 class="text-info">Student Details</h5>
                        <!-- Student & Subject -->
                        <div class="row">
                            <!-- Student -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="sltStudent" class="control-label">Student Name</label>
                                    <select name="student_id" id="sltStudent" class="form-control">
                                        <?php $selectedStudent = Request::old('student_id'); ?>
                                        <option value=" ">-- Select a student --</option>
                                        @foreach($lstStudents as $objStudent)
                                            <option value="{{ $objStudent->id }}"
                                                    {{ ($objStudent->id == $selectedStudent)? 'selected' : '' }} >
                                                {{ $objStudent->getFirstName() .' ' . $objStudent->getLastName() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger">{{ $errors->first('student_id') }}</div>
                            </div>
                            <!-- Subject -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="sltSubject" class="control-label">Subject</label>
                                    <select name="subject_id" id="sltSubject" class="form-control"
                                            {{ Request::old('subject_id') !== null ? '' : 'disabled' }} >
                                        <?php $selectedSubject = Request::old('subject_id'); ?>
                                        <option value=" ">-- Select a subject --</option>
                                        @foreach($lstSubjects as $objSubject)
                                            <option value="{{ $objSubject->id }}"
                                                    {{ ($objSubject->id == $selectedSubject)? 'selected' : '' }} >
                                                {{ $objSubject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                            </div>
                        </div>


                        <h5 class="text-info">Lesson Itinerary</h5>
                        <!-- Date, Start & End Times, Duration -->
                        <div class="row" id="datePairFields">
                            <!-- Lesson Date -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">Lesson Date</label>
                                    <input type="text" class="form-control" name="lesson_date" id="lessonDatePicker"
                                           value="{{ Request::old('lesson_date') }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('lesson_date') }}</div>
                            </div>
                            <!-- Start Time -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label for="start_time" class="control-label">Start Time</label>
                                    <input type="text" id="start_time" name="start_time" autocomplete="off"
                                           class="time ui-timepicker-input form-control"
                                           value="{{ Request::old('start_time') }}">
                                </div>
                                <div class="text-danger">{{ $errors->first('start_time') }}</div>
                            </div>
                            <!-- End Time -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">End Time</label>
                                    <input type="text" id="end_time" name="end_time" autocomplete="off"
                                           class="time ui-timepicker-input form-control"
                                           value="{{ Request::old('end_time') }}">
                                </div>
                                <div class="text-danger">{{ $errors->first('end_time') }}</div>
                            </div>
                            <!-- Lesson Duration -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">Duration</label>
                                    <input type="text" class="form-control" name="duration" id="courseDuration"
                                           value="{{ Request::old('duration') !== null ? Request::old('duration') : 0 }}"
                                           readonly="readonly" />
                                </div>
                                <div class="text-danger">{{ $errors->first('duration') }}</div>
                            </div>
                        </div>

                        <!-- Location & Price -->
                        <div class="row">
                            <!-- Location -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="location" class="control-label">Location</label>
                                    <input type="text" class="form-control" name="location"
                                           value="{{ Request::old('location') }}" />
                                </div>
                                <div class="text-danger">{{ $errors->first('location') }}</div>
                            </div>
                            <!-- Price -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="fee" class="control-label">Lesson Fee</label>
                                    <input type="text" class="form-control" name="fee" id="fee"
                                           value="{{ Request::old('fee') }}" />
                                </div>
                                <div class="text-danger">{{ $errors->first('fee') }}</div>
                            </div>
                        </div>
                        <!-- jQuery UI Slider -->
                        <div class="row">
                            <div class="col-md-6 col-md-offset-6 slider-container">
                                <div id="slider-range-max"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary pull-right" data-background-color="blue">Add Lesson</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <div>
                <a href="{{ url('/lessons') }}">Back to List</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/lessons.js') }}" type="text/javascript"></script>
@endsection