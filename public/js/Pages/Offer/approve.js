$(document).ready(function() {
  $('[data-btn="approve"]').click(function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offer/approve/${$(card).attr('data-item')}`;

    const error = $('[data-error="offer"]');
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);
    const buttons = $('#queue-actions');

    $.ajax({
      url: action,
      type: 'POST',
      dataType: 'json',
      processData: false,
      contentType: false,
      beforeSend: function() {
        $(button).addClass('disabled');
      }
    }).done(function(response) {
      if (response.error) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response.error).fadeIn();
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