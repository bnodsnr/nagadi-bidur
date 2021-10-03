
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $breadcrumb;?>
        </div>
        <?php if(($this->session->flashdata('message'))!=NULL) {?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php } ?>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle;?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div>

           <div class="wrapper">
              <div class="row">
                <div class="col-md-8">

                  <!-- Profile Image -->
                  <div class="box box-primary">
                    <div class="box-body box-profile">
                      <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                      <h3 class="profile-username text-center"><?php echo $results->user_name; ?>'s Profile</h3>

                     

                      <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                          <b>Name:</b><p><?php echo $results->name; ?></p>
                        </li>
                        <li class="list-group-item">
                          <b>E-Mail:</b><p><?php echo $results->email; ?></p>
                        </li>
                        <li class="list-group-item">
                          <b>Role:</b><p><?php echo $results->user_role; ?></p>
                        </li>
                      </ul>
                    </div>
                  </div>
                  </div>
                </div>
        </div>
    </div>
</div>
</div>

      