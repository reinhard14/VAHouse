
$(document).ready(function() {

    $('a[data-toggle="tab"]').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#days_available').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: '',
        width: '100%',
    });

    $('#skills, #softskills, #tools').select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: '',
        width: '100%',
    });

    $('#position7').change(function () {
        $('#specify').prop('disabled', !this.checked);
    }).trigger('change');

    $('#skype').on('keyup', () => {
        mappedWords = ['NA',  'N/A', 'n/a', 'na', 'none', 'None', 'NONE',
                     'not available', 'not applicable', 'Not applicable',
                     'NOT APPLICABLE', 'NOT AVAILABLE', 'Not Available'];

        for (var index = 0; index < mappedWords.length; index++) {
            if (skype.value === mappedWords[index]) {
                invalidSkype();
            }
        }

    });
});
