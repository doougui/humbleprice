$(document).ready(function() {
  $(document).on('click', '.comment-actions .like', function(e) {
    e.preventDefault();

    const id = $(this).closest('.comment').attr('data-id');

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}commentlike/add/${id}`;

    const error = $(card).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(this);

    function removeLike() {
      $(button).removeClass('text-success');
      $(likes).html(--count);
    }

    function addLike() {
      $(button).addClass('text-success');
      $(likes).html(++count);
    }

    const likes = $(button).find('span');
    let count = parseInt(likes.html());

    function checkLike() {
      if ($(button).hasClass('text-success')) {
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