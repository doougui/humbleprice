$(document).ready(function() {
  const error = $('[data-error="offer-form"]');
  const errorMsg = $(error).find('.error-msg');

  const category = $('#category');
  const subcategory = $('#subcategory');

  function getCurrentSubcategory(offer) {
    const action = `${DIRPAGE}offer/subcategory/${offer}`;

    const subcategoryAjaxCall = $.ajax({
      url: action,
      type: 'POST',
      async: false,
      dataType: 'json',
      processData: false,
      contentType: false,
    }).done(function(response) {
      if (response.subcategory) {
        return true;
      } else if (response.error) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response.error).fadeIn();
        return false;
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      return false;
    });

    return JSON.parse(subcategoryAjaxCall.responseText).subcategory;
  }

  function getSubcategories() {
    const parentCategory = $(category).val();
    const action = `${DIRPAGE}category/subcategories/${parentCategory}`;

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
      $(subcategory).html('<option value="">Escolha uma subcategoria</option>');
      response.forEach(subcategoryItem => {
        $('<option>',{
          text: subcategoryItem.name,
          value: subcategoryItem.slug,
          selected: (subcategoryItem.slug === currentSubcategory),
        }).appendTo(subcategory);
      });
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    });
  }

  getSubcategories();

  $(category).change(function() {
    getSubcategories();
  });
});