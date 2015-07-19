$(function () {
    // Autosize the text area input
    autosize($('.post-content-textarea'));

    $('.new-topic').click(function() {
        $('.new-topic-form').slideToggle();
    });

    /* Live Preview Functionality */

    // Update thread title
    $('#thread-title').keyup(function (e) {

        // Prevent enter from doing anything
        if(e.which == 13) {
            e.preventDefault();
        }

        // Get the value
        var str = $(this).val();

        // Update the header text
        $('#live-preview-thread-title').text( str );
    });

    // Update thread content
    var converter = new showdown.Converter();
    $('#thread-content').keyup(function (e) {
        // Process the markdown
        str = $(this).val();

        html = converter.makeHtml(str);

        $('#live-preview-thread-content').html( html );

        fPopLoadItem();
    });

    $('#post-content').keyup(function (e) {
        // Process the markdown
        str = $(this).val();

        html = converter.makeHtml(str);

        $('#live-preview-post-content').html( html );

        fPopLoadItem();
    });

    $('.process-markdown').each(function() {
        str = $(this).html();
        html = converter.makeHtml(str);
        $(this).html( html );
        fPopLoadItem();
    });

    // Automatically submit the admin mod controls when changed
    $('#mod_controls').change( function () {
        this.form.submit();
    });

    // Edit post functionality **********************************
    // Hide the edit forms
    $('div.edit-post').hide();

    // Enable the edit post icon
    $('.edit-button').click(function () {
        // slide toggle the post
        $(this).closest('.post-content').find('div.post-content-main').toggle();
        // Slide toggle the edit form
        $(this).closest('.post-content').find('div.edit-post').toggle();

    });

    // Edit post handler
    $('.edit-post').submit(function( e ) {
        // Stop the default events firing
        e.preventDefault();
        e.stopImmediatePropagation();

        // Add the csrf to our header for ajax
        var csrf = $('[name="_token"]', this).val();

        // Get the post ID, we'll need it
        var postId = $('[name="post_id"]', this).val();

        // Get the content, we'll need that too
        var content = $('[name="content"]', this).val();

        var formData = {
            '_token'        : csrf,
            'post_id'       : postId,
            'content'       : content
        }

        // Process the form
        $.ajax({
            type        : 'POST',
            url         : '/post/edit',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
        .done(function(data) {
            // Successful edit
            // Update the post content and call the function to process the markdown
            toastr.success('Post Edited');

            // Process the markdown
            var html = converter.makeHtml(content);
            $(".post-content-"+postId).html(html);
            fPopLoadItem();


            // Slide down the post
            $('div.post-content-'+postId).toggle();

            // Slide up the form
            $('div.edit-post-'+postId).toggle();

        })
        .fail(function(data) {
            // There was an error
            // Throw it
            toastr.error('Could not edit post.');
        });

    });
});
