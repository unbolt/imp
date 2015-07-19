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
        console.log(html);

        $('#live-preview-thread-content').html( html );

        fPopLoadItem();
    });

    $('#post-content').keyup(function (e) {
        // Process the markdown
        str = $(this).val();

        html = converter.makeHtml(str);
        console.log(html);

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
});
