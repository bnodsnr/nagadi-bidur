 <style type="text/css">
   table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
td.details-control {
    background: url('../resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../resources/details_close.png') no-repeat center center;
}
 </style>
 <!--main content start-->
 <section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a>
        </li>
        <li class="breadcrumb-item"><a href="javascript:;">उद्योगहरु अभिलेख</a></li>
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
            <header class="card-header">
              <div class="mail-option">
                <div class="btn-group hidden-phone">
                  <input type="text" class="form-control" id="kitta_no" placeholder="कि.नं" style="width: 270px;">
                </div>
                <div class="btn-group hidden-phone">
                  <div class="">
                    <button type="button" class="btn btn-warning" title="खोजी गर्नुहोस्" id="filter">खोजी गर्नुहोस्</button>
                  </div>
                </div>
                <?php if($this->authlibrary->HasModulePermission('BUSINESS-PROFILE', "ADD")) { ?>
                  <div class="float-right position">
                    <a class="btn btn-primary " href="<?php echo base_url()?>BusinessProfile/AddLandDetails/<?php echo $this->uri->segment(3)?>" style="color:#FFF;margin-top: 2px;"><i class="fa fa-plus"></i> नयाँ थप्नुहोस् </a>
                  </div>
                <?php } ?>
              </div>
              </span>
            </header>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
                <table class="display table table-bordered table-striped" id="listtable">
                  <thead style="background:#1b5693;color:#fff">
                      <tr>
                          <th>#</th>
                          <th>#</th>
                          <th>साबिक</th>
                          <th>हाल</th>
                          <th>सडकको नाम</th>
                          <th>जग्गाको क्षेत्रगत किसिम</th>
                          <th>जग्गाको क्षेत्रगत किसिम</th>
                          <th>न.न</th>
                          <th>कि.नं</th>
                          <th>क्षेत्रफल</th>
                          <th>तोकिएको न्युनतम मुल्य(प्रति कठ्ठा )</th>
                          <th>कबुल गरेको मुल्य(प्रति कठ्ठा )</th>
                        
                         <!--  <th></th> -->
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
<script type="text/javascript">
  $(document).ready(function(){
   
    fetch_all_data();
    function fetch_all_data(kitta_no =''){
      var file_no = '<?php echo $this->uri->segment(3); ?>';
      var oTable = $('#listtable').DataTable({
        "order": [[ 0, "desc" ]],
        "searching": false,
        'lengthChange':false,
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        // "scrollY": 200,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>'
        },
        "ajax":{
          "url": "<?php echo base_url()?>"+'BusinessProfile/GetLandLists',
          "dataType": "json",
          "type": "POST",
          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', file_no:file_no, kitta_no:kitta_no}
          },
        "columns": [
              { "data": "sn" },
                {
                "data": "", render: function ( data, type, row ) {
                    var res ='<div class="btn-group">'+
                                '<button type="button" class="btn btn-warning btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                'सम्पादन गर्नुहोस् </button>'+
                                '<div class="dropdown-menu">';
                        
                                <?php if($this->authlibrary->HasModulePermission('BUSINESS-PROFILE','EDIT')) { ?>
                                  res +=  '<a class="dropdown-item" href="<?php echo base_url()?>BusinessProfile/AddSanrachana/'+row.file_no_en+'"><i class="fa  fa-plus"></i> नयाँ संरचनाको थप्नुहोस्</a>'+
                                      '<a class="dropdown-item" href="<?php echo base_url()?>BusinessProfile/veiwSanrachanaDetails/'+row.id+'"><i class="fa  fa-pencil"></i> विवरण सम्पादन गर्नुहोस्</a>';
                                <?php } ?>
                                <?php if($this->authlibrary->HasModulePermission('BUSINESS-PROFILE', 'DELETE')){ ?>
                                  res += '<a class="dropdown-item" href="<?php echo base_url()?>BusinessProfile/veiwSanrachanaDetails/'+row.id+'"><i class="fa fa-trash-o"></i> जग्गा हटाउनुहोस्</a>';
                                <?php } ?>
                          res += '</div"></div>';
                 
                  return res;
                },"bVisible": true, "bSearchable": false, "bSortable": false
              },
              { "data": "sabik" },
              { "data": "present" },
              { "data": "road_name" },
              { "data": "land_area_type" },
              { "data": "land_category" },
              { "data": "nn_number" },
              { "data": "k_number" },
              { "data": "total_area" },
              { "data": "min_land_rate" },
              { "data": "k_land_rate" },
           ] 
      });
    }
    
    $('#filter').click(function(){
      var kitta_no       = $('#kitta_no').val();
      $('#listtable').DataTable().destroy();
      fetch_all_data(kitta_no);
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