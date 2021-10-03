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
          <section class="wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item"><a href="#">संरचनाको बनौटको किसिम</a></li>
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
                      संरचनाको बनौटको किसिम
                        <span class="tools">
                          <button type="button" data-toggle="modal" href="#editModel" class="btn btn-primary btn-sm mb-2 pull-right" title="संरचनाको बनौटको किसिम थप्नुहोस्" data-url="<?php echo base_url()?>Setting/addSanrachanaStructureType"> <i class="fa fa-plus"></i>&nbsp;नयाँ थप्नुहोस् 
                      </button>
                      </span>
                    </header>
                    <div class="card-body">
                      <div class="adv-table">
                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                          <thead style="background: #1b5693; color:#fff">
                              <tr>
                                <th text-aligh="right">#</th> 
                                <th>आर्थिक वर्ष </th>
                                <th>बनौटको किसिम</th>
                                <th class="hidden-phone">.....</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($sanrachan_strucutre)) :
                              $i = 1;
                              foreach($sanrachan_strucutre as $key => $value) : ?>
                              <tr class="gradeX">
                                  <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                  <td><p class="badge badge-sm badge-info"><?php echo $this->mylibrary->convertedcit($value['fiscal_year'])?></p></td>
                                  <td><?php echo $value['structure_type']?></td>
                                  <td class="center hidden-phone">
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" href="<?php echo base_url()?>Setting/addSadakKoKisim/<?php echo $value['id']?>" data-id ="<?php echo $value['id']?>"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="मेटाउनुहोस्" data-toggle ="modal" data-target =""><i class="fa fa-trash-o"></i></button>
                                  </td>
                              </tr>
                              <?php endforeach;endif; ?>
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
   