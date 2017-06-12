@extends('shared.tutor-layout')
@section('title', 'Profile')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Edit Profile</h4>
                    <p class="category">Complete your tutor profile</p>
                </div>
                <div class="card-content">
                    <form action="{{ url('/profile-setup') }}" method="post">
                        <!-- CSRF Token -->
                        {{ csrf_field() }}

                        <!-- Hidden field: User Id -->
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <!-- User Id, Email, Display Name -->
                        <div class="row">
                            <!-- User Identity Number -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Identity Number</label>
                                    <input type="text" class="form-control"
                                           value="{{ str_pad($user->id, 10, "0", STR_PAD_LEFT) }}" disabled>
                                </div>
                            </div>
                            <!-- Email Address -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email address</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" disabled >
                                </div>
                            </div>
                            <!-- Display Name -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Display Name</label>
                                    <input type="text" class="form-control" name="display_name"
                                           value="{{ Request::old('display_name') !== null ?
                                                     Request::old('display_name'):
                                                     $user->display_name }}">
                                </div>
                            </div>
                        </div>

                        <!-- First Last Name -->
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ Request::old('first_name') !== null ?
                                                     Request::old('first_name') : $user->first_name }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('first_name') }}</div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{ Request::old('last_name') !== null ?
                                                     Request::old('last_name') : $user->last_name }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('last_name') }}</div>
                            </div>
                        </div>

                        <!-- Phone & Gender -->
                        <div class="row">
                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number"
                                           value="{{ Request::old('phone_number') !== null ?
                                                     Request::old('phone_number') : $tutor->phone_number }}" >
                                </div>
                                <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                            </div>
                            <!-- Gender -->
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Gender</label>
                                    <?php
                                        $currentGender = Request::old('gender') !== null ?
                                                         Request::old('gender') : $tutor->gender
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
                        </div>

                        <!-- Street Address -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label for="street_address" class="control-label">Street Adress</label>
                                    <input type="text" name="street_address" class="form-control" id="street_address"
                                           value="{{ Request::old('street_address') !== null ?
                                                     Request::old('street_address') :
                                                     $tutor->street_address }}">
                                    <div class="text-danger">{{ $errors->first('street_address') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- City, Province, Postal Code -->
                        <div class="row">
                            <!-- City -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="city" class="control-label">City</label>
                                    <input type="text" name="city" class="form-control" id="city"
                                           value="{{ Request::old('city') !== null ?
                                                     Request::old('city') :
                                                     $tutor->city }}" >
                                    <div class="text-danger">{{ $errors->first('city') }}</div>
                                </div>
                            </div>
                            <!-- Province -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="province" class="control-label">Province</label>
                                    <select name="province" id="sltProvince" class="form-control">
                                        {{ $currentProvince = Request::old('province') !== null ?
                                                              Request::old('province') : $tutor->province }}
                                        @foreach($province as $key => $value)
                                            <option value="{{ $key }}" {{ $currentProvince == $key ? "selected" : "" }} >
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">{{ $errors->first('province') }}</div>
                                </div>
                            </div>
                            <!-- Postal Code -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label for="postal_code" class="control-label">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" id="postal_code"
                                           value="{{ Request::old('postal_code') !== null ?
                                                     Request::old('postal_code') :
                                                     $tutor->postal_code }}" >
                                    <div class="text-danger">{{ $errors->first('postal_code') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Biography -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <div class="form-group label-floating">
                                        <label for="biography" class="control-label"> Write a short biography about your teaching.</label>
                                        <textarea class="form-control" name="biography" id="biography"
                                                  rows="5">{{ Request::old('biography') !== null ?
                                                              Request::old('biography') :
                                                              $tutor->biography }}</textarea>
                                        <div class="text-danger">{{ $errors->first('biography') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary pull-right" data-background-color="blue">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection