
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
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
          <header class="card-header"><h3 class="text-center"> सम्पतिकर तथा भूमिकर </h3></header>
          <div class="card-body">
            <div class="adv-table">
              <?php if($this->authlibrary->HasModulePermission('SAMPATI-BHUMI-KAR', "ADD")) { ?>
              <a class="btn btn-secondary mb-2" style="color:#FFF" data-toggle="modal" href="#addModel" data-url="<?php echo base_url()?>SampatiBhumiKar/addNew"><i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस् </a>
            <?php } ?>
              <table  class="display table table-bordered table-striped ">
                <thead>
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
                      <tr class="">
                        <td><?php echo $this->mylibrary->convertedcit($i++)?></td>
                        <td><?php echo $this->mylibrary->convertedcit($value['fiscal_year'])?></td>
                        <td><?php echo $this->convertlib->convert_number($value['from_rate'],"मात्र |")?></td>
                        <td><?php echo $this->convertlib->convert_number($value['to_rate'],"मात्र |")?></td>
                        <td><?php echo $this->mylibrary->convertedcit($value['sampati_kar'])?></td>
                        <td><?php echo $this->mylibrary->convertedcit($value['bhumi_kar'])?></td>
                        <td class="center hidden-phone">
                          <button class="btn btn-primary" data-toggle="modal" href="#editModel" data-id ="<?php echo $value['id']?>" data-url="<?php echo base_url()?>SampatiBhumiKar/editDetailsView"><i class="fa fa-edit"></i></button>
                          <button data-url ='<?php echo base_url()?>SampatiBhumiKar/delete' class='btn btn-danger btn-delete' data-id = "<?php echo $value['id']?>"><i class='fa fa-trash-o'></i></button>
                        </td>
                      </tr>
                    <?php endforeach;
                      else : ?>
                         <td colspan="7"><div class="alert alert-danger">चालु आर्थिक वर्षको सम्पतिकर तथा भूमिकरदाखिला गरिएको छैन.<br><br><a class="" data-toggle="modal" href="#addModel" data-url="<?php echo base_url()?>SampatiBhumiKar/addNew">नयाँ थप्नुहोस् </a></div></td>
                 <?php  endif; ?>
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
  

<script src="<?php echo base_url('assets/datatable/datatables.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // $('#dynamic-table').DataTable({
    //    'order': false,
    //    ''

    // });
    
    
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
        
  })
</script>
  
  