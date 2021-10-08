
$(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip(); 
  	$(document).on('show.bs.modal','#editModel', function (e) {
     // alert(csrf_token);
          var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
          var url = $(e.relatedTarget).data('url');
          $.ajax({
          	type : 'POST',
            url : url, //Here you will fetch records 
            data: {id:id}, //Pass $id
            success : function(data){
            	$("#editModel").find('.modal-view').html(data);
            }
          });
    });
    

    $(document).on('show.bs.modal','#previewModel', function (e) {
     // alert(csrf_token);
          var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
          var url = $(e.relatedTarget).data('url');
          $.ajax({
            type : 'POST',
            url : url, //Here you will fetch records 
            data: {id:id}, //Pass $id
            success : function(data){
              $("#previewModel").find('.modal-view').html(data);
            }
          });
    });


    $(document).on('show.bs.modal','#addModel', function (e) {
      var url = $(e.relatedTarget).data('url');
      $.ajax({
        type : 'POST',
        url : url, //Here you will fetch records 
        data: {}, //Pass $id
        success : function(data){
          $("#addModel").find('.modal-view').html(data);
        }
      });
    });

    $('#btn_set_fiscal_year').on('click', function(){
      var set_fiscal_year = $('#set_fiscal_year').val();
      var url = $(this).data('url');
      $.ajax({
          method:"POST",
          url:url,
          data: {set_fiscal_year:set_fiscal_year},
          success:function(data) {
            if(data.status == 'success') {
              $('.notifcation').hide();
              $('.show_form').html(data.message);
            }
            if(data.status == 'error') {
              $('.notifcation').hide();
              $('.show_form').html('<div class="alert alert-danger">कृपया आर्थिक वर्ष चयन गर्नुहोस् !</div>')
            }
          } 
      });
    });

    $('.set_fiscal_year_frm').on('change', function(){
    	 var set_fiscal_year = $(this).val();
      	$.ajax({
          method:"POST",
          url:base_url+"Setting/SetFiscalYear",
          data: {set_fiscal_year:set_fiscal_year},
          success:function(data) {
            if(data.status == 'success') {
              $('.notifcation').hide();
              $('.show_form').html(data.message);
            }
            if(data.status == 'error') {
              $('.notifcation').hide();
              $('.show_form').html('<div class="alert alert-danger">कृपया आर्थिक वर्ष चयन गर्नुहोस् !</div>')
            }
          } 
      	});
    });

    //save sampati kar bhumi kar
    $(document).off('submit', '.save_post').on('submit', '.save_post', function(e){
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
         obj.find('.save_btn').html('<i class="fa fa-spinner fa-spin"></i> सेभ गर्नुहोस्!');
         obj.find('.save_btn').attr('disabled',true);
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
             obj.find('.save_btn').attr('disabled',false);
            obj.find('.save_btn').text('सेभ गर्नुहोस्');
            toastr.error(resp.message);
            $('.valid_errors').html(resp.message);
             
          }
          if(resp.status == 'success') {
           obj.find('.save_btn').attr('disabled',false);
            toastr.success(resp.data);
            if(resp.message == 'redirect' ) {
              window.location.href = resp.redirect_url;
            } else {
              setTimeout(function(){ 
                location.reload();
              }, 1000);
            }
          } 
          if(resp.status == 'error') {
            obj.find('.save_btn').attr('disabled',false);
            toastr.error(resp.message);
            obj.find('.save_btn').text('सेभ गर्नुहोस्');
          }
        }, 
        error: function() {
          alert('Internal Server Error!');
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
      
    $(document).on('input','#numberc', function(){
      var num = $(this).val();
      $.ajax({
          url:base_url+'CommonController/convertNum',
          method:"POST",
          data:{num:num,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
          success : function(resp) {
            $('#numberc').val(resp);
        }
      });
    });

    $(document).on('keypress','#engalpha', function(){
      var alpha = $(this).val();
      $.ajax({
          url:base_url+'PersonalProfile/checkEngAlpha',
          method:"POST",
          data:{aplha:alpha,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
          success : function(resp) {
            $('#numberc').val(resp);
        }
      });
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