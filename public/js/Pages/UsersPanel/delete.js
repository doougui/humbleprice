$(document).ready(function() {
  $('[data-btn="delete-user"]').click(async function(e) {
    e.preventDefault();

    const tr = $(this).closest('tr');
    const action = `${DIRPAGE}userspanel/delete/${$(tr).attr('data-item')}`;

    const error = $(tr).find($('[data-error="actions"]'));
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);

    try {
      const willDelete = await swal({
        title: "Deletar conta?",
        text: "Esta ação é irreversível e a conta não poderá ser recuperada",
        icon: "warning",
        buttons: ['Cancelar', 'Deletar conta permanentemente'],
        dangerMode: true,
      });

      if (willDelete) {
        $.ajax({
          url: action,
          type: 'POST',
          dataType: 'json',
          processData: false,
          contentType: false,
          beforeSend: function() {
            $(button).attr('disabled', '');
          }
        }).done(function(response) {
          if (response.error) {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html(response.error).fadeIn();
          } else {
            window.location.href = `${DIRPAGE}userspanel`;
          }
        }).fail(function() {
          $(error).removeClass('d-none');
          $(error).addClass('d-block');
          $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
        }).always(function() {
          $(button).removeAttr('disabled');
        });
      }
    } catch (e) {
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
      console.error(e);
    }
  });
});