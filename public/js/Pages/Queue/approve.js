$(document).ready(function() {
  $('.approve').click(function(e) {
    e.preventDefault();

    const action = $(this).attr('href');
    const card = $(this).closest('.card-item');
    const error = $(card).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(card).find('.approve');

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
        $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      } else {
        $(card).fadeOut();
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    }).always(function() {
      $(button).removeClass('disabled');
    });
  });
});