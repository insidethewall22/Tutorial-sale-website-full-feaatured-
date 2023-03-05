<?php
//put your code here ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Upload</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    
</head>
<style type="text/css">
    *{
        margin: 0;
        padding 0;
        list-style:none;         
    }
    .form{
        background:url('<?php echo base_url('assets/img/product.jpg'); ?>') no-repeat;
		width:100%;
		height:100vh;
		background-size:160%;
    }
    .product{
        margin-top:
            40%;
    }
   
  
  
</style>
<body>
    <div class="form">
        <div class="container ">
            <div class = "row justify-content-center ">
                <div class="col-md-8">
                    <div class="card product">
                        <div class="card-header">
                            <h3>Add products
                                <a href="<?=base_url('account') ?>" class="btn btn-danger btn-m float-right"> Back</a>
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('ProductUpload/store')?>" method= "POST"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2 ">
                                    <?php if($this->session->flashdata('success')){
                                      echo '<div class="alert alert-success">'.$this-> session->flashdata("success").'</div>';};
                                        if($this->session->flashdata('failure')){
                                            echo '<div class="alert alert-danger">'.$this-> session->flashdata("failure").'</div>';
                                      
                                              }
                                        ?>
                                        <label>Product name</label>
                                        <input type="text" name="productName" class="form-control" 
                                        required placeholder="Enter product name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2 ">
                                        <label>Description</label>
                                        <textarea  name="description" class="form-control" required placeholder="Enter description">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>Price</label>
                                        <input type="text" name="price" class="form-control" 
                                        required placeholder="Enter price num $">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>Product</label>
                                        <input type="file" name="product" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary px-4 float-right">Save</button>
                                
                                </div>
                            </div>
                            </form>


                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>