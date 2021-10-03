 
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
                        <table  class="display table table-bordered table-striped">
                          <thead>
                              <tr>
                                <th text-aligh="right">#</th> 
                                <th>आर्थिक वर्ष</th>
                                <th>संरचनाको आयु</th>
                                <th>संरचनाको किसिम</th>
                                <th>कर (%)</th>
                               
                                 <?php if($this->authlibrary->HasModulePermission('ROAD', "EDIT") || $this->authlibrary->HasModulePermission('DETERIORATION-STRUCTURE', "DELETE") ) { ?>
                                  <th class="hidden-phone">.....</th>
                                <?php } ?>
                              </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($data)) :
                              $i = 1;
                              foreach($data as $key => $value) : ?>
                              <tr class="gradeX">
                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                  <td><p class="badge badge-sm badge-info"><?php echo $this->mylibrary->convertedcit($value['fy'])?></p></td>
                                   <td><?php echo $value['from_range'].'-'.$value['to_range']?></td>
                                  <td><?php echo $value['structure_type']?></td>
                                  <td><?php echo $this->mylibrary->convertedcit($value['rate'])?></td>
                                  <?php if($this->authlibrary->HasModulePermission('DETERIORATION-STRUCTURE', "EDIT") || $this->authlibrary->HasModulePermission('DETERIORATION-STRUCTURE', "DELETE") ) { ?>
                                  <td class="center hidden-phone">
                                    <?php if($this->authlibrary->HasModulePermission('DETERIORATION-STRUCTURE', "EDIT")) { ?>
                                      <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>DeteriorationStructure/add/<?php echo $value['id']?>"><i class="fa fa-edit"></i></a>

                                      <?php } ?>
                                        <?php if($this->authlibrary->HasModulePermission('DETERIORATION-STRUCTURE', "DELETE") ) { ?>
                                        <button data-url ='<?php echo base_url()?>DeteriorationStructure/delete' class='btn-danger btn-sm btn-delete' data-id = "<?php echo $value['id']?>"><i class='fa fa-trash-o'></i></button>
                                      <?php } ?>

                                  </td>
                                <?php } ?>
                              </tr>
                              <?php endforeach;
                            else : ?>
                              <tr><td colspan="6"><div class="alert alert-danger">चालु आ. वा. संरचनाको आयु र किसिम अनुसारको दर दाखिला गरिएको छैन</div></td></tr>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
          </section>
      </section>

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

     

      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });

      //pop up edit modal
      //$('#editModel').on('shown.bs.modal', function (e) { //Modal Event

      //$('#editModel').on('shown.bs.modal', function (e) { //Modal Event
      //   $(document).on('show.bs.modal','#editModel', function (e) {
      //   var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
      //   $.ajax({
      //     type : 'POST',
      //     url : '<?php echo base_url()?>Setting/addRoadType', //Here you will fetch records 
      //     data: {updateID:id}, //Pass $id
      //     success : function(data){
      //       //if (resp.status == "success") {
      //         $("#editModel").find('.modal-view').html(data);

      //      // }
      //       // $('modal_view').html(data);
      //      // $('.form-data').html(data);//Show fetched data from database
      //     }
      //   });
      // });
      
      
        $(document).on('click','.btn-delete', function(e){
          //e.preventDefault();
          var id = $(this).data('id'); //Fetch id from modal trigger button
         
          var url = $(this).data('url');
          if (confirm("Are you sure want to delete?") == true) {
                $(this).closest('tr').css('backgroundColor', 'red');
                  $.ajax({
                    type : 'POST',
                    url : url, //Here you will fetch records 
                    data: {id:id,'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'}, //Pass $id
                    success : function(resp){
                      console.log(resp);
                    //   return;
                      if(resp.status == 'success') {
                        toastr.options = {
                          "closeButton": true,
                          "debug": true,
                          "progressBar": true,
                          "positionClass": "toast-top-right",
                          "showDuration": "200",
                          "hideDuration": "1000",
                          "timeOut": "3000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };
                        toastr.success(resp.data);
                        setTimeout(function(){ 
                          location.reload();
                        }, 2000);
                      } else {
                        toastr.options = {
                          "closeButton": true,
                          "debug": true,
                          "progressBar": true,
                          "positionClass": "toast-top-right",
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "5000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };
                        toastr.success(resp.data);
                        setTimeout(function(){ 
                          location.reload();
                        }, 2000);
                      }
                     }
                  });
          } else {
            return false;
          }
        });
    </script>
   