<?php
$menuSelected = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title>Set Wet Nepal / Home Page</title>

    <link href="<?php echo base_url();?>content_home/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?php echo base_url();?>content_home/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/css/responsive.css" rel="stylesheet" media="screen">
    <link rel="shortcut icon" href="images/fav-icon.png">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
  <section class="wrapper">    
    <div class="container">
      <div class="row">
        <div class="col-md-12 panel">        
      		<div class="row">
      			<figure class="logo">
      				<img class="img-responsive" src="<?php echo base_url();?>content_home/images/logo.png" alt="Brand Logo">
      			</figure>		
      		</div>
      		<div class="row">
      			<div class="col-md-12">
      				To participate in the contest, please Sign Up or Login. 
      			</div>
      		</div>
          <div class="row">        
            <div class="col-md-5 sign-up-panel">                    
  	          <?php $this->load->view('includes/home-left-panel.php');?>
            </div>         
            <div class="col-md-2">                    
            </div>          
            <div class="col-md-5 login-panel">
              <?php $this->load->view('includes/home-right-panel.php');?>
            </div>
          </div>
        </div>
      </div>      
      <div class="row">
        Footer goes here
      </div>
    </div>
  </section>
<a href="#" class="scrollToTop" title="Scroll Back To Top"><i class="fa fa-angle-up"></i></a>
<!-- jQuery -->
<script src="<?php echo base_url();?>content_home/js/jquery-1.10.1.min.js"></script>
<script src="<?php echo base_url();?>content_home/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>content_home/js/main.js"></script>    

</body>
</html>