<script src="<?= DIRJS ?>Pages/Offer/close.js"></script>
<script src="<?= DIRJS ?>Pages/Offer/approve.js"></script>
<script src="<?= DIRJS ?>Pages/Offer/refuse.js"></script>
<script src="<?= DIRJS ?>Pages/Offer/like.js"></script>
<script src="<?= DIRJS ?>Pages/Offer/isOfferValid.js"></script>
<script>const DIRIMG = '<?= DIRIMG ?>'</script>
<script>const logged = <?= (user()) ? 'true' : 'false' ?></script>
<script src="<?= DIRJS ?>Forms/comment.js"></script>
<script src="<?= DIRJS ?>ckeditor.js"></script>
<script>
  const editor = document.querySelector('#editor');

  if (editor) {
    ClassicEditor
      .create(editor, {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo']
      } )
      .then(editor => {
        window.editor = editor;
      } )
      .catch(err => {
        console.error(err.stack);
      } );
  }
</script>