$(function() {
  var form = $('#contact');
  var formMessages = $('#form-messages');
  var formError = $('#form-errors');
  formMessages.hide();
  formError.hide();

  $(form).submit(function(event) {
    event.preventDefault();
    var formData = $(form).serialize();
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    }).done(function (response) {
      formMessages.fadeIn();
    }).fail(function (response) {
      formError.show();
    });
  });
});
