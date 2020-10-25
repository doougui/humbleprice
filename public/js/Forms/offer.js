$(document).ready(function() {
  $('#offer-form').submit(function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const action = $(this).attr('action');

    $.ajax({
      url: action,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('button[type=submit]').attr('disabled', '');
      }
    }).done(function(response) {
      if (response.length !== 0) {
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
  });
});