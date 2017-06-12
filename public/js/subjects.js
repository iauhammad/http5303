/**
 * Created by M. Irfaan Auhammad on 05-Jun-17.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    // -- Add a subject to list of subjects taught
    // -- ----------------------------------------
    $('#addSub').on('click', function() {
        var subjectId = $('#availableSubs>div.list-wrapper>ul>a.active').data('value');
        if(subjectId) {
            $.post("/addSubject", {subjectId: subjectId}).done(function(data) {
                $('#availableSubs>div.list-wrapper>ul>a.active').hide("slow", function() {
                    $('#availableSubs>div.list-wrapper>ul>a.active').remove();
                    $('#selectedSubs>div.list-wrapper>ul>a.active').removeClass('active');
                    $('#selectedSubs>div.list-wrapper>ul').append(data);
                });
            });
        } else {
            bootbox.alert("Please select a subject.");
        }
    });


    // -- Remove a subject from list of subjects taught
    // -- ---------------------------------------------
    $('#removeSub').on('click', function() {
        var subjectId = $('#selectedSubs>div.list-wrapper>ul>a.active').data('value');
        if(subjectId) {
            $.post("/delSubject", {subjectId: subjectId}).done(function(data) {
                $('#selectedSubs>div.list-wrapper>ul>a.active').hide("slow", function() {
                    $('#selectedSubs>div.list-wrapper>ul>a.active').remove();
                    $('#availableSubs>div.list-wrapper>ul>a.active').removeClass('active');
                    $('#availableSubs>div.list-wrapper>ul').append(data);
                });
            });
        } else {
            bootbox.alert("Please select a subject.");
        }
    });


    // -- Add a new subject to the list
    // -- -----------------------------
    $('#btnNewSubject').on('click', function() {
        var sNewSubject = $('#txtNewSubject').val();
        if(sNewSubject.trim()) {
            $.post("/newSubject", {subject_name: sNewSubject.trim()}).done(function(data) {
                $('#selectedSubs>div.list-wrapper>ul>a.active').removeClass('active');
                $('#selectedSubs>div.list-wrapper>ul').append(data);
                $('#txtNewSubject').val('');
            });
        } else {
            bootbox.alert("Please enter a valid subject name.");
        }
    });

});