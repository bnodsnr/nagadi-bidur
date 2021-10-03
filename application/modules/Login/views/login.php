<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/nepal-govt.png">
    <title>LOGIN</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/login.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/style-responsive.css" rel="stylesheet" />


</head>

  <body class="login-body">

    <div class="container">
      <form class="form-signin" action="<?php echo base_url()?>Login" method="post">
       <!--  <h2 class="form-signin-heading">
          <img src="<?php echo base_url()?>assets/img/nepal-govt.png" style="height: 50px;">
        </h2> -->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <img src="<?php echo base_url()?>assets/img/nepal-govt.png">
        <h2 class="form-signin-heading"><?php echo GNAME?> <br><span><?php echo SLOGAN?>  <br>
          <?php echo DISTRICT?> <?php echo STATENAME?> 
        </span></h2>
        <h2 class="form-signin-heading-text">सम्पतिकर / भूमिकर / नगदी रशिद</h2>

         <?php 
        $err_msg = $this->session->flashdata('MSG_ERR_INVALID_LOGIN');
        if(!empty($err_msg)):
         ?>
         <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('MSG_ERR_INVALID_LOGIN');?></span>
        </div>
     <?php endif; ?>

     <?php $auth_msg = $this->session->flashdata('AUTH_ACCESS');
        if(!empty($auth_msg)):
         ?>
         <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('AUTH_ACCESS');?></span>
        </div>
     <?php endif; ?>
        <div class="login-wrap">
            <input type="text" name="Username" class="form-control" placeholder="User Name" autofocus required="required">
            <input type="password" name="Password" class="form-control" placeholder="Password" required="required">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit" name ="Login" value="Login">Sign in</button>
            
            <div class="registration">
               Copyright &copy; <?php echo GNAME?> All Rights Reserved. 
                <a class="" href="registration.html">
                   Powred By: <a href="https://bmsnep.com.np/" target="_blank">BMS</a>.
            </div>

        </div>

      </form>

    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
