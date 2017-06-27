/**
 * Created by M. Irfaan Auhammad on 13-Jun-17.
 */

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    // -- FUNCTIONS DECLARATION -- //
    // -- --------------------- -- //
    function refreshSubjectList(iStudentId) {
        if(iStudentId < 1) {
            // -- If user selects default option, reset interface
            $('#sltSubject').val(" ");
            $('#sltSubject').prop("disabled", true);
            $('#sltStudent').focus();

        } else {
            // Find list of subjects that student is currently enrolled in
            $.post("/studentCourses", {studentId: iStudentId}).done(function(data) {
                $('#sltSubject').html(data);
                $('#sltSubject').prop("disabled", false);
            });

            $('#sltSubject').first().focus();
        }
    }


    $('#sltSubject').data('open',false);

    // -- Handle change event when student selection change
    // -- -------------------------------------------------
    $('#sltStudent').on('change', function() {
        refreshSubjectList($(this).val());
    });

    $('#sltSubject').click( function() {
        if ( $('#sltSubject').data('open') == false ) {
            $('#sltSubject').data('open', true);
            refreshSubjectList($('#sltStudent').val());
        } else {
            $('#sltSubject').data('open', false );
        }
    });


    // -- Initialise jQuery Date picker
    // -- -----------------------------
    $("#lessonDatePicker").datepicker({
        minDate: +1,
        maxDate: "+1M +10D",
        showAnim: "slideDown",
        dateFormat: "yy-mm-dd"
    });


    // -- Initialise jQuery Time pickers
    // -- ------------------------------
    $('.time').timepicker({
        'scrollDefault' : '9am',
        'step' : 15,
        'timeFormat': 'H:i:s',
        'disableTimeRanges': [
            ['12am', '9am'],
            ['9:01pm', '11:59pm']
        ],
        'forceRoundTime': true
    });

    // -- Calculate lesson duration
    $('.time').on('change', function() {
        // Get start and end time
        var startTime = $('#start_time').val();
        var endTime = $('#end_time').val();

        if(startTime && endTime) {
            var diff = ( new Date("1970-1-1 " + endTime) - new Date("1970-1-1 " + startTime) ) / 1000 / 60 / 60;
            if(diff > 0) {
                $('#courseDuration').val(diff);
            } else {
                $('#courseDuration').val('0');
            }
        }

    });


    // -- Initialise jQuery Slider
    // -- ------------------------
    var sliderValue = 0;
    if($('#fee').val() > 0) {
        sliderValue = $('#fee').val();
    }
    $( "#slider-range-max" ).slider({
        range: "max",
        min: 0,
        max: 50,
        value: sliderValue,
        slide: function( event, ui ) {
            $( "#fee" ).val( ui.value );
        }
    });
    $( "#fee" ).val( $( "#slider-range-max" ).slider( "value" ) );

});