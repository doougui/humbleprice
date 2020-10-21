$(document).ready(function() {
  $('#offer-end-date-not-specified').change(function() {
    const endOffer = $('#end-offer');

    if (this.checked) {
      $(endOffer).attr('disabled', '');
    } else {
      $(endOffer).removeAttr('disabled', '');
    }
  });
});