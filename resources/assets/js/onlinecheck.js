$(function() {
    // Ping the server to update online status
    function updateOnline() {
        $.ajax({
            type        : 'GET',
            url         : '/user/updateonline',
            dataType    : 'json',
            encode      : true
        })
        .done(function(data) {

        })
    }

    setInterval(function() {
        updateOnline();
    }, 60000)

    updateOnline();

})
