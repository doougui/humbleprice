$(document).ready(function() {
  const endOffer = $('#end-offer');

  $('#offer-end-date-not-specified').change(function() {
    if (this.checked) {
      $(endOffer).attr('disabled', '');
    } else {
      $(endOffer).removeAttr('disabled', '');
    }
  });
});