@extends('shared.layout')
@section('title', 'Reset Password')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Reset Password</h2>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">
                            <!-- Display error message (if any) -->
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif

                        <!-- Token Field -->
                        {{ csrf_field() }}

                        <!-- Password -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>

                            <!-- Password Confirmation -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                                </div>
                            </div>

                            <!-- Reset Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection