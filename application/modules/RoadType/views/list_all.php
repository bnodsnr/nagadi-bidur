
<!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
                  <li class="breadcrumb-item" ><a href="<?php echo base_url()?>RoadType/">सडकको किसिम</a></li>
              </ol>
            </nav>
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
                    <aside class="card">
                     <header class="card-header">
                      <div class="text-center"><h3>सडकको किसिमहरुको सुची</h3></div>

                    </header>
                        <div class="card-body">
                          <?php if($this->authlibrary->HasModulePermission('ROAD-TYPE', "ADD")) { ?>
                            <button type="button" data-toggle="modal" href="#addModel" class="btn btn-secondary mb-2" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>RoadType/add"><i class="fa fa-plus-circle"></i> सडकको किसिम थप्नुहोस्</button>
                          <?php } ?>
                            <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th text-aligh="right">#</th> 
                                  <th>आर्थिक वर्ष</th>
                                  <th>सडकको किसिम</th>
                                  <th></th>
                                </tr>
                              </thead>
                             <tbody>
                              <?php if(!empty($road_type)) : 
                                $i = 1; foreach ($road_type as $key => $road) : ?>
                                 <tr>
                                    <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                                    <td><?php echo $this->mylibrary->convertedcit($road['fiscal_year'])?></td>
                                    <td><?php echo $this->mylibrary->convertedcit($road['road_type'])?></td>
                                    <?php if($this->authlibrary->HasModulePermission('ROAD-TYPE','EDIT') && $this->authlibrary->HasModulePermission('ROAD-TYPE', 'DELETE')) { ?>
                                      <td class="center hidden-phone">
                                        <?php if($this->authlibrary->HasModulePermission('ROAD-TYPE', "EDIT")) { ?>
                                          <button type="button" data-toggle="modal" href="#editModel" class="btn btn-primary " title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>RoadType/edit" data-id = "<?php echo $road['id']?>"><i class="fa fa-edit"></i></button>
                                        <?php } ?>

                                        <?php if($this->authlibrary->HasModulePermission('ROAD-TYPE', "DELETE")) { ?>
                                         <button data-url = "<?php echo base_url()?>RoadType/delete" data-id = "<?php echo $road['id']?>" class="btn btn-danger delete_data"><i class="fa fa-trash-o"></i></button>
                                        <?php } ?>
                                      </td>
                                    <?php } ?>
                                 </tr>
                              <?php endforeach;
                              else : ?>
                              <td colspan="4"><div class="alert alert-danger">चालु आर्थिक वर्षको सडकको किसिम दाखिला गरिएको छैन.<br><br><button type="button" data-toggle="modal" href="#addModel" class="btn btn-secondary mb-2" title="जग्गाको क्षेत्रगत किसिम थप्नुहोस्" data-url="<?php echo base_url()?>RoadType/add"><i class="fa fa-plus-circle"></i> सडकको किसिम थप्नुहोस्</button></div></td>
                            <?php endif;?>
                             </tbody>
                            </table>
                        </div>
                    </aside>
                  
                </div>
              </div>
          </section>
      </section>

    
<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    fetch_all_data();
    function fetch_all_data(filter_1 = '', filter_2 = ''){
      var oTable = $('#listtable').DataTable({
       "order": [[ 1, "desc" ]],
        "searching": false,
        'lengthChange':false,
        "processing": true,
        "serverSide": true,
        "ajax":{
          "url": "<?php echo base_url('RoadType/posts') ?>",
          "dataType": "json",
          "type": "POST",
          "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', filter_1:filter_1,filter_2:filter_2}
          },
        "columns": [
              { "data": "sn" },
              { "data": "fiscal_year" },
              { "data": "road_type" },
              {
                "data": "", render: function ( data, type, row ) {
                   <?php if($this->authlibrary->HasModulePermission('ROAD-TYPE', "EDIT")) { ?>
                    var res ="<button type='button' data-toggle='modal' href='#editModel' class='btn-primary btn-sm' data-url='<?php echo base_url()?>RoadType/edit' data-id = "+row.id+"><i class='fa fa-edit'></i></button>";
                  <?php } ?>

                  <?php if($this->authlibrary->HasModulePermission('ROAD-TYPE', "DELETE")) { ?>
                      res +="<button data-url ='<?php echo base_url()?>RoadType/delete' class='btn-danger btn-sm btn-delete' data-id = "+row.id+"><i class='fa fa-trash-o'></i></button>";
                  <?php } ?>
                      return res;


                },"bVisible": true, "bSearchable": false, "bSortable": false
              },
           ] 
      });
    }
    
    $('#filter').click(function(){
        var filter_1 = $('#filter_1').val();
        var filter_2 = $('#filter_2').val();
        $('#listtable').DataTable().destroy();
        fetch_all_data(filter_1, filter_2);
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