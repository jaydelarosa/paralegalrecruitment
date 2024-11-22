$(document).ready(function() {
    

    $(document).on('click', '.enrol-novoucher-btn', function() {
            
        $('.coupon').removeAttr('required');
        $('.coupon').val('');
        $('.voucher-field').hide();
        $('#enrolcourseModal').modal('show');
            
        return false;
    });
    
    $(document).on('click', '.enrol-voucher-btn', function() {
            
        $('.voucher-field').show();
        $('.coupon').attr('required');
        $('#enrolcourseModal').modal('show');
        
        return false;
    });
    
    $('#enrol-form-id').on('submit', function(event) {
    //   $(document).on('click', '.enrol-btn', function() {
        event.preventDefault(); // Prevent the default form submission
        $('.enrol-btn').prop('disabled', true).text('Submitting...');
    
      $.ajax({
        url: baseurl+'learn/enrol', // URL to send the request to
        type: 'POST',
        data: $('#enrol-form-id').serialize(), // Serialize the form data
        dataType: 'json', // Expect JSON response
        success: function(response) {
        //   $('.enrol-form-notification').html('<div class="alert alert-success">Form submitted successfully!</div>');
        
          if( response.status == 'success' ){
                // window.location.href = baseurl+'thankyou?course=1';
                window.location.href = response.redirecturl;
    
                $('.first_name').val('');
                $('.last_name').val('');
                $('.email').val('');
                $('.coupon').val('');
                    
          }
          else{
              $('.enrol-form-notification').html('<div class="alert alert-danger">' + response.message + '</div>');
          }
        // alert(response.message);
        //   console.logmessage; // Log response to the console for debugging
        },
        error: function(xhr, status, error) {
          $('.enrol-form-notification').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
          console.error(error); // Log error to the console for debugging
        },
        complete: function() {
          // Re-enable the button and change text back after AJAX completes
          $('.enrol-btn').prop('disabled', false).text('Submit');
        }
      });
      
      return false;

    });

    $(document).on('click', '.submit-sub-btn', function() {
            
      var subsname = $('.subs-name').val();
      var subsemail = $('.subs-email').val();

      $('.submit-sub-btn').prop('disabled', true).val('Submitting..');

      if(subsemail!=''){
          $.ajax({
              url: baseurl+"home/sendsubscription",
              type:'POST',
              dataType: 'json',
              data: { name: subsname, email: subsemail },
              success: function(response){
  
                  $('.subs-info').html('Your subscription has been submitted!');
                  $('.subs-info').show();
                  
                  $('.subs-name').val('');
                  $('.subs-email').val('');

                  $('.submit-sub-btn').prop('disabled', false).val('Submit');

              }
          });
      }
      else{
          $('.subs-info').html('Your email is required!');
          $('.subs-info').show();

          $('.submit-sub-btn').prop('disabled', false).val('Submit');
      }
      
      
      return false;
  });


});

