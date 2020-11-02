$(document).ready(function () {
  const offerSlug = $('#offer').find('.card').attr('data-item');

  $(document).on('click', '.reply', function() {
    const thread = $(this).closest('.thread');

    const author = $(this)
        .closest('.comment-actions')
        .siblings('.comment-header')
        .find('.comment-author-name')
        .html();

    $('.reply-form').remove();

    const replyForm = `
        <form method="POST" class="comment-form reply-form" action="${DIRPAGE}comment/publish/${offerSlug}">
            <div class="form-group">
                <textarea name="comment" class="editor">
                    @${author} 
                </textarea>
            </div>
  
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-link cancel">Cancelar</button>
                <button type="submit" class="btn btn-themed">Publicar resposta</button>
            </div>
        </form>
      `;

    $(thread).append(replyForm);

    const editor = $(thread).find('.editor');
    let replyEditor;

    ClassicEditor
        .create(editor[0], {
          toolbar: ['heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo']
        })
        .then(editor => {
          replyEditor = editor;
        })
        .catch(err => {
          console.error(err.stack);
        });
  });
});