$(document).ready(function() {
  $('.suspend').click(function(e) {
    e.preventDefault();

    const tr = $(this).closest('tr');
    const action = `${DIRPAGE}userspanel/suspend/${$(tr).attr('data-item')}`;
    const error = $(tr).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(tr).find('.suspend');

    $.ajax({
      url: action,
      type: 'POST',
      beforeSend: function() {
        $(button).attr('disabled', '');
      }
    }).done(function(response) {
      if (response.length !== 0) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response).fadeIn();
      } else {
        window.location.href = `${DIRPAGE}userspanel`;
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