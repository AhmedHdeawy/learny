$(document).ready(function() {

  // Add Responsive class to table in Small Devices
  if ($(window).width() < 767) {
    
    $('.card-block .table').addClass('table-responsive');
  } else {
    $('.card-block .table').removeClass('table-responsive');
  }

  /**
  * Custom Alert to show Delete Message
  */

  $('.delete-form').click(function(e) {
    e.preventDefault() // Don't post the form, unless confirmed
      
      alertify.dialog('confirm')
        .set('title', '')
        .set({transition:'zoom',message: 'هل انت متأكد من الحذف ؟'})
        .set('onok', function(closeEvent){
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        })
        .set('oncancel', function(closeEvent){
          
        })
        .show();
  });


  $('.imageUpload').change(function(event){

      let input = event.target.files[0];
      const inputName = $(this).data('id');

      if (input) {
          var reader = new FileReader();            
          reader.onload = function (e) {
            $('#'+ inputName).attr('src', e.target.result);
          }
          reader.readAsDataURL(input);
      }

  })


  $('.reset-form').click(function(event) {
    
    $(':input').val('')

  });

});
