@extends('shared.tutor-layout')
@section('title', 'New Student')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Student Registration</h4>
                    <p class="category">Complete the following form to register a new student</p>
                </div>
                <div class="card-content">
                    <form action="{{ url('/students') }}" method="post">
                        <!-- CSRF Token -->
                        {{ csrf_field() }}

                        <!-- Hidden field: Tutor Id -->
                        <input type="hidden" name="tutor_id" value="{{ $user->id }}">


                        <h5 class="text-info">Student Details</h5>
                        <!-- First Last Name -->
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ Request::old('first_name') }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('first_name') }}</div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{ Request::old('last_name') }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('last_name') }}</div>
                            </div>
                        </div>

                        <!-- Gender, DOB & Grade -->
                        <div class="row">
                            <!-- Gender -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Gender</label>
                                    <?php
                                    $currentGender = Request::old('gender');
                                    ?>
                                    <input type="radio" name="gender" value="M" id="M"
                                            {{ $currentGender == "M" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                    <label for="M">Male</label>
                                    &nbsp;
                                    <input type="radio" name="gender" value="F" id="F"
                                            {{ $currentGender == "F" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                    <label for="F">Female</label>
                                </div>
                                <div class="text-danger">{{ $errors->first('gender') }}</div>
                            </div>
                            <!-- Date of Birth -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="date_of_birth" class="control-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                           value="{{ Request::old('date_of_birth') !== null?
                                                     Request::old('date_of_birth') : date("Y-m-d") }}">
                                </div>
                                <div class="text-danger">{{ $errors->first('date_of_birth') }}</div>
                            </div>
                            <!-- Grade -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="sltGrade" class="control-label">Grade</label>
                                    <select name="grade" id="sltGrade" class="form-control">
                                        {{ $currentGrade = Request::old('grade') !== null ?
                                                              Request::old('grade') : '' }}
                                        @foreach($lstGrades as $key => $value)
                                            <option value="{{ $key }}" {{ $currentGrade == $key ? "selected" : "" }} >
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger">{{ $errors->first('grade') }}</div>
                            </div>
                        </div>


                        <h5 class="text-info">Parent Details</h5>
                        <!-- Parent's First & Last Name -->
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Fist Name</label>
                                    <input type="text" class="form-control" name="parent_fname"
                                           value="{{ Request::old('parent_fname') }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('parent_fname') }}</div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="parent_lname"
                                           value="{{ Request::old('parent_lname') }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('parent_lname') }}</div>
                            </div>
                        </div>

                        <!-- Pnone number & Email -->
                        <div class="row">
                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" class="form-control" name="parent_phone_number"
                                           value="{{ Request::old('parent_phone_number') }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('parent_phone_number') }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="email" class="control-label">Email Address</label>
                                    <input type="email" class="form-control" name="parent_email" id="email"
                                           value="{{ Request::old('parent_email') }}">
                                </div>
                                <div class="text-danger">{{ $errors->first('parent_email') }}</div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary pull-right" data-background-color="blue">Register</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <div>
                <a href="{{ url('/students') }}">Back to List</a>
            </div>
        </div>
    </div>
@endsection