@extends('shared.layout')
@section('title', 'Forgot Password')

@section('body')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">Forgot Password</h2>
                </div>
                <div class="panel-body">
                    <form action="/forgot-password" method="post">
                        <!-- Token Field -->
                        {{ csrf_field() }}

                        <!-- Display error message (if any) -->
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

                        <!-- Reset Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">Send Code</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection