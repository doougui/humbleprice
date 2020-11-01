$(document).ready(function() {
  $('.like').click(function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offerlike/add/${$(card).attr('data-item')}`;
    const error = $(card).find('.error');
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
    }).done(function(response) {
      if (response.length !== 0) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response).fadeIn();
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