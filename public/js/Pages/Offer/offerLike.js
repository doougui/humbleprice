$(document).ready(function() {
  $('[data-btn="like-offer"]').click(function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offerlike/add/${$(card).attr('data-item')}`;

    const error = $('[data-error="offer"]');
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);

    function removeLike() {
      $(button).removeClass('btn-success');
      $(button).addClass('btn-secondary');
      $(likes).html(--count);
    }

    function addLike() {
      $(button).addClass('btn-success');
      $(button).removeClass('btn-secondary');
      $(likes).html(++count);
    }

    const likes = $(button).find('span');
    let count = parseInt(likes.html());

    function checkLike() {
      if ($(button).hasClass('btn-success')) {
        removeLike();
      } else {
        addLike();
      }
    }

    checkLike();

    $.ajax({
      url: action,
      type: 'POST',
      dataType: 'json',
      processData: false,
      contentType: false,
    }).done(function(response) {
      if (response.error) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response.error).fadeIn();
        checkLike();
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      checkLike();
    });
  });
});