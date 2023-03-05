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
                <?php echo $map['js']; ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dropzone/dropzone.css">
                <script rel="stylesheet" type="text/javascript" href="<?php echo base_url(); ?>assets/dropzone/dropzone.js"></script>

      </head>
      <style type="text/css">

              *{
                      margin: 0;
                      padding 0;
                      list-style:none;
                      
                      
                      
               }

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

                .welcome{
                        margin-top: 10px;
                        font-family : 'Libre Baskerville', serif;
                        font-size:60px;
                        font-weight : bold;
                }

                .subhead{
                        font-family: 'Libre Baskerville', serif;
                        font-size: 30px;

                }


                /* avatar upload */
 
                .home{
                        
                        margin-left: 400px;
                }
                .default_avatar{
                        width:150px;
                        height:150px;
                        border-radius:50%;
                        margin-bottom: 20px;
                }
        
                .upload-failure{
                        font-size:15px;
                        color:red;
                        
                }

                .upload{
                        font-size: 20px;
                        font-weight: bold;
                        color:white;
                        background:  #042331;
                        letter-spacing:2px;
                        width: 95px;
                        height:35px;

                }
                .upload:hover {
                        background:  white;
                        color:#042331;
                }


                .avatar{
                        margin-top: 40px;
                }
                /* user infomation */

                .userinfo{
                        font-family: 'Libre Baskerville', serif;
                        font-size: 1.2em;
                }
                /* email update */
                .update{
                        font-size: 20px;
                        font-weight: bold;
                        color:white;
                        background:  #042331;
                        letter-spacing:2px;
                }
                .update:hover {
                        background:  white;
                        color:#042331;
                }
                .email-input{
                        margin-left:20px;
                        width:200px;
                }
                /* map */
                .map{
                        margin-right: 10px;

                }

                .carousel {
                        height: 500px;
                        margin-bottom: 60px;
                }
                .carousel-caption {
                        z-index: 10; /* Since positioning the image, we need to help out the caption */
                }

                /* Declare heights because of positioning of img element */

                .mainpage{
                        overflow-x: hidden;
                        margin-left:400px;
                }
        

                .startImage{
                        
                       
                        margin-bottom:20px;
                        width:100%;
                        height:70%;
                     
                }

                .search{
                        margin-bottom:20px;
                        
                }
               
                /* MARKETING CONTENT
-------------------------------------------------- */

/* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
        margin-bottom: 20px;
        text-align: center;
        }
        .marketing h2 {
        font-weight: 500;
        }
        .marketing .col-lg-4 p {
        margin-right: 10px;
        margin-left: 10px;
        }


        /* Featurettes
        ------------------------- */

        .featurette-divider {
        margin: 80px 0; /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        .featurette-heading {
        font-weight: 300;
        line-height: 1;
        letter-spacing: -1px;
        }
        .title{
                margin-bottom: 30px;
        }

        </style>
        <script type="text/javascript">
        $(document).scroll(function () {
        localStorage['page'] = document.URL;
        localStorage['scrollTop'] = $(document).scrollTop();
        });
        $(document).ready(function () {
        if (localStorage['page'] == document.URL) {
            $(document).scrollTop(localStorage['scrollTop']);
        }
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
       

   
     








