// function refreshCaptcha() {
//     $.ajax({
//         url: '{{ route('refresh.captcha') }}',
//         method: 'GET',
//         success: function(response) {
//             $('#captcha-img').html(response.captcha);
//         },
//         error: function(xhr, status, error) {
//             console.error('Failed to refresh captcha:', xhr.responseText);
//             alert('Failed to refresh captcha: ' + error);
//         }
//     });
// }
