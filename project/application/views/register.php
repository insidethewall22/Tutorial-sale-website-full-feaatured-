<?php
//put your code here ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>register</title>
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
	
		.register-title {
			padding:30px 0px 30px 0px;
			font-family: font-family: 'Barlow Condensed', sans-serif;
			font-size: 40px;
		}

		.register-form {
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
	<form action="<?=base_url().'register/validation'?>" method="post">
		<div class="container-fluid form">
			<div class="row justify-content-center">
				<div class="col-12 col-md-3 col-sm-6 register-form">
					<h2 class="text-center register-title">Register your account</h2> 
                    <?php
                    if($this->session->flashdata('message')){
                        echo '<div class="alert alert-success">'.$this-> session->flashdata("message").'</div>';
                    } 
                    ?>  
					<div class="form-group">
                        <label>Set Your Name</label> 
						<input type="text" class="form-control" placeholder="Username" required="required" name="username"
                        value="<?php echo set_value('username'); ?>">
                        <span class="text-danger"><?php echo form_error('username'); ?></span>
					</div>
					<div class="form-group">
                        <label>Enter Your Email </label> 
						<input type="text" name="useremail" class="form-control" placeholder="Email" value="<?php echo set_value('useremail'); ?>">
                        <span class="text-danger"><?php echo form_error('useremail'); ?></span>
					</div>

					<div class="form-group">
                        <label>Set Your Password</label>
                        <input type="password" class="form-control" placeholder=" 6≤length≤15" required="required" name="userpassword"
                        value = "<?php echo set_value('useremail'); ?>">
                        <span class="text-danger"><?php echo form_error('userpassword'); ?></span>
					</div>					
					<div class="form-group submit">
						<input type="submit" class="btn btn-primary btn-block" name="register" value="Register">
	                </div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>