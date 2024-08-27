$(document).ready(function() {
    // Check if there are any errors on page load
    if ($('.alert-danger:visible').length > 0) {
        // Scroll to the first visible error span
        $('html, body').animate({
            scrollTop: $('.alert-danger:visible:first').offset().top - 20
        }, 500);
    }
});
