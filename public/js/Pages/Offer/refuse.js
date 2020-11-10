$(document).ready(function() {
  $('[data-btn="refuse"]').click(async function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offer/refuse/${$(card).attr('data-item')}`;

    const error = $('[data-error="offer"]');
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);
    const buttons = $('#queue-actions');

    try {
      const willRefuse = await swal({
        title: "Você tem certeza?",
        text: "Uma vez recusada, você não será capaz de recuperar e/ou aprovar esta oferta.",
        icon: "warning",
        buttons: ['Cancelar', 'Recusar oferta'],
        dangerMode: true,
      });

      if (willRefuse) {
        $.ajax({
          url: action,
          type: 'POST',
          dataType: 'json',
          processData: false,
          contentType: false,
          beforeSend: function() {
            $(button).addClass('disabled');
          }
        }).done(async function(response) {
          if (response.error) {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html(response.error).fadeIn();
          } else {
            await swal("Oferta recusada com sucesso", {
              icon: "success",
            });

            await $(buttons).fadeOut();

            window.location.href = `${DIRPAGE}offer/view/${$(card).attr('data-item')}`;
          }
        }).fail(function() {
          $(error).removeClass('d-none');
          $(error).addClass('d-block');
          $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
        }).always(function() {
          $(button).removeClass('disabled');
        });
      }
    } catch (e) {
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      console.error(e);
    }
  });
});