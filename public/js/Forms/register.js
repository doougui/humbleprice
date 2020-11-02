$(document).ready(function() {
  $('[data-form="register"]').submit(function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const action = $(this).attr('action');

    const button = $(this).find('button[type=submit]');

    const error = $('[data-error="register"]');
    const errorMsg = $(error).find('.error-msg');

    $.ajax({
      url: action,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $(button).attr('disabled', '');
      }
    }).done(function(response) {
      if (response.length !== 0) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response).fadeIn();
      } else {
        window.location.href = DIRPAGE;
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    }).always(function() {
      $(button).removeAttr('disabled');
    });
  });
});