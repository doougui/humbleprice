$(document).ready(function() {
  $('.refuse').click(async function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offer/refuse/${$(card).attr('data-item')}`;
    const error = $(card).find('.error');
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
          beforeSend: function() {
            $(button).addClass('disabled');
          }
        }).done(async function(response) {
          if (response.length !== 0) {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html(response).fadeIn();
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