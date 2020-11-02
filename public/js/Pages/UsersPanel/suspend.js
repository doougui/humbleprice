$(document).ready(function() {
  $('[data-btn="suspend"]').click(async function(e) {
    e.preventDefault();

    const tr = $(this).closest('tr');
    const action = `${DIRPAGE}userspanel/suspend/${$(tr).attr('data-item')}`;
    const error = $(tr).find('.actions-errors');
    const errorMsg = $(error).find('.error-msg');
    const button = $(this);
    const buttonText = $.trim($(button).text());

    try {
      let willSuspend;

      if (buttonText === 'Suspender') {
        willSuspend = await swal({
          title: "Suspender usuário?",
          text: "Se fizer isso, o mesmo perderá acesso total ao sistema até que a conta seja re-ativada.",
          icon: "warning",
          buttons: ['Cancelar', 'Suspender usuário'],
          dangerMode: true,
        });
      } else if (buttonText === 'Re-ativar') {
        willSuspend = await swal({
          title: "Re-ativar conta de usuário?",
          text: "Se fizer isso, o mesmo terá acesso ao sistema e suas funcionalidades novamente.",
          icon: "info",
          buttons: ['Cancelar', 'Re-ativar conta'],
          dangerMode: false,
        });
      }

      if (willSuspend) {
        $.ajax({
          url: action,
          type: 'POST',
          beforeSend: function() {
            $(button).attr('disabled', '');
          }
        }).done(function(response) {
          if (response.length !== 0) {
            $(error).removeClass('d-none');
            $(error).addClass('d-block');
            $(errorMsg).html(response).fadeIn();
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