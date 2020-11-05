$(document).ready(function() {
  $('[data-btn="offer-link"]').click(async function() {
    const card = $(this).closest('.card');
    const action = `${DIRPAGE}report/create/${$(card).attr('data-item')}/unavailable`;

    const endOffer = $(card).attr('data-end');
    const alreadyReported = $(card).attr('data-reported');

    const error = $('[data-error="offer"]');
    const errorMsg = $(error).find('.error-msg');

    if (!endOffer && !alreadyReported) {
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