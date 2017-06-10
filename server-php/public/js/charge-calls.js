// add a new post
$(document).on('click', '.add-modal', function() {
  $('.modal-title').text('Add');
  $('#addModal').modal('show');
});
$('.modal-footer').one('click', '.add', function() {
  $.ajax({
    type: 'POST',
    url: 'charge',
    data: {
      '_token': $('input[name=_token]').val(),
      'title': $('#title_add').val(),
      'user': $('#charge-user').val(),
      'receiver': $('#receiving-user').val(),
      'amount': $('#amount').val()
    },
    success: function(data) {
      console.log(data.amount);
      $('.errorTitle').addClass('hidden');
      $('.errorContent').addClass('hidden');

      if ((data.errors)) {
        setTimeout(function() {
          $('#addModal').modal('show');
          toastr.error('Validation error!', 'Error Alert', {
            timeOut: 5000
          });
        }, 500);

        if (data.errors.title) {
          $('.errorTitle').removeClass('hidden');
          $('.errorTitle').text(data.errors.title);
        }
        if (data.errors.content) {
          $('.errorContent').removeClass('hidden');
          $('.errorContent').text(data.errors.content);
        }
      } else {
        toastr.success('Successfully created Transaction!', 'Success Alert', {
          timeOut: 5000
        });
        $('#postTable').append(
          "<tr class='item" + data.id + "'><td class='col1'></td><td>" + data.id + "</td><td>" + data.user.email + "</td><td>" + data.receiver.email + "</td><td>" + data.amount + "</td><td class='text-center'>Right now</td>");

        $('.col1').each(function(index) {
          $(this).html(index + 1);
        });
      }
    },
  });
});

$(document).on('click', '#rate-settings', function() {
    $('#rate-modal').modal('show');
  $('#rate-settings .modal-footer').on('click', '.', function() {

    $.ajax({
      type: 'POST',
      url: 'user-settings',
      data: {
        '_token': $('input[name=_token]').val(),
        'amount': $('#amount').val()
      },
      success: function(data) {
        console.log(data.amount);
        $('.errorTitle').addClass('hidden');
        $('.errorContent').addClass('hidden');

        if ((data.errors)) {
          setTimeout(function() {
            $('#rate-setting').modal('show');
            toastr.error('Validation error!', 'Error Alert', {
              timeOut: 5000
            });
          }, 500);

          if (data.errors.title) {
            $('.errorTitle').removeClass('hidden');
            $('.errorTitle').text(data.errors.title);
          }
          if (data.errors.content) {
            $('.errorContent').removeClass('hidden');
            $('.errorContent').text(data.errors.content);
          }
        }
      }
    })
  })
});
