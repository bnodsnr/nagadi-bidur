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
        <div>
            <a href="<?php echo base_url(); ?>Users/registration"><button class="btn btn-success pull-right">Add User</button></a>
        </div>
        <br />
        <br />
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div>
            <?php if(($this->session->flashdata('message'))!= NULL){?>
                <div class="<?php echo $this->session->flashdata('alert'); ?>" role="alert">
                    <strong>Success!</strong><?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>
        </div>
        <div>

                
<body>

<!-- search box  form -->
<?php echo form_open('Users/search','class = "form-horizontal"'); ?>
    <div class="form-group">
      <div class="col-lg-10">
        <input type="text" name="keyword" id="inputEmail" placeholder="Search Users" value="<?php echo set_value('keyword')?>">
       
        <select  id="select" name="field">
          <option value="name">Name</option>
          <option value="email">Email</option>
          <option value="phone">Phone</option>
          <option value="user_name">User Name</option>
        </select>

        <input type="submit" name="submit" id="" value="Search" class="btn-btn-sm btn-info">
      </div>
    </div>

<?php echo form_close(); ?>
<!-- search box form -->


<?php if(!$records) {?>
<div class="alert">
    <h3>There are Currently no Registered Users</h3>
</div>
<?php } else{ ?>
                    <table class="table table-condensed">
                    <?php $count = 1; ?>
                        <tr>
                            <td><b>S.N</b></td>
                            <td><b>First Name</b></td>
                            <td><b>Last Name</b></td>
                            <td><b>E-mail</b></td>
                            <td><b>Phone</b></td>
                            <td><b>User Name</b></td>
                            <td><b>User Role</b></td>
                            <td><b>Options</b></td>
                        </tr>
                        <?php foreach($records as $record) { ?>
                        <tr>
                            <td><?php echo $count;  ?></td>
                            <td><?php echo $record->name; ?></td>
                            <td><?php echo $record->email; ?></td>
                            <td><?php echo $record->phone; ?></td>
                            <td><?php echo $record->user_name; ?></td>
                            <td><?php echo $record->user_role; ?></td>
                            <td><a href="<?php echo base_url()?>Users/view/<?php echo $record->user_id?>"><button class="btn btn-xs btn-primary">View</button></a>&nbsp&nbsp<a href="<?php echo base_url(); ?>Users/update/<?php echo $record->user_id; ?>"><button class="btn btn-xs btn-success">Edit</button></a>&nbsp&nbsp<a href="<?php echo base_url()?>Users/delete/<?php echo $record->user_id?>"><button class="btn btn-xs btn-danger">Delete</button></a></td>
                        </tr>
                        <?php $count++; } ?>
<?php } ?>
                </body>
                </html>
                        </div>

                        
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->