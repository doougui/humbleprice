$(document).ready(function() {
  $('#comment').submit(function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const action = $(this).attr('action');

    const error = $(this).find($('#error'));
    const errorMsg = $(error).find('#error-msg');

    const button = $(this).find($('button[type=submit]'));

    $.ajax({
      url: action,
      type: 'POST',
      data: formData,
      dataType: 'json',
      beforeSend: function() {
        $(button).attr('disabled', '');
      }
    }).done(function(response) {
      if (response.error) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response.error).fadeIn();
      } else {
        const commentElement = `
            <div class="comment d-flex mx-2 pt-3 align-items-start">
                <img class="img img-fluid rounded rounded-circle mr-3" src="${DIRIMG}default.jpg" alt="Usuário">

                <div class="w-100">
                    <div class="comment-header">
                        <p class="mb-0 font-weight-bold comment-author-name">${response.author}</p>
                        <small class="text-muted">Postado em: ${response.created_at}</small>
                    </div>

                    <div class="comment-content">
                        <p>${response.comment}></p>
                    </div>

                    <div class="comment-actions d-flex justify-content-end">
                        <button class="btn btn-link btn-sm py-2 mr-1" <?= (! user()) ? 'disabled' : '' ?>>
                            <i class="fas fa-thumbs-up"></i>
                            <span>14</span>
                        </button>

                        <button class="btn btn-link btn-sm py-2 mr-1" <?= (! user()) ? 'disabled' : '' ?>>
                            <i class="fas fa-comments"></i>
                            Responder
                        </button>

                        <button class="btn btn-link btn-sm py-2 mr-1" data-toggle="tooltip" data-placement="top" title="Denunciar">
                            <i class="fas fa-flag"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
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