$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    //save sampati kar bhumi kar
    $(document).off('submit', '.search_report').on('submit', '.search_report', function(e){
      e.preventDefault();
      var obj = $(this),
      url = obj.attr('action');
      form_data = new FormData(obj[0]);
      $.ajax({
        url : url,
        dataType: 'json',
        contentType: false,
        processData: false,
        data : form_data,
        type : "POST",
        beforeSend: function () {
         $('.save_button').html('<i class="fa fa-spinner fa-spin"></i> खोज्नुहोस');
         $('.save_button').attr('disabled',true);
        },
        success: function(resp) {
            toastr.options = {
              "closeButton": true,
              "debug": true,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "showDuration": "1000",
              "hideDuration": "5000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            if(resp.status == 'validation_error') {
              toastr.error(resp.message);
              $('.save_button').attr('disabled',false);
              $('.save_button').text('खोज्नुहोस');
            }
            if(resp.status == 'success') {
              $('.search_div').html(resp.data);
              $('.save_button').attr('disabled',false);
              $('.save_button').text('खोज्नुहोस');
            }
            if(resp.status == 'empty') {
              $('.save_button').attr('disabled',false);
              $('.save_button').text('खोज्नुहोस');
              $('.search_div').html(resp.data);
            }
        }, 
        error: function() {
          return false;
        }
      });
    });


      $(document).on('keypress', '.number_field', function(e){
          //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {

            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          toastr.error('नम्बर प्रविष्ट गर्नुहोस्');
          // obj = $(this);
          // alert('नम्बर प्रविष्ट गर्नुहोस्');
          //display error message
          //$(this).closet()$("#num_err").html("प्रविष्ट गर्नुहोस्").show().fadeOut("slow");
          //$(this).closest('#num_err').html("नम्बर प्रविष्ट गर्नुहोस्").show().fadeOut("slow");
          //obj.find().$("#num_err").html("नम्बर प्रविष्ट गर्नुहोस्").show().fadeOut("slow");
          return false;
        }

       

      });

      $(document).on('keypress', '.decimal_field', function(e){
       

        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            //$("#num_err").html("प्रविष्ट गर्नुहोस्").show().fadeOut("slow");
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
          toastr.error('नम्बर प्रविष्ट गर्नुहोस्');
            return false;
            event.preventDefault();
        }
  
      });

    // $(".number_field").keypress(function (e) {
    //     //if the letter is not digit then display error and don't type anything
    //     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    //       //display error message
    //       $("#num_err").html("Digits Only").show().fadeOut("slow");
    //       return false;
    //     }
    //   });
   
});