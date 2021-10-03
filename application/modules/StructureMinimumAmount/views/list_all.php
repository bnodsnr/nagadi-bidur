<!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">संरचनाको न्युनतम मूल्य</a></li>
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
          <header class="card-header"><div class="text-center"><h3>संरचनाको न्युनतम मूल्यहरुको सुची </h3></div></header>
          <div class="card-body">
            <div class="">
              <a class="btn btn-secondary mb-2" href="<?php echo base_url()?>StructureMinimumAmount/addSanrachanaRate"><i class="fa fa-plus-circle"></i>  जग्गाको न्युनतम मुल्य थप्नुहोस् </a>
              <div class="pull-right">
                <input type="text" class="form-control" id="search">
              </div>
            </div>
            <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="listtable">
                <thead>
                  <tr>
                    <th text-aligh="right">#</th> 
                    <th>आ व</th>
                    <th>संरचनाको बनौटको किसिम</th>
                    <th>संरचनाको प्रकार</th>
                    <th>न्युनतम मूल्य</th>
                    <?php if($this->authlibrary->HasModulePermission('STRUCUTRE-MIN-AMOUNT', "MODIFY") ||  $this->authlibrary->HasModulePermission('STRUCUTRE-MIN-AMOUNT', "DELETE")){ ?>
                      <th class="hidden-phone">.....</th>
                    <?php } ?>
                  </tr>
                </thead>
               
              </table>
            </div>
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
    function fetch_all_data(fiscal_year = '', structure_type = '',architect_type=''){
      var oTable = $('#listtable').DataTable({
        "order": [[ 1, "desc" ],[0,'asc']],
        "searching": false,
        'lengthChange':false,
        "processing": true,
        "serverSide": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        },
        "ajax":{
          "url": "<?php echo base_url('StructureMinimumAmount/posts') ?>",
          "dataType": "json",
          "type": "POST",
          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', fiscal_year:fiscal_year,structure_type:structure_type, architect_type:architect_type}
          },
        "columns": [
              { "data": "sn" },
              { "data": "fiscal_year" },
              { "data": "structure_type" },
              { "data": "architect_type" },
              { "data": "minimum_amount" },

              {
                "data": "", render: function ( data, type, row ) {
                   <?php if($this->authlibrary->HasModulePermission('STRUCUTRE-MIN-AMOUNT', "EDIT")) { ?>
                    var res ="<a href='<?php echo base_url()?>StructureMinimumAmount/addSanrachanaRate/"+row.id+"' class='btn btn-primary btn-sm' ><i class='fa fa-edit'></i></a>";
                  <?php } ?>

                  <?php if($this->authlibrary->HasModulePermission('STRUCUTRE-MIN-AMOUNT', "DELETE")) { ?>
                      res +="<button data-url ='<?php echo base_url()?>StructureMinimumAmount/delete' class='btn-danger btn-sm btn-delete' style='margin-left: 3px;' data-id = "+row.id+" ><i class='fa fa-trash-o'></i></button>";
                  <?php } ?>
                      return res;


                },"bVisible": true, "bSearchable": false, "bSortable": false
              },
           ] 
      });
    }
    
    $('#filter').click(function(){
      var fiscal_year     = $('#fiscal_year').val();
      var structure_type  = $('#structure_type').val();
      var architect_type       = $('#architect_type').val();
      $('#listtable').DataTable().destroy();
      fetch_all_data(fiscal_year, structure_type,architect_type);
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
