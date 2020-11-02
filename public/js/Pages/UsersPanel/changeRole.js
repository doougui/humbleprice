$(document).ready(function() {
  $('[data-select="role"]').change(function() {
    const tr = $(this).closest('tr');
    const selectedRole = $(this).val();
    const action = `${DIRPAGE}userspanel/assignRole/${$(tr).attr('data-item')}/${selectedRole}`;

    const error = $(tr).find($('[data-error="roles"]'));
    const errorMsg = $(error).find('.error-msg');

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
        window.location.href = `${DIRPAGE}userspanel`;
      }
    }).fail(function() {
      $(error).removeClass('d-none');
      $(error).addClass('d-block');
      $(errorMsg).html('Ops! Algo de errado aconteceu!').fadeIn();
    });
  });
});