$(document).ready(function () {
  $(document).on('click', '[data-btn="cancel"]', function() {
    $('.reply-form').remove();
  });
});