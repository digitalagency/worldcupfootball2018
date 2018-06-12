<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title>SETWET Nepal / Home Page</title>
    <link href="<?php echo base_url();?>content_home/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?php echo base_url();?>content_home/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/css/style.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url();?>content_home/css/responsive.css" rel="stylesheet" media="screen"> -->
    <link rel="shortcut icon" href="images/fav-icon.png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->
<body>
  <!--header start-->
  <section class="container">
  	<header class="header">
  		<figure class="logo">
  			<img class="img-responsive" src="<?php echo base_url();?>content_home/images/play_in_style_logo.png" alt="SETWET Nepal" width="100%">
  			<figcaption><p>Play all three contest to increase your total score and win the exiting prizes.</p></figcaption>
  		</figure>  		
  	</header>
    <div class="row mainpanel">
      <div class="col-md-6">
        <?php $this->load->view('includes/thank-you.php');?>
      </div>
      <div class="col-md-6">
        <?php $this->load->view('includes/home-right-panel.php');?>
      </div>
    </div>
  	<div class="footer clearfix">
  		<div class="col-sm-12 col-sm-12 col-xs-12 no-padding text-center">
  			&copy; 2018 SETWET Nepal. All Rights Reserved.
  		</div>
  	</div>
  </section>
  <!-- jQuery -->
  <script src="<?php echo base_url();?>content_home/js/jquery-1.10.1.min.js"></script>
  <script src="<?php echo base_url();?>content_home/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>content_home/js/main.js"></script> 
</body>
</html>