<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> गृहपृष्ठ</a></li>
        <li class="breadcrumb-item"><a href="#">पासवर्ड परिवर्तन गर्नुहोस्</a></li>
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
          <header class="card-header" style="background: #1b5693;color:#FFF">
           पासवर्ड परिवर्तन गर्नुहोस्
          </header>
          <div class="card-body">
            <form action="<?php echo base_url()?>Changepassword/Update" method="post" class="form">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-12 err"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>नयाँ पासवर्ड प्रविष्ट गर्नुहोस् <span style="color:red">*</span></label>
                     <input type="password" id="newpassword" class="form-control" placeholder="New Password" name="newpassword">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>पासवर्ड सुनिश्चित गर्नुहोस <span style="color:red">*</span></label>
                    <input class="form-control form-control-inline " type="password" name="confirmPassword" id="confirmPassword">
                  </div>
                </div>
               
              </div>
              <hr>
              <div class="col-md-12 text-center">
                <button class="btn btn-primary btn-xs save_btn" data-toggle="tooltip" title="सम्पादन गर्नुहोस्" name="Submit" type="submit" value="Submit">सम्पादन गर्नुहोस्</button>
                <a href="<?php echo base_url()?>" class="btn btn-danger btn-xs" data-toggle="tooltip" title="रद्द गर्नुहोस्" data-dismiss="modal">रद्द गर्नुहोस्</a>
              </div>
            </form>
          </div>
        </section>
      </div>
      <!-- page end-->
    </section>
  </section>

  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.save_btn', function(){
        var password = $('#newpassword').val();
        var conpassword = $('#confirmPassword').val();
        if(password != conpassword ) {
          $('.err').html('<div class="alert alert-danger">पासवर्ड मिलेन</div>')
          return false;
        }
      });
    })
  </script>

  