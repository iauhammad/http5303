@extends('shared.layout')
@section('title', 'Login')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3">
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
                                <div class="alert alert-danger deep-orange-text">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success green-text">
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
                                <input type="checkbox" id="remember_me" name="remember_me" />
                                <label for="remember_me">Remember me</label>
                            </div>

                            <!-- Forgot Password Link -->
                            <a href="/forgot-password">Forgot your password?</a>

                            <!-- Login Button -->
                            <div class="form-group right-align">
                                <button type="submit" value="Login" class="waves-effect waves-light btn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection