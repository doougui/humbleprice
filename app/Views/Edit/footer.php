<script src="<?= DIRJS ?>Forms/offer.js"></script>
<script src="<?= DIRJS ?>Pages/Edit/getSubcategories.js"></script>
<script src="<?= DIRJS ?>Pages/Suggest/offerEndDate.js"></script>
<script src="<?= DIRJS ?>ckeditor.js"></script>
<script>
  ClassicEditor
      .create(document.querySelector('#editor'), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo']
      } )
          .then(editor => {
            window.editor = editor;
          } )
          .catch(err => {
            console.error(err.stack);
          } );
</script>