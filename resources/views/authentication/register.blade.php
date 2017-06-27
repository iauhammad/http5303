@extends('shared.layout')
@section('title', 'Register')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">New Registration</h2>
                    </div>
                    <div class="panel-body">
                        <form action="/register" method="post">
                            <!-- Token Field -->
                            {{ csrf_field() }}

                            <!-- Email -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="test@email.com"
                                           value="{{ Request::old('email') }}">
                                </div>
                                <div class="deep-orange-text">{{ $errors->first('email') }}</div>
                            </div>
                            <!-- First Name -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="first_name" class="form-control" placeholder="First name"
                                           value="{{ Request::old('first_name') }}">
                                </div>
                                <div class="deep-orange-text">{{ $errors->first('first_name') }}</div>
                            </div>
                            <!-- Last Name -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last name"
                                           value="{{ Request::old('last_name') }}">
                                </div>
                                <div class="deep-orange-text">{{ $errors->first('last_name') }}</div>
                            </div>
                            <!-- Display Name -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="display_name" class="form-control" placeholder="Display Name"
                                           value="{{ Request::old('display_name') }}">
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                           value="{{ Request::old('password') }}">
                                </div>
                                <div class="deep-orange-text">{{ $errors->first('password') }}</div>
                            </div>
                            <!-- Confirm password -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                                </div>
                                <div class="deep-orange-text">{{ $errors->first('password_confirmation') }}</div>
                            </div>
                            <!-- Register Button -->
                            <div class="form-group">
                                <button type="submit" value="Register" class="btn btn-primary pull-right">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection