@extends('shared.layout')
@section('title', 'Login')

@section('body')

    <!-- First Banner with Website Name and Sign Up Button -->
    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br><br>
                <h1 class="header center teal-text text-lighten-2">TMS - Plus</h1>
                <div class="row center">
                    <h5 class="header col s12 light">Your next tool to help you as a tutor to manage your lessons</h5>
                </div>
                <div class="row center">
                    <a href="/register" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Sign Up</a>
                </div>
                <br><br>
            </div>
        </div>
        <div class="parallax"><img src="{{ asset('/img/tutoring-background.jpg') }}" alt="Unsplashed background img 1"></div>
    </div>

    <!-- Section Icons with 3 Columns -->
    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">flash_on</i></h2>
                        <h5 class="center">Quick Lesson Schedule</h5>

                        <p class="light center-align">Stop using your agenda to keep track of lesson sessions scheduled. With TMS-Plus, you can easily select courses you teach and start creating new lesson sessions and keep track of your upcoming schedule.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">group</i></h2>
                        <h5 class="center">Students Enrollment</h5>

                        <p class="light center-align">TMS-Plus alows you to register your students online on your account. All information are available in one place and no need to keep track of paper record for each students anymore.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center brown-text"><i class="material-icons">settings</i></h2>
                        <h5 class="center">Easy Reporting</h5>

                        <p class="light center-align">Every month you wonder how many lesson sessions you have had over the last month, and which student scheduled lessons? With TMS-Plus reporting you can access all your lessons history.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Second banner Image -->
    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h5 class="header col s12 light">Worry about your students and we handle the rest</h5>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="{{ asset('/img/tutoring-background1.jpg') }}" alt="Background image"></div>
    </div>

    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Contact Us</h4>
                    <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed. Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                </div>
            </div>

        </div>
    </div>

@endsection