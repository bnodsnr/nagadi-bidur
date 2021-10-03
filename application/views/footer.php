  <!-- js placed at the end of the document so the pages load faster -->
  <div class="modal fade" id="editModel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="modalContent">
        <div class="modal-header" style="background: #1b5693">
          <h4 class="modal-title"><?php echo !empty(EDIT_PAGE_TITLE) ? EDIT_PAGE_TITLE: '';?></h4>
        </div>
        <div class="modal-body">
            <div class="modal-view" id="modal_view"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="modalContent">
        <div class="modal-header" style="background: #1b5693">
          <h4 class="modal-title"><?php echo !empty(EDIT_PAGE_TITLE) ? EDIT_PAGE_TITLE: '';?></h4>
        </div>
        <div class="modal-body">
            <div class="modal-view" id="modal_view"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <div class="modal fade" id="previewModel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="modalContent">
        <div class="modal-header" style="background: #1b5693">
          <h4 class="modal-title"><?php echo !empty($pageTitle) ? $pageTitle:'रद्ध गर्नुको कारण'?></h4>
        </div>
        <div class="modal-body">
            <div class="modal-view" id="modal_view"></div>
        </div>
      </div>
    </div>
  </div>

<footer class="site-footer">
  <div class="text-center">
    2018 © <?php echo GNAME?>
  <!--   <a href="#" class="go-top">
      <i class="fa fa-angle-up"></i>
    </a> -->
  </div>
</footer>
 </section>
    <script src="<?php echo base_url()?>assets/js/bootstrap.bundle.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/gritter/js/jquery.gritter.js"></script>
    <script src="<?php echo base_url()?>assets/js/respond.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.pulsate.min.js"></script>

    <!--right slidebar-->
    <script src="<?php echo base_url()?>assets/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="<?php echo base_url()?>assets/js/common-scripts.js"></script>

    <!--script for this page only-->
    <script src="<?php echo base_url()?>assets/js/gritter.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/pulstate.js" type="text/javascript"></script>

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/customjs.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/assets/select2/js/select2.min.js"></script>

    <script src="<?php echo base_url()?>assets/toastr-master/toastr.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/nepali_datepicker/nepali.datepicker.v2.2.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".js-example-basic-single").select2();

        $(document).on('click','.delete_data', function(e){
            var id = $(this).data('id'); //Fetch id from modal trigger button
            var url = $(this).data('url');
            if (confirm("Are you sure want to delete?") == true) {
              $.ajax({
                type : 'POST',
                url : url, //Here you will fetch records 
                data: {id:id,'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'}, //Pass $id
                success : function(resp){
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
  </body>
</html>
