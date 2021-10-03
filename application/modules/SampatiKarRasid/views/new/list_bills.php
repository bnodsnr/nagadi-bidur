 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="javascript:;">सम्पतीकर - भूमिकर नगदी रसिद</a></li>
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
          <header class="card-header" style="background:#f1f2f7">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-2">
                   <select class="form-control" name="fiscal_year" id="fiscal_year">
                     <option value="">आर्थिक वर्ष चयन गर्नुहोस </option>
                     <?php if(!empty($fiscal_year)) : 
                      foreach($fiscal_year as $fy) : ?>
                        <option value="<?php echo $fy['year']?>"><?php echo $fy['year']?></option>
                      <?php endforeach;endif?>
                   </select>
                </div>

                <div class="col-md-2">
                   <input type="text" class="form-control" id="file_no" placeholder="क्र.स नम्बर:">
                </div>

                <div class="col-md-2">
                   <input type="text" class="form-control" id="bill_no" placeholder="रसिद नम्बर">
                </div>

                <div class="col-md-2">
                    <div class="input-group">
                      <input type="text" name="from_date" class="form-control " value="" placeholder="देखी मिति" autocomplete="off" id="fromdate" >
                      <div class="input-group-prepend">
                        <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar" style="color:#1b5693;background: radial-gradient(#ffffff, transparent);"></i></button>
                      </div>
                    </div>
                </div>

                <div class="col-md-2">
                   <div class="input-group">
                    <input type="text" name="to_date" class="form-control nepali-calendar" value="" placeholder="सम्म मिति" autocomplete="off" id="todate">
                    <div class="input-group-prepend">
                      <button type="button" class="input-group-text btn btn-danger" title=""><i class="fa fa-calendar" style="color:#1b5693;background: radial-gradient(#ffffff, transparent);"></i></button>
                    </div>
                  </div>
                </div>

                <div class="col-md-2">
                  <button class="btn btn-warning btn-xs " data-toggle="tooltip" title=" खोजी गर्नुहोस्" name="filter" type="button" id="filter"><i class="fa fa-search"></i> खोजी गर्नुहोस्</button>
                </div>

                <!-- <div class="col-md-5">
                  <input type="text" class="form-control" id="land_owner" placeholder="जग्गा धनीको नाम ">
                </div> -->
              </div>
            </form>
          </header>
          <div class="card-body">
            <!-- <div class="adv-table "> -->
              <a href="<?php echo base_url()?>SampatiKarRasid/viewCancelBills" class="btn btn-danger" style=""><i class="fa fa-times"></i> रद्ध गरिएको रसिदको हेर्नुहोस</a> 
              <table class=" table table-bordered table-striped" id="listtable">
                <thead>
                  <tr>
                    <th text-aligh="right">#</th>
                    <th>मिति</th>
                    <th> क्र.स नम्बर</th>
                    <th>जग्गाधनिको नाम</th>
                    <th>रसिद नम्बर</th>
                    <th>सम्पतीकर</th>
                    <th>भूमिकर</th>
                    <th>अवस्था</th>
                    <th>रशिद काट्ने नाम</th>
                    <th class="hidden-phone">विवरण</th>
                    <?php if($this->session->userdata('PRJ_USER_ID') == 1) { ?>
                      <th></th>
                    <?php } ?>
                  </tr>
                </thead>
              </table>
           <!--  </div> -->
          </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
 </section>
<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#fromdate').nepaliDatePicker();
    $('#todate').nepaliDatePicker();
    fetch_all_data();
    function fetch_all_data(file_no, bill_no, from_date, to_date, status, fiscal_year){
      var oTable = $('#listtable').DataTable({
        "order": [[ 0, "desc" ]],
        "searching": false,
        'lengthChange':false,
        "processing": true,
        "serverSide": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        },
        "ajax":{
          "url": "<?php echo base_url('SampatiKarRasid/GetBills') ?>",
          "dataType": "json",
          "type": "POST",
          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', file_no:file_no, bill_no:bill_no, from_date, to_date, status, fiscal_year}
          },
        "columns": [
              { "data": "sn" },
              { "data": "billing_date" },
              { "data": "nb_file_no" },
              { "data": "land_owner_name_np" },
              { "data": "bill_no" },
              { "data": "sampati_kar" },
              { "data": "bhumi_kar" },
              // { "data": "status" },

              {
                "data": "", render: function ( data, type, row ) {
                    if(row.status =='सदर')
                    var res = '<a class="btn btn-success">'+row.status+'</a>';
                    else {
                      var res = '<a class="btn btn-danger btn-sm"  data-toggle="modal" href="#previewModel" data-url="<?php echo base_url()?>SampatiKarRasid/viewReason" data-id = "'+row.bill_no_en+'"">'+row.status+'</a>';
                    }
                        
                      return res;
                }, "bVisible": true, "bSearchable": false, "bSortable": false
              },


              { "data": "user_name" },


              {
                "data": "", render: function ( data, type, row ) {
                  <?php if($this->authlibrary->HasModulePermission('SAMPATI-RASID', 'VIEW')) { ?>

                    if(row.status == 'सदर') {
                       var res = '<a class="btn btn-warning btn-sm" href = "<?php echo base_url()?>SampatiKarRasid/billPreview/'+row.bill_no_en+'/'+row.nb_file_no_en+'/'+row.nb_fiscal_year+  '" target="_blank">विवरण हेर्नुहोस</a>';
                      return res;
                    } else {
                      var res = '<a class="btn btn-warning btn-sm" href = "<?php echo base_url()?>SampatiKarRasid/previewCancelBill/'+row.bill_no_en+'" target="_blank">विवरण हेर्नुहोस</a>';
                      return res;
                    }
                   
                  <?php } ?>
                }, "bVisible": true, "bSearchable": false, "bSortable": false
              },

               <?php if($this->session->userdata('PRJ_USER_ID') ==1 ) { ?>
              
               {
                "data": "", render: function ( data, type, row ) {
                 
                      <?php if($this->authlibrary->HasModulePermission('SAMPATI-RASID', 'VIEW')) { ?>

                      if(row.status != 'बदर') {
                        var res = '<a class="btn btn-danger"  data-toggle="modal" href="#editModel" data-url="<?php echo base_url()?>SampatiKarRasid/CancelBill" data-id = "'+row.id+'"">रद्द गर्नुहोस्</a>';
                      } else {
                        var res = '<p class="badge badge-warning" >कार्य उपलब्ध छैन</p>';
                      }
                    
                      return res;
                  <?php } ?>
                }, "bVisible": true, "bSearchable": false, "bSortable": false
              },
              <?php } ?>


           ] 
      });
    }

    
    $('#filter').click(function(){
      var file_no     = $('#file_no').val();
      var bill_no     = $('#bill_no').val();
      var from_date   = $('#fromdate').val();
      var to_date     = $('#todate').val();
      var status      = $('#status').val();
      var fiscal_year = $('#fiscal_year').val();
      $('#listtable').DataTable().destroy();
      fetch_all_data(file_no, bill_no,from_date, to_date,status, fiscal_year);
    });
    
    $(document).on('click','.btn-delete', function(e){
      //e.preventDefault();
      var id = $(this).data('id'); //Fetch id from modal trigger button
      var url = $(this).data('url');
      //alert(url);
      if (confirm("Are you sure want to delete?") == true) {
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
  });
</script>
