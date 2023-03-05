<?php
//put your code here ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    
	<style type="text/css">

        .form{
			background:url('<?php echo base_url('assets/img/background.jpg'); ?>') no-repeat;
			width:100%;
			height:100vh;
			background-size:200%;
		}
	
		.login-title {
			padding:30px 0px 30px 0px;
			font-family: font-family: 'Barlow Condensed', sans-serif;
			font-size: 40px;
		}

		.login-form {
			position:absolute;
			top:15vh;
			background-color: #fff;
			padding:30px;
			border-radius:10px;
			box-shadow: 0px 0px 10px 0px #000;  
		}

		.submit {
			margin-top: 30px;
		}


		@media only screen and (max-width:678px) {
			.form{
				background-size:300%;
			}
		}
	</style>
</head>

	


<body>
	<form action="<?=base_url().'Login/password?hash='.$hash?>" method="post">
		<div class="container-fluid form">
			<div class="row justify-content-center">
				<div class="col-12 col-md-3 col-sm-6 login-form">
					<h2 class="text-center login-title">Change Password</h2>   

                    <div class="form-group">
					<?php if($this->session->userdata('error')){?>
                        <p class="text-danger"><?= $this->session->userdata('error') ?></p> 
                    <?php } ?>

                    <?php if($this->session->userdata('success')){?>
                        <p class="text-success"><?= $this->session->userdata('success') ?></p> 
                    <?php } ?>
                    <div class="text-danger"><?php echo validation_errors(); ?></div>
					</div>	
					<div class="form-group">
                        <label for='password'>New Password </label>
						<input type="text" class="form-control" id="password" placeholder="Your new password" required="required" name="newPassword" >
					</div> 
                    <div class="form-group">
                        <label for='confirm'>Confirm New Password </label>
						<input type="text" class="form-control" id="confirm" placeholder="confirm your password" required="required" name="cPassword" >
                        <a href=<?= base_url()."Login" ?> class="float-left">Login In</a>
					</div> 
					<div class="form-group submit">
						<button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
	                </div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>
