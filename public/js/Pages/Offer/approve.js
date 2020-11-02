$(document).ready(function() {
  $('[data-btn="approve"]').click(function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offer/approve/${$(card).attr('data-item')}`;
    const error = $(card).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(this);
    const buttons = $('#queue-actions');

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
        $(errorMsg).html(response).fadeIn();
      } else {
        $(buttons).fadeOut();
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