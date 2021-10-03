<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">बैंक दाखिला फारम सुची</a></li>
        </ol>
      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">

        
            <section class="card">
                <header class="card-header">
                  <div class="mail-option">
                    <div class="btn-group hidden-phone">
                      <select class="form-control" style="width:200px;" id="fiscal_year">
                        <option value="">आर्थिक वर्ष </option>
                        <?php if(!empty($fiscal_year)) : 
                          foreach ($fiscal_year as $key => $fy) :?>
                            <option value="<?php echo $fy['year']?>" style="color:<?php if($fy['is_closed'] == 'closed'){ echo 'red'; }?>"> <?php 
                              echo $this->mylibrary->convertedcit($fy['year']);
                           ?></option>
                          <?php endforeach;endif;?>
                      </select>
                    </div>
                  
                    <?php if($this->session->userdata('PRJ_USER_WARD') == '0') : ?>
                    <div class="btn-group hidden-phone">
                      <select class="form-control" style="width:200px;" id="ward_no">
                        <option value="">वडा छानुहोस</option>
                        <?php if(!empty($wards)) : 
                          foreach ($wards as $key => $ward) : ?>
                            <option value="<?php if($ward['ward'] == '0'){ echo 'palika'; } else { echo $ward['ward'];} ?>"><?php 
                            if($ward['ward'] == '0') {
                              echo 'पालिका';
                            } else {
                              echo $this->mylibrary->convertedcit($ward['ward']);
                            }
                           ?></option>
                          <?php endforeach;endif;?>
                      </select>
                    </div>
                  <?php endif;?>

                    <div class="btn-group hidden-phone">
                      <select class="form-control" style="width:200px;" id="bank_name">
                        <option value="">बैंकको नाम छानुहोस</option>
                        <?php if(!empty($banks)) : 
                          foreach($banks as $key => $bank ) : ?>
                            <option value="<?php echo $bank['name']?>"><?php echo $bank['name']?></option>
                        <?php endforeach;endif;?>
                      </select>
                    </div>

                    <div class="btn-group hidden-phone">
                      <input type="text" name="" id="voucher_no" class="form-control" style="width:300px;" placeholder="भौचर नं">
                    </div>

                    <div class="btn-group hidden-phone">
                      <div class="">
                        <button type="button" class="btn btn-warning filter" title="खोजी गर्नुहोस्" id="filter"><i class="fa fa-search"></i> खोजी गर्नुहोस्</button>
                      </div>
                    </div>
                    <?php if($this->session->userdata('PRJ_USER_ID')!= 1) { ?>

                    
                    <div class="float-right position">
                      <a class="btn btn-primary" href="<?php echo base_url()?>BankDeposit/Add" style="color:#FFF;margin-top: 2px;"><i class="fa  fa-plus-circle"></i> नयाँ थप्नुहोस् </a>
                   </div>
                  <?php } ?>
                 </div>
                </header>
                <div class="card-body">
                    <div class="total_desc">
                        <div class="alert alert-info"><h2>जम्मा संकलन गरिएको रकम:- <?php echo $this->mylibrary->convertedcit(round($total_amount))?> | जम्मा  गरिएको रकम:- <?php echo $this->mylibrary->convertedcit(round($total_deposit_amt->deposit_amt))?> | बाकीं रकम:- <?php 
                      $due_amount = $total_amount -$total_deposit_amt->deposit_amt; echo $this->mylibrary->convertedcit(round($due_amount))?>
                    </div>
                  
                   </h2></div>
                <table class="table table-bordered table-striped" id="listtable">
                  <thead style="background:#1b5693;color:#fff">
                      <tr>
                          <th>#</th>
                          <th>दाखिला मिति</th>
                          <th>बैंकको नाम</th>
                          <th>खाता नं</th>
                          <th>भौचर नं.</th>
                          <th>बैंकको हेर्नुहोस्</th>
                          <th>जम्मा गरेको रकम</th>
                          <!-- <th>बाकीं रकम</th> -->
                         <!--  <th>जम्मा गर्ने वडा </th> -->
                          <th>जम्मा गर्नेको नाम </th>
                          <th></th>
                      </tr>
                  </thead>
                </table>
                </div>
            </section>
          </div>
        </div>
        <!-- page end-->

    </section>

</section>



<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>

<script type="text/javascript">

  $(document).ready(function(){

    fetch_all_data();

    function fetch_all_data(ward_no, bank_name, voucher_no, fiscal_year){

      var oTable = $('#listtable').DataTable({

        "order": [[ 4, "desc" ],[0,'asc']],

        "searching": false,

        'lengthChange':false,

        "processing": true,

        "serverSide": true,

        'language': {

            'loadingRecords': '&nbsp;',

            'processing': '<div class="spinner"></div>'

        },

        "ajax":{

          "url": "<?php echo base_url('BankDeposit/GetList') ?>",

          "dataType": "json",

          "type": "POST",

          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', ward_no:ward_no,bank_name:bank_name, voucher_no:voucher_no,fiscal_year:fiscal_year}

          },

        "columns": [
              { "data": "sn" },
              { "data": "deposit_date" },
              { "data": "bank_name" },
              { "data": "acc_no" },
              { "data": "voucher_no" },

             
              {
                "data": "", render: function ( data, type, row ) {
            
                  var res = '';
                      res +="<a href='<?php echo base_url()?>assets/vouchers/"+row.voucher_image+"' target='_blank'>"+row.voucher_image+"</a>";

                  return res;
                },"bVisible": true, "bSearchable": false, "bSortable": false
              },

              { "data": "deposit_amt" },
              // { "data": "due_amount" },
              // { "data": "added_ward" },
              { "data": "username" },
              {
                "data": "", render: function ( data, type, row ) {
                  //  <?php //if($this->authlibrary->HasModulePermission('BANK-DEPOSIT', "EDIT")) { ?>
                  //   var res ="<a href='<?php //echo base_url()?>BankDeposit/edit/"+row.id+"' class='btn btn-primary'><i class='fa fa-pencil'></i></a>";
                  // <?php //} ?>
                  
                  var res = '';
                  <?php if($this->authlibrary->HasModulePermission('BANK-DEPOSIT', "DELETE")) { ?>

                      res +="<a href='<?php echo base_url()?>BankDeposit/delete/"+row.id+"' class='btn btn-danger btn-delete' style='margin-left:5px;' ><i class='fa fa-trash-o'></i></a>";

                  <?php } ?>
                  return res;
                },"bVisible": true, "bSearchable": false, "bSortable": false
              },

           ] //end of columns

      });

    }

    

    $('#filter').click(function(){
      var ward_no           = $('#ward_no').val();
      var bank_name         = $('#bank_name').val();
      var voucher_no        = $('#voucher_no').val();
      var fiscal_year       = $('#fiscal_year').val();
      $('#listtable').DataTable().destroy();
      fetch_all_data(ward_no, bank_name,voucher_no,fiscal_year);
    });

    $('.filter').click(function(){
      var ward_no           = $('#ward_no').val();
      var bank_name         = $('#bank_name').val();
      var voucher_no        = $('#voucher_no').val();
      var fiscal_year       = $('#fiscal_year').val();
      //alert(fiscal_year);
      $.ajax({
          method: "POST",
          url: base_url + "BankDeposit/getTotal",
          data: {
              ward_no: ward_no,
              bank_name: bank_name,
              voucher_no: voucher_no,
              fiscal_year: fiscal_year,
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
          },
          success: function(resp) {
              if (resp.status == 'success') {
               $('.total_desc').html(resp.message);
              }
          }
        });
    });

    $(document).on('click','.btn-delete', function(e){
      if (confirm("Are you sure want to delete?") == true) {
        return true;
      } else {
        return false;
      }
    });

  });

</script>