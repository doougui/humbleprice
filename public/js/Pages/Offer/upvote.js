$(document).ready(function() {
  $('.upvote').click(function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}upvote/add/${$(card).attr('data-item')}`;
    const error = $(card).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(this);

    function removeUpvote() {
      $(button).removeClass('btn-success');
      $(button).addClass('btn-secondary');
      $(upvotes).html(--count);
    }

    function addUpvote() {
      $(button).addClass('btn-success');
      $(button).removeClass('btn-secondary');
      $(upvotes).html(++count);
    }

    const upvotes = $(button).find('span');
    let count = parseInt(upvotes.html());

    function checkUpvote() {
      if ($(button).hasClass('btn-success')) {
        removeUpvote();
      } else {
        addUpvote();
      }
    }

    checkUpvote();

    $.ajax({
      url: action,
      type: 'POST',
    }).done(function(response) {
      if (response.length !== 0) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response).fadeIn();
        checkUpvote();
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      checkUpvote();
    });
  });
});