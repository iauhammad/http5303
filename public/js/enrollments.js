/**
 * Created by M. Irfaan Auhammad on 09-Jun-17.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    // -- Handle change event when student selection change
    // -- -------------------------------------------------
    $('#sltStudent').on('change', function() {

        if($(this).val() < 1) {
            // -- If user selects default option, reset interface
            $('#enrollmentDetails').slideUp();
            $('#sltSubject').val(" ");
            $('#sltSubject').prop("disabled", true);
            $('#sltStudent').focus();

        } else {
            // -- If user selects a student
            var iStudentId = $(this).val();

            // Find list of subjects that student is currently enrolled in
            $.post("/coursesEnrolled", {studentId: iStudentId}).done(function(data) {
                $('#enrollmentDetails').html(data);
                $('#enrollmentDetails').show('slow');
            });

            // Find list of subjects that student can be enrolled to
            $.post("/coursesAvailable", {studentId: iStudentId}).done(function(data) {
                $('#sltSubject').html(data);
                $('#sltSubject').prop("disabled", false);
            });

            $('#sltSubject').first().focus();

        }

    });


    // -- Handle event when user enroll a student to a course
    // -- ---------------------------------------------------
    $('#btnEnrollStudent').on('click', function() {
        // Initialisation
        var fValid = true;
        var studentId = $('#sltStudent').val();
        var subjectId = $('#sltSubject').val();

        $('#errStudent').html('');
        $('#errSubject').html('');

        // Validations to check for values
        if($('#sltStudent').val() < 1) {
            $('#errStudent').html('Please select a student');
            fValid = false;
        }
        if($('#sltSubject').val() < 1) {
            $('#errSubject').html('Please select a subject');
            fValid = false;
        }

        // Enroll student to selected course
        if(fValid === true) {
            //console.log('Student id: ' + studentId + ' enrolled in subject id: ' + subjectId);
            // Enroll student to course
            $.post("/enrollStudent", {student_id: studentId, subject_id: subjectId}).done(function(data) {
                if (data > 0) {
                    // Refresh list of subjects that student is currently enrolled in
                    $.post("/coursesEnrolled", {studentId: studentId}).done(function(data) {
                        $('#enrollmentDetails').html(data);
                    });

                    // Remove subject option from dropdown list
                    $("#sltSubject option[value="+ subjectId +"]").remove();
                    $('#sltSubject').val(' ');

                } else {
                    bootbox.alert("Error while enrolling student to the selected course.");
                }
            });
        }

    });


    // -- Handle click event to disenroll from a course
    // -- ---------------------------------------------
    $(document).on('click', '.course-icon', function() {
        // Get IDs from parent element
        var chip = $(this).parent();
        var enrollmentId = chip.attr('data-enrollmentid');
        var subjectId = chip.attr('data-subjectid');
        var subject = chip.html().substring(0, chip.html().indexOf('<i')).trim();

        //console.log("ID: " + enrollmentId + " | Sub ID: " + subjectId + " | Subject: " + subject);
        $.post("/disenrollStudent", { id: enrollmentId}).done(function(data) {
            chip.hide('slow');
            var option = '<option value="' + subjectId + '">' + subject + '</option>';
            $('#sltSubject').append(option);
        });
    });


});