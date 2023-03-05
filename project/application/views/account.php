

    <div class="container home home1">
        <p class="welcome">Welcome <?php echo $_SESSION['username'];?></p>
        
        <div class="row avatar">
            <div >
                <p class="subhead">Upload your avatar</p>
                <!--Avatar upload -->
                
                <?php
                if(isset($_SESSION['userpath'])){ ?>
                    <img class="default_avatar" src='<?php echo base_url(substr($_SESSION['userpath'],23)) ; ?>'>
                <?php
                }else { 
                    ?>
		    <img class="default_avatar" src='<?php echo base_url('assets/img/default-avatar.jpeg'); ?>'>
                <?php
                }
                ?>
               <div class="upload-failure"> <?php echo $error;?></div>
               <?php if($this->session->flashdata('avatar_success')){
                echo '<div class="alert alert-success">'.$this-> session->flashdata("avatar_success").'</div>';
                }?> 
                <form action="<?=base_url().'Account/avatar_upload'?>" enctype="multipart/form-data" class="dropzone" method="post" id='fileupload'>
                <div class="form-group avatar-button">
                    <input type="file"  name="userfile" value="choose file" />
				</div>
				<div class="form-group avatar-button">
                    <input type="submit" value="Upload"   class="upload"/> 
				</div>
            </form>
                
            </div>
        </div>
    </div>
    <div class= "home">
        <div class="avatar">
            <p class="subhead">User Information</p>
        </div>
        <div>
        <p class="userinfo">User Name:  <?php echo $_SESSION['username'];?></p>
        <p class="userinfo">User Email:  <?php echo $_SESSION['email'];?></p>
        <p class="userinfo">Email Verification:  <?php echo $_SESSION['email_verification'];?></p>
        </div>
     </div>
    <div class="home">
        <div class="avatar">
            <p class="subhead">Email Update</p>
        </div>
        <form action="<?=base_url().'Account/email_update'?>" method="post">
        <?php
            if($this->session->flashdata('message')){
                echo '<div class="alert alert-success">'.$this-> session->flashdata("message").'</div>';
            } 
        ?> 
        <div class="form-group">
                <label class="userinfo">Enter Your Email </label> 
                <input type="text" name="useremail" class="form email-input" placeholder="Change Email" required="required" value="<?php echo set_value('useremail'); ?>">
                <span class="text-danger"><?php echo form_error('useremail'); ?></span>
		</div>
        <div class="form-group">
            <input type="submit" class="update" name="submit" value="Update">
	    </div>
        <?php
        if($this->session->flashdata('message')){
            echo '<div class="form-group"> 
            <input type="text" name="verify_number" required="required" class="form email-input" placeholder="new verification number">
            </div>
            <div class="form-group">
            <input type="submit" class="update" name="update_number" value="Update_number">
            </div>
            ';
        }?>
        <?php if($email_error != ''){
            echo '<div class="alert text-danger">'.$email_error.'</div>';
        }
        ?>

        <?php if($this->session->flashdata('incorrect_key')){
            echo '<div class="alert alert-danger">'.$this-> session->flashdata("incorrect_key").'</div>';
        }?>

        <?php if($this->session->flashdata('change_success')){
            echo '<div class="alert alert-success">'.$this-> session->flashdata("change_success").'</div>';
        }?> 
        </form>
        <!-- map API -->
        <div class="avatar"> 
            <p class="subhead">User Location</p>
        </div>
        <div class="map">
            <?php echo $map['html'];?>
        </div>

        <!-- uploading tutorials -->
        <div class="avatar"> 
            <p class="subhead">Personal videos</p>
        </div>
        <!-- uploading tutorials -->
        <form action="<?=base_url().'Account'?>" enctype="multipart/form-data" method="post">
            <?php
                if($this->session->flashdata('filemessage')){
            ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('filemessage')?></div>
            <?php }
            ?>
            <div class="form-group avatar-button">
                <label class="form-label" id="files"> Select Files </label>
                <input type="file" multiple=""  id="files" name="uploadfiles[]" />
            </div>
            <div class="form-group avatar-button">
                <input type="submit" class="upload" value= "Upload"/> 
            </div>
        </form>
        <div class="videos ">
            <?php if($tutorials != null){ foreach($tutorials as $key => $tutorial): ?>
            <video width="320" height="240" controls>
            <source src='<?php echo base_url(substr($tutorial['TutorialPath'],23)) ; ?>' type="video/mp4">
            </video>
            <?php endforeach;} ?>
        </div>

        <!-- uploading products -->
        <div class="avatar"> 
            <p class="subhead">Upload products</p>
        </div>
        <div class = "row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3>products
                            <a href="<?=base_url('productUpload') ?>" class="btn btn-primary btn-m float-right"> Add</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered ">
                            <thread>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Cover</th>
                                    <th>Product</th>
                                    <th>ViewPDF</th>
                                    <th>Action</th>
                                </tr>
                            </thread>
                            <tbody>
                            <?php if(isset($products)){ foreach($products as $row): ?> 
                                    <tr>
                                        <th><?php echo $row['id']?></th>
                                        <th><?php echo $row['productName']?></th>
                                        <th><?php echo $row['description']?></th>
                                        <th><?php echo $row['price']?></th>
                                        <th><img src='<?php echo base_url(substr($row['imagePath'],23)) ; ?>' height= "150px" width="160px"></th>
                                        <th>
                                        <video width="200" height="150" controls>
                                        <source src='<?php echo base_url(substr($row['productPath'],23)) ; ?>' 
                                         type="video/mp4">
                                        </video>
                                        </th>
                                        <th>
                                        <a href="<?=base_url('account/pdf_product/'.$row['id']) ?>" class="btn btn-info btn-sm" target="_blank">ViewPDF</a>
                                        </th>
                                        <th>
                                        <a href="<?=base_url('account/delete_product/'.$row['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </th>
                                    </tr>   
                                <?php endforeach;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- shopping cart -->
        <div class="avatar"> 
            <p class="subhead">Shop Cart</p>
        </div>
        <div class = "row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header" id="yourCart">
                        <h3>To Pay
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered ">
                            <thread>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Item Details</th>
                                    <th>Cover</th>
                                    <th>Order Time</th>
                                    <th>Payment</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thread>
                            <tbody>
                            <?php if(isset($tobuy)){ foreach($tobuy as $row): ?> 
                                    <tr>
                                        <th><?php echo $row['order']?></th>
                                        <th><?php echo 'productID '. $row['product_id'].": ".$row['productName']?></th>
                                        
                                        <th><img src='<?php echo base_url(substr($row['imagePath'],23)) ; ?>' height= "150px" width="160px"></th>
                                        <th><?php echo $row['purchased_at']?></th>
                                        <th><?php echo $row['payment']?></th>
                                        <th><?php echo $row['price']?>$</th>
                                        <th>
                                        <a href="<?=base_url('account/delete_cart/'.$row['order']) ?> " class="btn btn-danger btn-sm">Delete</a>
                                        </th>
                                    </tr>   
                            <?php endforeach;} ?>
                            <?php if(isset($total_price)){ foreach($total_price as $row): ?> 
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo $row['total']?>$</th>
                                </tr>
                            <?php endforeach;} ?>
                            </tbody>
                        </table>
                        <a href="<?=base_url('products') ?> " class="btn btn-success btn-sm float-right">Check out</a>

                    </div>
                </div>
            </div>
        </div>


    
    </div>

</body>
</html>