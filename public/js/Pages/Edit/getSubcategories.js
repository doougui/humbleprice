function getCurrentSubcategory(offer) {
  const action = `${DIRPAGE}offer/subcategory/${offer}`;

  const error = $('#error');
  const errorMsg = error.find('#error-msg');

  const subcategoryAjaxCall = $.ajax({
    url: action,
    type: 'POST',
    async: false,
  }).done(function(response) {
    if (response.length > 0) {
      return true;
    }
  }).fail(function() {
    $(error).removeClass('d-none');
    $(error).addClass('d-block');
    $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    return false;
  });

  return subcategoryAjaxCall.responseText;
}

function getSubcategories() {
  const parentCategory = $('#category').val();
  const action = `${DIRPAGE}category/subcategories/${parentCategory}`;
  const error = $('#error');
  const errorMsg = error.find('#error-msg');

  const offer = $('[data-form="offer-form"]').attr('data-item');
  const currentSubcategory = getCurrentSubcategory(offer);

  if (!currentSubcategory) {
    return false;
  }

  $.ajax({
    url: action,
    type: 'POST',
    dataType: 'json',
  }).done(function(response) {
    $('#subcategory').html('<option value="">Escolha uma subcategoria</option>');
    response.forEach(subcategory => {
      $('<option>',{
        text: subcategory.name,
        value: subcategory.slug,
        selected: (subcategory.slug === currentSubcategory),
      }).appendTo('#subcategory');
    });
  }).fail(function() {
    $(error).removeClass('d-none');
    $(error).addClass('d-block');
    $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
  });
}

$(document).ready(function() {
  getSubcategories();

  $('#category').change(function() {
    getSubcategories();
  });
});