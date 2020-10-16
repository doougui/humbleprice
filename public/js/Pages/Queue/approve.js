$(document).ready(function() {
  $('.approve').click(function(e) {
    e.preventDefault();

    const action = $(this).attr('href');
    const card = $(this).closest('.card-item');
    const error = $(card).next('.error');
    const button = $(card).next('.approve');
    console.log(error);
    $.ajax({
      url: action,
      type: 'POST',
      beforeSend: function() {
        $(button).addClass('disabled');
      }
    }).done(function(response) {
      if (response.length !== 0) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(error).next('.error-msg').html(response).fadeIn();
      } else {
        $(card).fadeOut();
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(`${error} .error-msg`).html('Ops! Algo de errado aconteceu!').fadeIn();
    }).always(function() {
      $(button).removeClass('disabled');
    });
  });
});