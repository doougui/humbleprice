$(document).ready(function() {
  $('[data-btn="offer-link"]').click(async function() {
    const card = $(this).closest('.card');
    const action = `${DIRPAGE}report/unavailable/${$(card).attr('data-item')}`;

    const endOffer = $(card).attr('data-end');

    const error = $('[data-error="offer"]');
    const errorMsg = $(error).find('.error-msg');

    if (!endOffer) {
      try {
        const isValid = await swal("Esta oferta ainda está disponível?", {
          buttons: {
            unavailable: {
              text: "Oferta inválida"
            },
            available: {
              text: "Oferta válida"
            },
          },
        });

        if (isValid && isValid === 'unavailable') {
          $.ajax({
            url: action,
            type: 'POST',
          }).done(async function(response) {
            if (response.length !== 0) {
              $(error).removeClass('d-none');
              $(error).addClass('d-block');
              $(errorMsg).html(response).fadeIn();
            } else {
              await swal("Agradecemos pelo seu aviso.", {
                icon: "success",
                timer: 1250,
              });
            }
          }).fail(function() {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
          });
        }
      } catch (e) {
        $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
        console.error(e);
      }
    }
  });
});