$(document).ready(function() {
  $('[data-btn="delete"]').click(async function(e) {
    e.preventDefault();

    const card = $(this).closest('.card-item');
    const action = `${DIRPAGE}offer/delete/${$(card).attr('data-item')}`;

    const error = $(card).find('[data-error="offer-card"]');
    const errorMsg = $(error).find('.error-msg');

    try {
      const willDelete = await swal({
        title: "Você tem certeza?",
        text: "Ao realizar esta ação, esta oferta será excluida permanentemente.",
        icon: "warning",
        buttons: ['Cancelar', 'Deletar oferta'],
        dangerMode: true,
      });

      if (willDelete) {
        $.ajax({
          url: action,
          type: 'POST',
          dataType: 'json',
          processData: false,
          contentType: false,
        }).done(function(response) {
          if (response.error) {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html(response.error).fadeIn();
          } else {
            swal("Oferta deletada com sucesso", {
              icon: "success",
            });

            $(card).fadeOut();
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
  });
});