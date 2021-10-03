
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $breadcrumb;?>
        </div>
        
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php echo $pagetitle;?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <body>
                
                    
                <div class="container">

            
            <?php if(($this->session->flashdata('message'))!=NULL){ ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('message'); ?>
              </div>
            <?php } ?>

            <?php echo form_open_multipart('Users/register',array('class'=>'well form-horizontal')); ?>

               
                <div class="form-group">
                  <label class="col-md-4 control-label">First Name</label>  
                  <div class="col-md-4 inputGroupContainer">
                  
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input  name="name" placeholder="Name" class="form-control"  type="text" value="<?php echo set_value('name')?>">
                    </div>
                    <div style="color: red;">
                      <?php echo form_error('name') ?>
                    </div>
                  </div>
                </div>

                <!-- Text input-->

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">E-Mail</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" value="<?php echo set_value('email')?>">
                    </div>
                    <div style="color: red;">
                      <?php echo form_error('email') ?>
                    </div>
                  </div>
                </div>




                <!-- Text input-->
                       
                <div class="form-group">
                  <label class="col-md-4 control-label">Phone #</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                  <input name="phone" placeholder="+977 98xxxxxxxxxx" class="form-control" type="text" value="<?php echo set_value('phone')?>">
                    </div>
                    <div style="color: red;">
                      <?php echo form_error('phone') ?>
                    </div>
                  </div>
                </div>

                <!-- Text input-->
                      
                <div class="form-group">
                  <label class="col-md-4 control-label">User Name</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                  <input name="user_name" placeholder="User Name" class="form-control" type="text" value="<?php echo set_value('user_name')?>">
                    </div>
                    <div style="color: red;">
                      <?php echo form_error('user_name') ?>
                    </div>
                    </div>
                  </div>

               
             <div class="form-group">
                  <label class="col-md-4 control-label">User Role</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                         <select class="form-control select2" style="width: 100%;" name="user_role">
                          <option selected="selected" value="general">General</option>
                          <option value="manager">Manager</option>
                          <option value="super_admin">Super Admin</option>
                        </select>
                    </div>
                    
                  </div>
                </div>




                <!-- Text input-->
                 
                <div class="form-group">
                  <label class="col-md-4 control-label">Password</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                  <input name="password" placeholder="Password" class="form-control"  type="password" >
                    </div>
                    <div style="color: red;">
                      <?php echo form_error('password') ?>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label">Confirm Password</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                  <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password">
                    </div>
                    <div style="color: red;">
                      <?php echo form_error('confirm_password') ?>
                    </div>
                  </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                  <div class="col-md-4">
                    <button type="reset" class="btn btn-danger" >Reset <span class="glyphicon glyphicon-repeat"></span></button>&nbsp&nbsp&nbsp<button type="submit" class="btn btn-primary" >Register <span class="glyphicon glyphicon-send"></span></button>
                  </div>
                </div>

                </fieldset>
             <?php echo form_close(); ?>

                </div>
                    </div><!-- /.container -->
                </body>
        
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->