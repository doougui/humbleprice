$(document).ready(function() {
  const error = $('[data-error="comments"]');
  const errorMsg = $(error).find('.error-msg');

  function renderComments() {
    const action = `${DIRPAGE}comment/list/${$('.card').attr('data-item')}`;

    const commentList = $('#commentList');
    $(commentList).html('');

    const amountCommentsElement = $('#amount-comments').find('span');
    let amount = 0;

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
      } else {
        let comments = '';

        response.forEach(item => {
          const options = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric'
          };

          const date = new Date(item.created_at);
          const createdAt = new Intl.DateTimeFormat('pt-BR', options).format(date);

          comments += `
            <div class="thread" data-parent="${item.id}">
                <div class="comment d-flex mx-2 pt-3 align-items-start parent-comment" data-id="${item.id}">
                    <div class="comment-author-avatar rounded rounded-circle mr-3" style="background: url('${DIRIMG}users/${item.avatar}') no-repeat center; background-size: cover;"></div>
    
                    <div class="w-100">
                        <div class="comment-header">
                            <p class="mb-0 font-weight-bold comment-author-name">${item.author}</p>
                            <small class="text-muted">Postado em: ${createdAt}</small>
                        </div>
    
                        <div class="comment-content">
                            <p class="mb-0">${item.comment}</p>
                        </div>
    
                        <div class="comment-actions d-flex justify-content-end">
                            <button class="btn btn-link ${(item.liked) ? 'text-success' : ''} btn-sm py-2 mr-1" data-btn="like-comment" ${(!logged) ? 'disabled title="Você precisa estar logado para realizar esta ação."' : ''}>
                                <i class="fas fa-thumbs-up"></i>
                                <span>${item.likes}</span>
                            </button>
      
                            <button class="btn btn-link btn-sm py-2 mr-1" data-btn="reply" ${(!logged) ? 'disabled title="Você precisa estar logado para realizar esta ação."' : ''}>
                                <i class="fas fa-comments"></i>
                                Responder
                            </button>
                        </div>
                    </div>
                </div>
          `;

          amount++;

          comments += `
            <div class="replies">
          `;
          if (item.children) {
            item.children.forEach(child => {
              const options = {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
              };

              const date = new Date(child.created_at);
              const createdAt = new Intl.DateTimeFormat('pt-BR', options).format(date);

              comments += `
                <div class="comment d-flex mr-2 pt-3 align-items-start" data-id="${child.id}">
                    <div class="comment-author-avatar rounded rounded-circle mr-3" style="background: url('${DIRIMG}users/${child.avatar}') no-repeat center; background-size: cover;"></div>
    
                    <div class="w-100">
                        <div class="comment-header">
                            <p class="mb-0 font-weight-bold comment-author-name">${child.author}</p>
                            <small class="text-muted">Postado em: ${createdAt}</small>
                        </div>
    
                        <div class="comment-content">
                            <p class="mb-0">${child.comment}</p>
                        </div>
    
                        <div class="comment-actions d-flex justify-content-end">
                            <button class="btn btn-link ${(child.liked) ? 'text-success' : ''} btn-sm py-2 mr-1" data-btn="like-comment" ${(!logged) ? 'disabled title="Você precisa estar logado para realizar esta ação."' : ''}>
                                <i class="fas fa-thumbs-up"></i>
                                <span>${child.likes}</span>
                            </button>
      
                            <button class="btn btn-link btn-sm py-2 mr-1" data-btn="reply" ${(!logged) ? 'disabled title="Você precisa estar logado para realizar esta ação."' : ''}>
                                <i class="fas fa-comments"></i>
                                Responder
                            </button>
                        </div>
                    </div>
                </div>
              `;

              amount++;
            });
          }

          comments += `
                  </div>
              </div>
          `;
        });

        if (!comments) {
          comments = `
              <p class="text-muted text-center">Ainda não há comentários disponíveis. Que tal fazer um?</p>
          `;
        }

        $(comments).appendTo(commentList);

        amountCommentsElement.html(amount);

        $(commentList).removeClass('d-none');
        $(commentList).fadeIn();
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    });
  }

  renderComments();

  $(document).on('submit', '[data-form="comment-form"]', function(e) {
    e.preventDefault();

    const parent = $(this).siblings('.comment').attr('data-id');
    const button = $(this).find('button[type=submit]');

    const formData = new FormData(this);
    const action = $(this).attr('action');

    if (parent) {
      formData.append('id_parent', parent);
    }

    $.ajax({
      url: action,
      type: 'POST',
      data: formData,
      dataType: 'json',
      processData: false,
      contentType: false,
      beforeSend: function() {
        if (button) {
          $(button).attr('disabled', '');
        }
      }
    }).done(function(response) {
      if (response.error) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response.error).fadeIn();
      } else {
        renderComments();

        if (!parent) {
          window.editor.setData('');
        }
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    }).always(function() {
      if (button) {
        $(button).removeAttr('disabled');
      }
    });
  });
});