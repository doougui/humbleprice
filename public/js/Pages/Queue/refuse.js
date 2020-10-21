$(document).ready(function() {
  $('.refuse').click(async function(e) {
    e.preventDefault();

    const card = $(this).closest('.card-item');
    const action = `${DIRPAGE}queue/refuse/${$(card).attr('data-item')}`;
    const error = $(card).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(card).find('.approve');

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
        }).done(function(response) {
          if (response.length !== 0) {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html(response).fadeIn();
          } else {
            $(card).fadeOut();
          }
        }).fail(function() {
          $(error).removeClass('d-none');
          $(error).addClass('d-block');
          $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
        }).always(function() {
          $(button).removeClass('disabled');
        });

        swal("Oferta recusada com sucesso", {
          icon: "success",
        });
      }
    } catch (e) {
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      console.error(e);
    }
  });
});