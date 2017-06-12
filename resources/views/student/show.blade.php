@extends('shared.tutor-layout')
@section('title', 'Student Details')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Student Details</h4>
                    <p class="category">Profile details of student</p>
                </div>
                <div class="card-content">
                    <form>
                        <h5 class="text-info">Student Details</h5>
                        <!-- First Last Name -->
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Fist Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ $student->first_name }}" disabled >
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{ $student->last_name }}" disabled >
                                </div>
                            </div>
                        </div>

                        <!-- Gender, DOB & Grade -->
                        <div class="row">
                            <!-- Gender -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Gender</label>
                                    <?php
                                    $currentGender = $student->gender;
                                    ?>
                                    <input type="radio" name="gender" value="M" id="M" disabled
                                            {{ $currentGender == "M" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                    <label for="M">Male</label>
                                    &nbsp;
                                    <input type="radio" name="gender" value="F" id="F" disabled
                                            {{ $currentGender == "F" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                    <label for="F">Female</label>
                                </div>
                            </div>
                            <!-- Date of Birth -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="date_of_birth" class="control-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                           value="{{ $student->date_of_birth }}" disabled>
                                </div>
                            </div>
                            <!-- Grade -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="sltGrade" class="control-label">Grade</label>
                                    <select name="grade" id="sltGrade" class="form-control" disabled>
                                        {{ $currentGrade = $student->grade }}
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
                                           value="{{ $student->parent_fname }}" disabled>
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="parent_lname"
                                           value="{{ $student->parent_lname  }}" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- Pnone number & Email -->
                        <div class="row">
                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" class="form-control" name="parent_phone_number"
                                           value="{{ $student->parent_phone_number }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label for="email" class="control-label">Email Address</label>
                                    <input type="email" class="form-control" name="parent_email" id="email"
                                           value="{{ $student->parent_email }}" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <a href="{{ url('/students') }}">Back to List</a>
            </div>
        </div>
    </div>
@endsection