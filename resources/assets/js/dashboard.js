$(function () {
    // Enable the icons
    /*$('.icon').click(function (e) {
        console.log('clicked');
        e.preventDefault();
        $(this).tab('show');
    });*/
    /*
    $('.icon-character-config').click(function (e) {
        console.log('clicked');
        e.preventDefault();
        $('#character-config').tab('show');
    });*/

    // Enable the profile banner upload magic
    $('.upload-form').hide();
    $('.edit-header-icon').click(function() {
        $('.upload-form').show();
        $(this).hide();
    });
    $('.hide-edit-header-icon').click(function() {
        $('.upload-form').hide();
        $('.edit-header-icon').show();
    });
})
