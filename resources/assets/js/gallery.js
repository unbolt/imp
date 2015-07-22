$(function () {
    $('#screenshotModal').on('show.bs.modal', function (event) {
        console.log('showing modal!');
      var screenshot = $(event.relatedTarget);
      var screenshotid = screenshot.data('screenshot');
      var screenshotextension = screenshot.data('extension');
      console.log(screenshotid);

      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      $(this).find('img.display-screenshot').attr('src', '/imagecache/original/'+screenshotid+'.'+screenshotextension);
    });
});
