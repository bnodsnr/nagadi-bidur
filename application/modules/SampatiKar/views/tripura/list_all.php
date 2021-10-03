<style type="text/css">
  @keyframes spinner {
  to {transform: rotate(360deg);}
}
 
.spinner:before {
  content: '';
  box-sizing: border-box;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
  border-radius: 50%;
  border: 2px solid #ccc;
  border-top-color: #333;
  animation: spinner .6s linear infinite;
}
</style>
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;"> सम्पत्ति कर</a></li>
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
              <div class="card-header">
                <div class="mail-option">
                  

                    <?php if($this->authlibrary->HasModulePermission('SAMPATI-KAR', "ADD")) { ?>
                      <div class="float-right position">
                        <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url()?>SampatiKar/Add" style="color:#FFF"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                      </div>
                    <?php } ?>
                </div>
              </div>
              <div class="card-body">
                <table  class="table table-inbox table-bordered table-striped" id="listtable">
                  <thead style="background: #1b5693; color:#fff">
                      <tr>
                        <th text-aligh="right">#</th> 
                        <th>आ व</th>
                        <th style="width: 200px;"> किसिम</th>
                        <th style="width: 200px;">तला</th>
                         <th> रु</th>
                        <!--<th> सम्म </th> -->
                         <?php if($this->authlibrary->HasModulePermission('SAMPATI-KAR', "EDIT") || $this->authlibrary->HasModulePermission('BHUMI-KAR', "DELETE") ) { ?>
                          <th class="hidden-phone">.....</th>
                        <?php } ?>
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
    function fetch_all_data(fiscal_year = '', from_rate = '',to_rate='', type=''){
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
          "url": "<?php echo base_url('SampatiKar/get_list') ?>",
          "dataType": "json",
          "type": "POST",
          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', fiscal_year, from_rate, to_rate, type}
          },
        "columns": [
              { "data": "sn" },
              { "data": "fiscal_year" },
              { "data": "type" },
              { "data": "unit" },
              //{ "data": "to_rate" },
              { "data": "amount" },
              {
                "data": "", render: function ( data, type, row ) {
                console.log(row);
                   <?php if($this->authlibrary->HasModulePermission('SAMPATI-KAR', "EDIT")) { ?>
                    var res ="<a href='<?php echo base_url()?>SampatiKar/Add/"+row.id+"' class='btn-primary btn-sm' ><i class='fa fa-edit'></i></a>";
                  <?php } ?>

                  <?php if($this->authlibrary->HasModulePermission('SAMPATI-KAR', "DELETE")) { ?>
                      res +="<button data-url ='<?php echo base_url()?>SampatiKar/delete' class='btn-danger btn-sm btn-delete' data-id = "+row.id+"><i class='fa fa-trash-o'></i></button>";
                  <?php } ?>
                      return res;


                },"bVisible": true, "bSearchable": false, "bSortable": false
              },
           ] 
      });
    }
    
    $('#filter').click(function(){
      var fiscal_year     = $('#fiscal_year').val();
      var from_rate  = $('#from_rate').val();
      var to_rate       = $('#to_rate').val();
      var type = $('#type').val();
      $('#listtable').DataTable().destroy();
      fetch_all_data(fiscal_year, from_rate, to_rate, type);
    });
    
    $(document).on('click','.btn-delete', function(e){
      //e.preventDefault();
      var id = $(this).data('id'); //Fetch id from modal trigger button
     
      var url = $(this).data('url');
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