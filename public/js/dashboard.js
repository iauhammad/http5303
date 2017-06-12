type = ['','info','success','warning','danger'];

$(document).ready(function() {

    $('ul.sidebar-menu>li').on('click', function() {
        //$('li.sidebar-menu>li').removeClass('active');
        //$(this).addClass('active');
    });
    color = Math.floor((Math.random() * 4) + 1);

    // $.notify({
    //     icon: "notifications",
    //     message: "Welcome to <b>TMS - Plus</b> - your new tutoring management system."
    // },{
    //     type: type[color],
    //     timer: 4000,
    //     placement: {
    //         from: 'top',
    //         align: 'right'
    //     }
    // });

});
