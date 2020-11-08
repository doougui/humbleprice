$(document).ready(function() {
  $('[data-btn="refuse-report"]').click(async function(e) {
    e.preventDefault();

    const li = $(this).closest('.list-group-item');
    const action = `${DIRPAGE}report/refuse/${$(li).attr('data-report')}`;

    const error = $(this)
        .closest('.report-actions')
        .closest('.row')
        .siblings($('[data-error="report"]'));
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);

    try {
      const willRefuse = await swal({
        title: "Você tem certeza?",
        text: "Deseja mesmo recusar este report?",
        icon: "info",
        buttons: ['Cancelar', 'Recusar report'],
        dangerMode: false,
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
            await swal("Report recusado com sucesso", {
              icon: "success",
            });

            $(li).fadeOut();
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