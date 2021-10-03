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
                <li class="breadcrumb-item"><a href="#">सम्पतिकर तथा भूमिकर</a></li>
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
                <section class="card">
                  <header class="card-header" style="background: #1b5693">
                    <span class="tools">
                      <a class="fa fa-plus" href="javascript:;" style="color:#FFF"> नयाँ थप्नुहोस् </a>
                    </span>
                  </header>
                  
                  <div class="card-body">
                    <div class="error_message"></div>
                    <div class="adv-table">
                      <?php
                        $attr = array(
                          'class' => 'form-horizontal',
                          'id'    => 'add_new_kar_rate'
                        );
                        $actionurl = 'Setting/SaveSampatiBhumiKar';
                        echo form_open_multipart($actionurl, $attr);
                      ?>
                        <table class=" display table table-bordered table-striped" id="add_new_fields">
                          <tbody>
                            <tr class="sampati_kar_add" id="sampati_kar_add_1" data-id="1">
                              <td>
                                
                                  <select class="form-control" name="fiscal_year" id = "set_fiscal_year" s>
                                    <option value="">आर्थिक वर्ष चयन गर्नुहोस्</option>
                                    <?php
                                    if(!empty($fiscal_year)) : 
                                      foreach ($fiscal_year as $key => $value) : ?>
                                        <option value="<?php echo $value['year']?>" <?php if($value['year'] ==$this->session->userdata('add_fiscal_year')){ echo 'selected';} ?>><?php echo $value['year']?></option>
                                      <?php endforeach;endif?>
                                    </select>
                              </td>
                              <td>
                                <input type="text" name="from" class="form-control"  placeholder="*देखि" required="required">
                                <span class="err_message"></span>
                              </td>
                              <td>
                                <input type="text" name="to" class="form-control"  placeholder="*सम्म" required="required">
                                <span class="err_message"></span>
                              </td>
                              <td>
                                <input type="text" name="sampati_kar" class="form-control" required= "required" placeholder="*सम्पतिकर" required="required">
                                <span class="err_message"></span>
                              </td>
                              <td>
                                <input type="text" name="bhunmi_kar" class="form-control"  placeholder="*भूमिकर" required="required">
                                <span class="err_message"></span>
                              </td>
                              <td>
                                <div class="pull-right">
                                  <button type="submit" class="btn btn-success btm-sm"> सेभ  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </form>
                    </div>
                  </div>
                </section>
                <section class="card">
                  <header class="card-header">
                    सम्पतिकर तथा भूमिकर
                  </header>
                  <div class="card-body">
                    <div class="adv-table">
                      <table  class="display table table-bordered table-striped" id="dynamic-table">
                        <thead style="background: #1b5693; color:#fff">
                            <tr>
                              <th text-aligh="right">#</th> 
                               <th>आर्थिक वर्ष</th>
                              <th>देखि</th>
                              <th>सम्म</th>
                              <th>सम्पतिकर</th>
                              <th>भूमिकर</th>
                              <th class="hidden-phone">.....</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($sampati_bhumi_kar)) :
                            $i = 1;
                            foreach($sampati_bhumi_kar as $key => $value) : ?>
                            <tr class="gradeX">
                                <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                <td><p class="badge badge-sm badge-info"><?php echo $this->mylibrary->convertedcit($value['fiscal_year'])?></p></td>
                                <td><?php echo $this->mylibrary->convertedcit($value['from_rate'])?></td>
                                <td><?php echo $this->mylibrary->convertedcit($value['to_rate'])?></td>
                                <td><?php echo $this->mylibrary->convertedcit($value['sampati_kar'])?></td>
                                <td><?php echo $this->mylibrary->convertedcit($value['bhumi_kar'])?></td>
                                <td class="center hidden-phone">
                                
                                  <a class="btn btn-primary btn-sm" data-toggle="modal" href="#editModel" data-id ="<?php echo $value['id']?>"><i class="fa fa-edit"></i></a>

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
          url : '<?php echo base_url()?>Setting/editDetailsView', //Here you will fetch records 
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

      // $('#show_form').on('click', function(){
      //   $('#add_more').addClass('save_first');
      //   $('.form-section').toggle();
      // });

      // $('.btnNewAdd').click(function(e){
      //     var trOneNew = $('.productPurchaseFields').length+1;
      //     var va = $('#engine_no_1').val();
      //     e.preventDefault();
      //     var new_row='<tr class="productPurchaseFields" id="productPurchaseFields_'+trOneNew+'" data-id="'+trOneNew+'">'+
      //             '<td><input type="text" name="from" class="form-control"></td>'+
      //             '<td><input type="text" name="from" class="form-control"></td>'+
      //             '<td><input type="text" name="from" class="form-control"></td>'+
      //             '<td width="200"><input type="text" name="from" class="form-control"></td>'+
      //             '<td>'+
      //             '<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्"><i class="fa fa-save"></i></button>'+
      //             '<button class="btn btn-danger btn-xs remove-row" data-toggle="tooltip" title="मेटाउनुहोस्"><i class="fa fa-trash-o"></i></button>'+
      //             '</td>'+
      //           '</tr>';
      //     $("#add_new_fields").append(new_row);
      // });
      // $("body").on("click",".remove-row", function(e){
      //   e.preventDefault();
      //   $(this).parent().parent().remove();
      //   $(".ajax-error-message").empty();
      //   $('.btnNewAdd').removeAttr('disabled','disabled');
      //   $('#btnsubmit').removeAttr('disabled','disabled');
      // });

    </script>
   