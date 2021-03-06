$(document).ready(function() {
  $('[data-btn="accept-report"]').click(async function(e) {
    e.preventDefault();

    const li = $(this).closest('.list-group-item');
    let action = `${DIRPAGE}report/accept/${$(li).attr('data-report')}`;

    const lis = $(`.list-group-item[data-item="${$(li).attr('data-item')}"]`);

    const error = $(this)
        .closest('.report-actions')
        .closest('.row')
        .siblings($('[data-error="report"]'));
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);

    try {
      const willClose = await swal({
        title: "Você tem certeza?",
        text: "Uma vez fechada, esta oferta se tornará inválida e o report será fechado.",
        icon: "warning",
        buttons: ['Cancelar', 'Encerrar oferta'],
        dangerMode: true,
      });

      if (willClose) {
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
            action = `${DIRPAGE}offer/close/${$(li).attr('data-item')}`;

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
                await swal("Oferta encerrada com sucesso", {
                  icon: "success",
                });

                $(lis).fadeOut();
              }
            }).fail(function() {
              $(error).removeClass('d-none');
              $(error).addClass('d-block');
              $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
            });
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