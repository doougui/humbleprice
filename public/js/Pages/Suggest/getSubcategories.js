$(document).ready(function() {
  $('#category').change(function() {
    const parentCategory = $(this).val();
    const action = `${DIRPAGE}category/subcategories/${parentCategory}`;

    $.ajax({
      url: action,
      type: 'POST',
      dataType: 'json',
    }).done(function(response) {
      $('#subcategory').html('<option value="">Escolha uma subcategoria</option>');
      response.forEach(subcategory => {
        $('<option>',{
          text: subcategory.name,
          value: subcategory.slug
        }).appendTo('#subcategory');
      });
    }).fail(function() {
      $('#error').removeClass('d-none');
      $('#error').addClass('d-block');
      $('#error-msg').html('Ops! Algo de errado aconteceu!').fadeIn();
    });
  });
});