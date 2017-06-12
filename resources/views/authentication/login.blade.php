@extends('shared.layout')
@section('title', 'Login')

@section('body')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Login</h2>
                </div>
                <div class="panel-body">
                    <form action="/login" method="post">
                        <!-- Token Field -->
                        {{ csrf_field() }}

                        <!-- Display error message (if any) -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Email -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="test@email.com">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group">
                            <div class="input-group">
                                Remember me <input type="checkbox" name="remember_me">
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        <a href="/forgot-password">Forgot your password?</a>

                        <!-- Login Button -->
                        <div class="form-group">
                            <button type="submit" value="Login" class="btn btn-primary pull-right">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection