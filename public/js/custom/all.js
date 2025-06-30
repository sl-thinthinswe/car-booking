$(document).ready(function () {

    // For Login
    $(".changeType").on('click', function () {
        if ($(this).parent().prev().attr('type') == 'password') {
            
            $(this).parent().prev().attr('type', 'text');
            $(this).addClass('fa-eye');
            $(this).removeClass('fa-eye-slash');
        } else {
            
            $(this).parent().prev().attr('type', 'password');
            $(this).addClass('fa-eye-slash');
            $(this).removeClass('fa-eye');
        }
    });

});