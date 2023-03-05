<?php
//put your code here ?>
<html>
    <head>
            <title>sidebar</title>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
            <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    </head>
    <style type="text/css">
                .sidebar{
                font-family : 'Roboto', sans-serif;
                position:fixed;
                left: 0;
                width:350px;
                height:100%;
                background : #042331;
        }

        .sidebar header{
                font-size:35px;
                color:white;
                text-align:center;
                line-height:70px;
                background: #063146;
                user-select: none;
        }

        
        .n {
                display:block;
                line-height: 65px;
                font-size:25px;
                color: white;
                padding-left : 40px;
                box-sizing: border-box;
                border-top: 2px solid rgba(255,245,255,.1);
                border-bottom : 1px solid black;
                transition: .4s;
        }

        .navigation li:hover a{
                padding-left:70px;
                text-decoration: none;
        }
        .navigation li{
                margin-top:30px;
                
        }
        .title{
            font-size:20px;
            font-family : 'Libre Baskerville', serif;
            letter-spacing:0.5px;

        }
        .description{
            font-size:20px;
            letter-spacing:1px;

        }
        .info{
            font-size:15px;
            font-weight: bold;
            font-family : 'Libre Baskerville', serif;
            letter-spacing:0.5px;
            padding-top: 10px;
        }
        .cart{
            margin-top:10px;
            font-size:15px;

        }

        .featurette-divider {
            margin: 60px 0; /* Space out the Bootstrap <hr> more */
        }
        .subtitle{
            margin:15 0px;
        }
        .startImage{     
            margin-bottom:20px;
            width:100%;
            height:55%;
            
        }
        .post{
            margin:20 0px;
        }

        .line{
            line-height:8px;
        }
        .content{
            font-size:20px;
        }

    </style>
    <script>
        $(document).ready(function(){
            var num = 0;
            $('.like').click(function(){
                num++;
                var productid = $(this).attr('id');
                if(num%2== 1){
                    $.ajax({
                        url:'<?php echo base_url(); ?>viewproduct/rate',
                        method:"POST",
                        data:{
                            'like':1,
                            'productid': productid
                        },
                        success:function(response){
                            $('#likerate').html(response);
                        }
                   
                    });
                }else if(num%2== 0){
                    $.ajax({
                        url:'<?php echo base_url(); ?>viewproduct/rate',
                        method:"POST",
                        data:{
                            'deleteLike':0,
                            'productid': productid
                        },
                        success:function(response){
                            $('#likerate').html(response);
                        }
                    });
                } 
            });
            var dnum = 0;
            $('.dislike').click(function(){
                dnum++;
                var productid = $(this).attr('id');
                if(dnum%2== 1){
                    $.ajax({
                        url:'<?php echo base_url(); ?>viewproduct/rate',
                        method:"POST",
                        data:{
                            'dislike':1,
                            'productid': productid
                        },
                        success:function(response){
                            $('#dislikerate').html(response);
                        }
                   
                    });
                }else if(dnum%2== 0){
                    var productid = $(this).attr('id'); 
                    $.ajax({
                        url:'<?php echo base_url(); ?>viewproduct/rate',
                        method:"POST",
                        data:{
                            'deleteDisLike':0,
                            'productid': productid
                        },
                        success:function(response){
                            $('#dislikerate').html(response);
                           
                        }
                    });
                } 
            });
            var cnum = 0;
            $('.cart').click(function(){
                cnum++;
                var product_id = $(this).attr('id');
                if(cnum == 1){
                    $.ajax({
                    url:'<?php echo base_url(); ?>viewproduct/addCart',
                    method:"POST",
                    data:{
                        'productid': product_id
                    },
                    success:function(response){
                        $('#add_cart').html(response);
                       
                    }
                    });
                }
                
            });
            var limit = 2;
            var start = 0;
            var product_id = $('#load_data').attr('class');
            var action = 'inactive';
            function load_data(limit, start){
                $.ajax({
                    url:'<?php echo base_url(); ?>Viewproduct/fetchComment',
                    method: 'POST',
                    data: {
                        limit:limit, 
                        start:start,
                    'productid':product_id
                       
                        },
                    cache: false,
                    success:function(data)
                    {
                        if(data == '')
                        {
                            $('#load_data_message').html('<h3>No More Result Found</h3>');
                            action = 'active';
                        }
                        else
                        {
                            $('#load_data').append(data);
                            $('#load_data_message').html("");
                            action = 'inactive';
                        }
                    }
                
                });
            }
            if(action == 'inactive')
            {
            action = 'active';
            load_data(limit, start);
            }
            $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
                {
                    action = 'active';
                    start = start + limit;
                    setTimeout(function(){
                    load_data(limit, start);
                    }, 1100);
                }
            })
        });

                    
        
    </script>

    <body>
        <nav>
            <div class="sidebar">
                    <header>Menu </header>
                    <ul class="navigation">
                            <li><a href="<?php echo base_url('mainpage'); ?>" class="n">Home</a></li>
                            <li><a href="#" class="n">Search</a></li>
                            <li><a href="#" class="n">Upload</a></li>
                            <li><a href="#" class="n">MyCourses</a></li>
                            <li><a href="<?php echo base_url('account'); ?>" class="n">Account</a></li>
                            <li><a href="<?php echo base_url(); ?>Login/logout" class="n">Logout</a></li>
                    </ul>

            </div>
        </nav>
        <div ><img src="<?php echo base_url('assets/img/study5.jpg'); ?>" alt="Generic placeholder image" class="startImage" > </div>
        <div class="container box ">
            <div class="row justify-content-center">
            <?php
                foreach($result as $key => $value){
                
            ?>
                <div class="col-7 col-md-offset-2">
                <video width="550" height="350" controls>
                <source src='<?php echo base_url(substr($value['productPath'],23)) ; ?>' 
                    type="video/mp4">
                </video>
                <h5 class="text-muted subtitle">Learn <?=$value['productName'] ?> with <?=$value['UserName'] ?> </h5>
                <p>Created at: <?=$value['created_at'] ?></p>
                <p>
                    Favour/Unfavour: 
                    <!-- rating feature-->
                    <button
                        class="btn btn-outline-secondary btn-sm like" id="<?=$value['id'] ?>">
                        <span id ="likerate"> Like
                        <img class="priceicon" src='<?php echo base_url('assets/img/thumbup.png'); ?>'width='20'>
                        <?php echo $value['favourite'] ?>
                        </span>

                    </button>
                    <button
                        class="btn btn-outline-secondary btn-sm dislike" id="<?=$value['id'] ?>">
                        <span id="dislikerate"> Dislike
                        <img class="priceicon" src='<?php echo base_url('assets/img/thumbdown.png'); ?>'width='20'>
                        <?php echo $value['dislike'] ?>
                        </span>
                </button>
                </p>
                </div>
                <div class="col-3">
                    <h1 class="text-muted">Course Information</h1>
                    <p class="title">
                    <?=$value['productName'] ?>
                    </p>
                    <p class="description">
                    <?=$value['description'] ?>
                    </p>
                    <p class="info">
                    <img class="usericon" src='<?php echo base_url('assets/img/icons8-user-30.png'); ?>'>
                    Author: <?=$value['UserName'] ?>
                    </p>
                    <p class="info">
                    <img class="priceicon" src='<?php echo base_url('assets/img/priceicon.png'); ?>'width='30'>
                    Price: <?=$value['price'] ?>$
                    </p>
                    <!-- shop-->
                    <button class="btn btn-sm btn-outline-secondary cart" id="<?=$value['id'] ?>">
                        <span id="add_cart" >
                        Add to cart
                        <img class="priceicon" src='<?php echo base_url('assets/img/shopping cart.png'); ?>'width='30'>
                        </span>
                    </button>
                </div>
            </div>
            <hr class="featurette-divider">
            <div class="row justify-content-center ">
                <!-- comment-->
                <div class="col-7">
                    <h2 class="text-muted">Review comments</h2>
                    <div id="load_data" class="<?=$value['id'] ?>"></div>
                    <div id="load_data_message"></div>
                </div>
                <div class="col-3 col-md-push-3">
                    <h2 class="text-muted">Your comment</h2>
                    <?php
                        if($this->session->flashdata('comment_empty')){
                            echo '<div class="alert alert-danger">'.$this-> session->flashdata("comment_empty").'</div>';
                        } 
                        if($this->session->flashdata('success')){
                            echo '<div class="alert alert-success">'.$this-> session->flashdata("success").'</div>';
                        } 
                    ?> 
                    <form action="<?= base_url('viewproduct/addComment/'.$value['id'])?>" method= "POST">
                        <textarea id="comment" name="comment" rows="10" cols="50">
                        </textarea>
                        <button type="submit" class="btn btn-primary px-4 float-left post">Post</button>
                    </form>
                </div>

            </div>
            <?php }?>
 
        </div>
        



    </body>
</html>