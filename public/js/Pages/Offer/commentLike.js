$(document).ready(function() {
  $(document).on('click', '[data-btn="like-comment"]', function(e) {
    e.preventDefault();

    const id = $(this).closest('.comment').attr('data-id');
    const action = `${DIRPAGE}commentlike/add/${id}`;

    const error = $('[data-error="comments"]');
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