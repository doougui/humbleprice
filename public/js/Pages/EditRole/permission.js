$(document).ready(function() {
  $('[data-btn="permission"]').click(async function(e) {
    e.preventDefault();

    const tr = $(this).closest('tr');

    const role = $(tr).attr('data-role');
    const ability = $(tr).attr('data-ability');

    const action = `${DIRPAGE}role/allow/${role}/${ability}`;

    const error = $(tr).find($('[data-error="ability"]'));
    const errorMsg = $(error).find('.error-msg');

    const button = $(this);
    const buttonText = $.trim($(button).text());

    try {
      let willToggleAbility;

      if (buttonText === 'Remover permissão') {
        willToggleAbility = await swal({
          title: "Remover permissão deste cargo?",
          text: "Se fizer isso, os usuários com este cargo perderão as habilidades correspondentes a essa permissão.",
          icon: "warning",
          buttons: ['Cancelar', 'Remover permissão'],
          dangerMode: true,
        });
      } else if (buttonText === 'Adicionar permissão') {
        willToggleAbility = await swal({
          title: "Adicionar permissão à este cargo?",
          text: "Se fizer isso, os usuários com este cargo terão acesso as habilidades correspondentes a essa permissão.",
          icon: "info",
          buttons: ['Cancelar', 'Adicionar permissão'],
          dangerMode: false,
        });
      }

      if (willToggleAbility) {
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
            window.location.href = `${DIRPAGE}role/edit/${role}`;
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