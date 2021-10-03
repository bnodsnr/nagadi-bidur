<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css">
	</head>
	<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Welcome <?php echo $emailaddress;?></h3>
				<p>Your account has been successfully registered to Quicklog. To proceed to the login, please <a href="<?php echo base_url();?>Login">click here</a> or paste the url in your browser. Below are the login details.</p>
				<p>
					<table class="table">
						<tr>
							<td>Username</td>
							<td><?php echo $emailaddress;?></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><?php echo $password;?></td>
						</tr>
					</table>
				</p>
				<p>Note: You will be asked to change your password (provided with this email) at the first time of login.</p>
			</div>	
		</div>
		</div>
	</body>
</html>