$(document).ready(function() {
    $('a[data-toggle="tab"]').on('click', function(e) {
        e.preventDefault(); // Prevent the default anchor click behavior
        $(this).tab('show'); // Show the tab
    });
});
