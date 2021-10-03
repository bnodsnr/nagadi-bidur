 <!--dynamic table-->
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />

    <style>
      ::-webkit-input-placeholder { /* Edge */
        color: red;
      }

      :-ms-input-placeholder { /* Internet Explorer */
        color: red;
      }

      ::placeholder {
        color: red;
      }
      .error li {
        color:red;
      }
    </style>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="javascript:;">संरचनाको आयु र किसिम अनुसारको दर</a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                  <?php $success_message = $this->session->flashdata("MSG_SUCCESS");
                      if(!empty($success_message)) { ?>
                      <div class="alert alert-success">
                          <button class="close" data-close="alert"></button>
                          <span> <?php echo $success_message;?> </span>
                      </div>
                    <?php } ?>
              
                  <section class="card" style="margin-bottom: -25px;">
                    <header class="card-header">
                     संरचनाको आयु र किसिम अनुसारको दर
                        <span class="tools">
                        <?php if($this->authlibrary->HasModulePermission('DETERIORATION-STRUCTURE', "ADD")) { ?>
                          <a class="btn btn-info btn-success pull-right" href="<?php echo base_url()?>DeteriorationStructure/add" style="color:#FFF"> नयाँ थप्नुहोस् </a>
                        <?php } ?>
                        
                      </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
          </section>
      </section>
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript">
      $(document).off('submit', '#add_new_kar_rate').on('submit', '#add_new_kar_rate', function(e)
      {
        e.preventDefault();
        var obj = $(this),
        url = obj.attr('action'),
        form_data = new FormData(obj[0]);
        $.ajax({
          url : url,
          dataType: 'json',
          contentType: false,
          processData: false,
          data : form_data,
          type : "POST",
          beforeSend: function () {
            $('.spin-loader').show();
          },
          complete: function () {
            $('.spin-loader').hide();
          },
          success: function(resp) {
            if(resp.status == 'success') {
              $('.error_message').html(resp.data);
              location.reload();
            } 
            if (resp.status = 'error') {
              if(resp.messase == 'form_error') {
                $.each(resp.data, function(index, element) {
                  $('.error_message').html('<div class="revenue-head"><ul><li>'+resp.data+'</li></ul></div>');
                  });
              }
              if(resp.messase == 'du_error') {
                $('.error_message').html(resp.data);

              }
            }
          }, 
          error: function() {
            alert('Internal Server Error!');
          }
        });
      }); 

      $('#dynamic-table').dataTable( {
        // "aaSorting": [[ 4, "desc" ]]
      });

      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });

      //pop up edit modal
      //$('#editModel').on('shown.bs.modal', function (e) { //Modal Event

      //$('#editModel').on('shown.bs.modal', function (e) { //Modal Event
        $(document).on('show.bs.modal','#editModel', function (e) {
        var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
        $.ajax({
          type : 'POST',
          url : '<?php echo base_url()?>Setting/addRoadType', //Here you will fetch records 
          data: {updateID:id}, //Pass $id
          success : function(data){
            //if (resp.status == "success") {
              $("#editModel").find('.modal-view').html(data);

           // }
            // $('modal_view').html(data);
           // $('.form-data').html(data);//Show fetched data from database
          }
        });
      });
    </script>
   