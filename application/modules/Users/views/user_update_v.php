
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
          <?php if(($this->session->flashdata('message'))!=NULL) {?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <?php echo $this->session->flashdata('message'); ?>
            </div>

          <?php } ?>
            

            <?php echo form_open_multipart('Users/do_update',array('class'=>'well form-horizontal')); ?>

               <input type="hidden" name="user_id" value="<?php  if(isset($results))  echo ($results->user_id)?>">
                <div class="form-group">
                  <label class="col-md-4 control-label">First Name</label>  
                  <div class="col-md-4 inputGroupContainer">
                  
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                      <input  name="name" placeholder="Name" class="form-control"  type="text" value="<?php  if(isset($results)) echo $results->name?>">
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
                  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" value="<?php if(isset($results))echo $results->email?>">
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
                  <input name="phone" placeholder="+977 98xxxxxxxxxx" class="form-control" type="text" value="<?php if(isset($results)) echo $results->phone?>">
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
                  <input name="user_name" placeholder="User Name" class="form-control" type="text" value="<?php if(isset($results))echo $results->user_name?>">
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
                          <option value="general" <?php if(isset($results)) echo ($results->user_role == 'general')?'selected':'' ?>>General</option>
                          <option value="manager" <?php if(isset($results)) echo ($results->user_role == 'manager')?'selected':'' ?>>Manager</option>
                          <option value="super_admin"<?php if(isset($results)) echo ($results->user_role == 'super_admin')?'selected':'' ?>>Super Admin</option>
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



                <!-- Select Basic -->
                   
                <!-- <div class="form-group"> 
                  <label class="col-md-4 control-label">Courses</label>
                    <div class="col-md-4 selectContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                    <select name="course" class="form-control selectpicker" >
                      <option value=" " >Please select your course</option>
                      <option>Arts</option>
                      <option>Business & Commerce</option>
                      <option >Teaching and Education</option>
                      <option >Exercise Science</option>
                      <option >Health</option>
                      <option >Law</option>
                      <option >Engineering</option>
                      <option >Nursing and Midwifery</option>
                      <option >Social Work</option>
                    </select>
                  </div>
                </div>
                </div> -->



                <!-- Text area -->
                  
                <!-- <div class="form-group">
                  <label class="col-md-4 control-label">Interests/Hobbies</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <textarea class="form-control" name="interest" placeholder="interest"></textarea>
                  </div>
                  </div>
                </div> -->

                <!-- image upload -->
                <!-- <div class="form-group">
                  <label class="col-md-4 control-label">Image</label>
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                          <input class="form-control" type="file" name="user_file" id="user_file">
                  </div>
                  </div>
                </div> -->

                <!-- gender input -->
                <!-- <div class="form-group">
                  <label class="col-md-4 control-label">Gender</label>  
                    <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="radio" name="gender" value="male" checked> Male<br>
                        <input type="radio" name="gender" value="female"> Female<br>
                        <input type="radio" name="gender" value="other"> Other
                    </div>
                  </div>
                </div> -->


                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label"></label>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" >Update <span class="glyphicon glyphicon-send"></span></button>
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