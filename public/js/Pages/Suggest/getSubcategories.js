$(document).ready(function() {
  const error = $('[data-error="offer-form"]');
  const errorMsg = $(error).find('.error-msg');

  const subcategory = $('#subcategory');

  $('#category').change(function() {
    const parentCategory = $(this).val();
    const action = `${DIRPAGE}category/subcategories/${parentCategory}`;

    $.ajax({
      url: action,
      type: 'POST',
      dataType: 'json',
    }).done(function(response) {
      $(subcategory).html('<option value="">Escolha uma subcategoria</option>');
      response.forEach(subcategoryItem => {
        $('<option>',{
          text: subcategoryItem.name,
          value: subcategoryItem.slug
        }).appendTo(subcategory);
      });
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    });
  });
});