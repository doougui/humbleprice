$(document).ready(function() {
  $('[data-link="report-reason"]').click(function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = $(this).attr('href');

    const error = $('[data-error="offer"]');
    const errorMsg = $(error).find('.error-msg');

    $.ajax({
      url: action,
      type: 'POST',
      dataType: 'json',
      processData: false,
      contentType: false,
    }).done(async function(response) {
      if (response.error) {
        $(error).removeClass('d-none');
        $(error).addClass('d-block');
        $(errorMsg).html(response.error).fadeIn();
      } else {
        await swal("Agradecemos pelo seu aviso.", {
          icon: "success",
          timer: 1500,
        });

        $(card).attr('data-reported', 'true');
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    });
  });
});