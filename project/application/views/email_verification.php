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
        .contain{
            background:url('<?php echo base_url('assets/img/background.jpg'); ?>') no-repeat;
			width:100%;
			height:100vh;
			background-size:200%;

        }
        .success {
            padding:15px;
            width:40%;
            text-align:center;

            font-size: 1.5em;
            background-color: white;
            font-weight: bold;
            position:absolute;
			top:15vh;
            left: 50vh;
        }

        @media only screen and (max-width:678px) {
			.form{
				background-size:300%;
			}
		}

    </style>
</head>



<body>
    <div class = "contain">
    <div class="success">
        <?php
        echo $message;
        ?>
    </div>
    </div>


</body>
</html>