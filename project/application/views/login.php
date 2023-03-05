<?php
//put your code here ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
    
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

	<form action="<?=base_url().'Login/check_login'?>" method="post">
		<div class="container-fluid form">
			<div class="row justify-content-center">
				<div class="col-12 col-md-3 col-sm-6 login-form">
				<?php if($this->session->flashdata('fail_validation')){
                echo '<div class="alert alert-danger">'.$this-> session->flashdata("fail_validation").'</div>';
                }?>
					<?php echo form_open(base_url().'login/check_login'); ?>
					<h2 class="text-center login-title">Login</h2>   
					<div class="register">
					<a href="https://infs3202-e7744530.uqcloud.net/project/register">Register a new account</a>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username" 
						value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}; ?>">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password" 
						value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}; ?>">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>					
					<div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember'])){echo "checked='checked'";}; ?>> Remember me</label>
						<a href=<?= base_url()."Login/forgetPassword" ?> class="float-right">Forgot Password?</a>
					</div> 
					<div class="form-group submit">
						<button type="submit" class="btn btn-primary btn-block" name="submit">Log in</button>
	                </div>


					<div class="form-group submit">
						<div class="g-recaptcha" data-sitekey=" 6LdHeMUfAAAAACSY_NlsnKEbovZbhH-KUDCXojjI">
	                </div>
	                </div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>



