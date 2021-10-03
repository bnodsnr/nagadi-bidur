 <!--dynamic table-->
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.css" />
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                   <li class="breadcrumb-item"><a href="<?php echo base_url()?>Setting"> सेटिंग </a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>Setting/AddNew">सम्पतिकर तथा भूमिकर</a></li>
                  <li class="breadcrumb-item"><a href="javascript;"></a></li>
              </ol>
            </nav>

            <!-- page start-->
            <div class="row">
              <div class="col-sm-12">
               <!--  <form action ="<?php echo base_url()?>Setting/save_sampati_bhumi_kar" method ="post"> -->
                <?php
                  $attr = array(
                    'class' => 'form-horizontal',
                    'id'    => 'add_new_kar_rate'
                  );
                  $actionurl = 'Setting/SaveSampatiBhumiKar';
                  echo form_open_multipart($actionurl, $attr);
                ?>
                  <section class="card">
                    <header class="card-header">सम्पतिकर तथा भूमिकर</header>
                    <div class="card-body">
                      
                      <div class="form-section">
                        <input type = "hidden" name="fiscal_year" value="<?php echo $this->session->userdata('add_fiscal_year')?>">
                        <table class=" display table table-bordered table-striped" id="add_new_fields">
                          <thead style="background: #1b5693; color:#fff">
                            <tr>
                              <th>देखि <span style="color:red">*</span></th>
                              <th>सम्म <span style="color:red">*</span></th>
                              <th>सम्पतिकर <span style="color:red">*</span></th>
                              <th>भूमिकर <span style="color:red">*</span></th>
                              <th><button class="btn btn-info mb-2 btnNewAdd pull-right" title="सम्पादन गर्नुहोस्" id="add_more"><i class="fa fa-plus"></i></button></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="sampati_kar_add" id="sampati_kar_add_1" data-id="1">
                              <td><input type="text" name="from[]" class="form-control" required></td>
                              <td><input type="text" name="to[]" class="form-control" required></td>
                              <td><input type="text" name="sampati_kar[]" class="form-control" required></td>
                              <td><input type="text" name="bhunmi_kar[]" class="form-control" required></td>
                              <td>
                               
                                 <button class="btn btn-primary btn-xs btnNewAdd" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" id="add_more"><i class="fa fa-plus"></i></button>
                                  <button class="btn btn-danger btn-xs remove_row_first" data-toggle="tooltip" title="मेटाउनुहोस्"><i class="fa fa-trash-o"></i></button>
                              </td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="5">
                                <div class="pull-right">
                                  <button type="submit" class="btn btn-success"> सेभ गर्नुहोस</button>
                                  <button type="submit" class="btn btn-danger">रद्द गर्नुहोस्</button>
                                </div>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </section>
                </form>
              </div>
            </div>
            <!-- page end-->
          </section>
      </section>
</div>

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/assets/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript">
  $('#dynamic-table').dataTable( {
    "aaSorting": [[ 4, "desc" ]]
  });
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
  });
  $('.btnNewAdd').click(function(e){
      var trOneNew = $('.productPurchaseFields').length+1;
      var va = $('#engine_no_1').val();
      e.preventDefault();
      var new_row='<tr class="productPurchaseFields" id="productPurchaseFields_'+trOneNew+'" data-id="'+trOneNew+'">'+
              '<td><input type="text" name="from[]" class="form-control" required></td>'+
              '<td><input type="text" name="to[]" class="form-control" required></td>'+
              '<td><input type="text" name="sampati_kar[]" class="form-control" required></td>'+
              '<td width="200"><input type="text" name="bhunmi_kar[]" class="form-control" required></td>'+
              '<td>'+
              '<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="सम्पादन गर्नुहोस्"><i class="fa fa-save"></i></button>'+
              '<button class="btn btn-danger btn-xs remove-row" data-toggle="tooltip" title="मेटाउनुहोस्"><i class="fa fa-trash-o"></i></button>'+
              '</td>'+
            '</tr>';
      $("#add_new_fields").append(new_row);
  });
  $("body").on("click",".remove-row", function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
    $(".ajax-error-message").empty();
    $('.btnNewAdd').removeAttr('disabled','disabled');
    $('#btnsubmit').removeAttr('disabled','disabled');
  });
</script>
   