@extends('shared/tutor-layout')
@section('customMetas')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">
@endsection
@section('title', 'Update Lesson')

@section('body')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Lesson Itinerary Update</h4>
                    <p class="category">Complete the following form to update a lesson's itinerary</p>
                </div>
                <div class="card-content">
                    <form action="{{ route('lessons.update', $lesson->id) }}" method="post">
                        <!-- CSRF Token -->
                        {{ csrf_field() }}
                        {{ method_field("PUT") }}

                        <h5 class="text-info">Student Details</h5>
                        <!-- Student & Subject -->
                        <div class="row">
                            <!-- Student -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="student" class="control-label">Student Name</label>
                                    <input type="text" id="student" class="form-control" disabled
                                           value=" {{ $lesson->student->getFullName() }}">
                                </div>
                            </div>
                            <!-- Subject -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="subject" class="control-label">Subject</label>
                                    <input type="text" id="subject" class="form-control" disabled
                                           value="{{ $lesson->subject->name }}">
                                </div>
                            </div>
                        </div>


                        <h5 class="text-info">Lesson Itinerary</h5>
                        <!-- Date, Start & End Times, Duration -->
                        <div class="row" id="datePairFields">
                            <!-- Lesson Date -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label for="lessonDatePicker" class="control-label">Lesson Date</label>
                                    <input type="text" class="form-control" name="lesson_date" id="lessonDatePicker"
                                           value="{{ Request::old('lesson_date') !== null ?
                                                     Request::old('lesson_date') : $lesson->lesson_date }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('lesson_date') }}</div>
                            </div>
                            <!-- Start Time -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label for="start_time" class="control-label">Start Time</label>
                                    <input type="text" id="start_time" name="start_time" autocomplete="off"
                                           class="time ui-timepicker-input form-control"
                                           value="{{ Request::old('start_time') !== null ?
                                                     Request::old('start_time') : $lesson->start_time }}" />
                                </div>
                                <div class="text-danger">{{ $errors->first('start_time') }}</div>
                            </div>
                            <!-- End Time -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">End Time</label>
                                    <input type="text" id="end_time" name="end_time" autocomplete="off"
                                           class="time ui-timepicker-input form-control"
                                           value="{{ Request::old('end_time') !== null ?
                                                     Request::old('end_time') : $lesson->end_time }}" />
                                </div>
                                <div class="text-danger">{{ $errors->first('end_time') }}</div>
                            </div>
                            <!-- Lesson Duration -->
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <label class="control-label">Duration</label>
                                    <input type="text" class="form-control" name="duration" id="courseDuration"
                                           value="{{ Request::old('duration') !== null ?
                                                     Request::old('duration') : $lesson->duration }}" readonly="readonly" />
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
                                           value="{{ Request::old('location') !== null ?
                                                     Request::old('location') : $lesson->location }}" />
                                </div>
                                <div class="text-danger">{{ $errors->first('location') }}</div>
                            </div>
                            <!-- Price -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="fee" class="control-label">Lesson Fee</label>
                                    <input type="text" class="form-control" name="fee" id="fee"
                                           value="{{ Request::old('fee') !== null ?
                                                     Request::old('fee') : $lesson->fee }}" />
                                </div>
                                <div class="text-danger">{{ $errors->first('fee') }}</div>
                            </div>
                        </div>
                        
                        <!-- Lesson Status & Slider -->
                        <div class="row">
                            <!-- Lesson Status -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="status" class="control-label">Lesson Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <?php $selectedStatus = Request::old('status') !== null ?
                                                                Request::old('status') : $lesson->status; ?>
                                        @foreach($lessonStatus as $key => $value)
                                            <option value="{{ $key }}" {{ $selectedStatus == $key ? "selected" : "" }} >
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- jQuery UI Slider -->
                            <div class="col-md-6 slider-container">
                                <div id="slider-range-max"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary pull-right" data-background-color="blue">Save Changes</button>
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