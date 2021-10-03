<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">जग्गाको न्युनतम मुल्य</a></li>
        </ol>
      </nav>
        <!-- page start-->
        <div class="row">
          <div class="col-sm-12">
            <section class="card">
              <header class="card-header"><div class="text-center"><h3>जग्गाको न्युनतम मुल्हरुको सुची </h3></div></header>
              <div class="card-body">
                <?php if($this->authlibrary->HasModulePermission('LAND-RATE', "ADD")) { ?>
                  <div class="">
                    <a class="btn btn-secondary mb-2" href="<?php echo base_url()?>JaggakoRate/addJaagakoMinRate"><i class="fa fa-plus-circle"></i>  जग्गाको न्युनतम मुल्य थप्नुहोस् </a>
                    <div class="pull-right">
                      <input type="text" class="form-control" id="search">
                    </div>
                  </div>
                <?php } ?>
                <div class="adv-table">
                  <table class="table table-bordered table-striped table-condensed display" id="listtable">
                    <thead>
                        <tr>
                          <th text-aligh="right">#</th> 
                          <th>आ व.</th>
                          <th>वडा नं</th>
                          <th>सडकको नाम</th>
                          <!-- <th>जग्गाको क्षेत्रगत किसिम</th> -->
                          <th>न्युनतम मुल्य</th>
                          <th>अधिक्कतम मूल्य</th>
                          <?php if($this->authlibrary->HasModulePermission('LAND-RATE','EDIT') && $this->authlibrary->HasModulePermission('LAND-RATE', 'DELETE')) { ?>
                            <th class="hidden-phone">.....</th>
                          <?php } ?>
                                                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($jaagaKoRate)) :
                          $i = 1;
                          foreach($jaagaKoRate as $key => $value) : ?>
                          <tr class="">
                              <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                               <td><?php echo $this->mylibrary->convertedcit($value['fy'])?></td>
                               <td><?php echo $this->mylibrary->convertedcit($value['jw'])?></td>
                              <td><?php echo $value['road_name']?></td>
                              <!-- <td><?php //echo $value['land_area_type']?></td> -->
                              <td><?php echo $this->mylibrary->convertedcit($value['minimal_cost'])?></td>
                              <td><?php echo $this->mylibrary->convertedcit($value['maximum_cost'])?></td>

                               <?php if($this->authlibrary->HasModulePermission('LAND-RATE','EDIT') && $this->authlibrary->HasModulePermission('LAND-RATE', 'DELETE')) { ?>
                                  <td class="center hidden-phone">
                                    <?php if($this->authlibrary->HasModulePermission('LAND-RATE', "EDIT")) { ?>
                                      <a class="btn btn-primary" data-toggle="modal" href="<?php echo base_url()?>JaggakoRate/addJaagakoMinRate/<?php echo $value['rate_id']?>" data-id ="<?php echo $value['rate_id']?>"><i class="fa fa-edit"></i></a>
                                    <?php } ?>

                                    <?php if($this->authlibrary->HasModulePermission('LAND-RATE', "DELETE")) { ?>
                                      <button data-url ='<?php echo base_url()?>JaggakoRate/delete' class='btn btn-danger btn-delete' data-id = "<?php echo $value['rate_id']?>" style="margin-top: 10px;"><i class='fa fa-trash-o'></i></button>
                                    <?php } ?>
                              </td>
                            <?php } ?>
                          </tr>
                          <?php endforeach;
                        else : ?>
                          <td colspan="8"><div class="alert alert-danger">चालु आर्थिक वर्षको जग्गाको न्युनतम दाखिला गरिएको छैन.<br><br><a class="btn btn-secondary" href="<?php echo base_url()?>JaggakoRate/addJaagakoMinRate"><i class="fa fa-plus-circle"></i> अगिल्लो आर्थिक वर्षको कपी गर्नुहोस </a></div></td>
                        <?php  endif; ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>
        </div>
    </section>
</section>
      
<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // $('#dynamic-table').DataTable();
    $('#dynamic-table').DataTable({
       'order': false,
    });

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

    $("#search").on("keyup", function() {
    var value = $(this).val();

    $("table tr").each(function(index) {
        if (index !== 0) {

            $row = $(this);

            var id = $row.find("td:first").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});
  })
</script>
    
   