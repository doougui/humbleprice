$(document).ready(function() {
  $('[data-btn="close-offer"]').click(async function(e) {
    e.preventDefault();

    const card = $(this).closest('.card');
    const action = `${DIRPAGE}offer/close/${$(card).attr('data-item')}`;
    const error = $(card).find('.error');
    const errorMsg = $(error).find('.error-msg');
    const button = $(this);

    try {
      const willClose = await swal({
        title: "Você tem certeza?",
        text: "Uma vez fechada, esta oferta se tornará inválida.",
        icon: "warning",
        buttons: ['Cancelar', 'Encerrar oferta'],
        dangerMode: true,
      });

      if (willClose) {
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
            await swal("Oferta fechada com sucesso", {
              icon: "success",
            });

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