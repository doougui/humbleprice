$(document).ready(function() {
  $('#login').submit(function() {
    const email = $('#email').val();
    const password = $('#password').val();

    $.ajax({
      url: `${DIRPAGE}login/signin`,
      type: 'POST',
      data: { email, password },
      beforeSend: function() {
        $('button[type=submit]').attr('disabled', '');
      }
    }).done(function(response) {
      if (response.length != 0) {
        $('#error').removeClass('d-none');
        $('#error').addClass('d-block');
        $('#error-msg').html(response).fadeIn();
      } else {
        window.location.href = DIRPAGE;
      }
    }).fail(function() {
      $('#error').removeClass('d-none');
      $('#error').addClass('d-block');
      $('#error-msg').html('Ops! Algo de errado aconteceu!').fadeIn();
    }).always(function() {
      $('button[type=submit]').removeAttr('disabled');
    });

    return false;
  });
});