@extends('shared.tutor-layout')
@section('title', 'Dashboard')

@section('body')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">people</i>
                </div>
                <div class="card-content">
                    <p class="category">Students</p>
                    <h3 class="title">{{ $numStudents }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">person_add</i> <a href="{{ route('students.create') }}">New student</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">store</i>
                </div>
                <div class="card-content">
                    <p class="category">Revenue</p>
                    <h3 class="title">${{ $totalRevenue }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Since registered
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="material-icons">schedule</i>
                </div>
                <div class="card-content">
                    <p class="category">Hours Taught</p>
                    <h3 class="title">{{ $totalHours }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Tracked from TMS-Plus
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">info_outline</i>
                </div>
                <div class="card-content">
                    <p class="category">Next Lessons</p>
                    <h3 class="title">+{{ $numLessons }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection