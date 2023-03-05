
<div ><img src="<?php echo base_url('assets/img/book.jpg'); ?>" alt="Generic placeholder image" class="startImage" > </div>
<div class="mainpage">
<div class="container marketing homepage">

<!-- Three columns of text below the carousel -->
    <div class="row justify-content-center search">
    <?php echo form_open('mainpage', array('method'=>'get'))?>
          <div class="col-7 form-inline">
            <label for="class">Course Name:</label>
            <input size='40' id="class" type="text"  required name="keyword" value="">
          </div>
          <div class="col-2 form-inline">
              <button type="submit"  class="btn btn-primary" >Search</button>
          </div>
          <div class="col-2 form-inline">
              <a href="<?php echo base_url('mainpage');?>"  class="btn btn-danger" >Back</a>
          </div>
    </div>
      </form>
        <?php if(isset($keyword)){?>
          <div class="col-md-4">
              <h2 class="featurette-heading title">Search Outcome <span class="text-muted">Make your study easy!</span></h2>
          </div>
      
    <div class="row">
        <?php
            foreach($records as $key => $value){  
        ?>
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?php echo base_url(substr($value['imagePath'],23)) ; ?>" alt="Generic placeholder image" width="250" height="200">
                <div class="card-body">
                    <p class="card-text fw-bold ">
                        <?=$value['productName'] ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="<?php echo base_url('viewproduct/view_product/'.$value['id']) ; ?>" class="btn btn-sm btn-outline-secondary">View</a>
                        </div>
                        <p class="card-text text-right fw-bold  ">
                                <?=$value['price'] ?>$
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
          }
        ?>
      <?php } else{?>
    <div class="col-md-4">
            <h2 class="featurette-heading title">All cources <span class="text-muted">It'll blow your mind.</span></h2>

        </div>
    <div class="row ">
 
    <?php
        foreach($result as $key => $value){  
    ?>
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?php echo base_url(substr($value['imagePath'],23)) ; ?>" alt="Generic placeholder image" width="250" height="200">
                <div class="card-body">
                    <p class="card-text fw-bold ">
                        <?=$value['productName'] ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="<?php echo base_url('viewproduct/view_product/'.$value['id']) ; ?>" class="btn btn-sm btn-outline-secondary">View</a>
                        </div>
                        <p class="card-text text-right fw-bold  ">
                                <?=$value['price'] ?>$
                        </p>
                    </div>
                </div>
            </div>
        </div>
    

    <?php
        }
    ?>
    </div>
    <?php
        }
    ?>

<!-- START THE FEATURETTES -->

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">First featurette heading. <span class="text-muted">Give you best study resources.</span></h2>
    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-responsive center-block" src="<?php echo base_url('assets/img/study.jpg'); ?>" width="500" height="500" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 col-md-push-5">
    <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  </div>
  <div class="col-md-5 col-md-pull-7">
    <img class="featurette-image img-responsive center-block" src="<?php echo base_url('assets/img/study2.jpg'); ?>" width="500" height="500" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-responsive center-block" src="<?php echo base_url('assets/img/study3.jpg'); ?>" width="500" height="500" alt="Generic placeholder image">
  </div>
</div>


<hr class="featurette-divider">


<!-- /END THE FEATURETTES -->


<!-- FOOTER -->
<footer>
  <p class="pull-right"><a href="#">Back to top</a></p>
</footer>
</div>
</div>
</body>
</html>