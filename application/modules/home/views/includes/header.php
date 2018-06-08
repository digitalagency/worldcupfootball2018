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
    <?php
    $controller = $this->uri->segment('1');
    if($controller == 'photo-gallery-single')
    {
        if(isset($userinfo))
        {
            $row = $userinfo['0'];
            $og_url = "https://rangmagical.bergernepal.com/photo-gallery-single/".$row->user_id;
        ?>
        <title><?php echo $userinfo['0']->full_name; ?> / Rang Magical / Asian Paints Nepal</title>
        <meta property="og:locale" content="en_US"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="<?php echo $userinfo['0']->full_name; ?> - Rang Magical"/>
        <meta property="og:description" content="रंग सजिन्छ मनमा, REWARD, CASH र CAR घरमा - बर्जर पेन्त्स"/>
        <meta property="og:url" content="<?php echo $og_url;?>"/>
        <meta property="og:site_name" content="Asian Paints Nepal"/>
        <meta property="article:publisher" content="https://www.facebook.com/AsianPaintsNepal/"/>
        <meta property="article:tag" content="Rang Magical"/>
        <meta property="article:section" content="Asian Paints Nepal Scheme"/>
        <meta property="article:published_time" content="<?php echo date('Y-m-d H:i:s') ?>"/>
        <meta property="fb:app_id" content="119245252069925"/>
        <meta property="og:image" content="<?php echo base_url().$row->imagepath.$row->imagename;?>"/>
        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:description" content="रंग सजिन्छ मनमा, REWARD, CASH र CAR घरमा - बर्जर पेन्त्स"/>
        <meta name="twitter:title" content="<?php echo $row->full_name; ?> - Rang Magical"/>
        <meta name="twitter:image" content="<?php echo base_url().$row->imagepath.$row->imagename;?>"/>    
        <?php
        }
    }
    else
    {
    ?>
    <title>Home Page / Rang Magical /Asian Nepal</title>
    <?php
    }
    ?>
    <link href="<?php echo base_url();?>content_home/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/css/wstyle.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/css/others.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/css/wresponsive.css" rel="stylesheet" media="screen">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php echo base_url();?>content_home/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url();?>content_home/images/favicon.ico" type="image/x-icon">
    <!-- jQuery -->
    <script src="<?php echo base_url();?>content_home/js/jquery-1.10.1.min.js"></script>
    <script src="<?php echo base_url();?>content_home/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>content_home/js/main.js"></script>    
    <!-- jQuery UI -->
    <link href="<?php echo base_url();?>content_admin/plugins/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />
    <!-- <script type="text/javascript" src="https://rangmagical.bergernepal.com/content_admin/plugins/jquery-ui/jquery.js"></script> -->
    <script src="<?php echo base_url();?>content_admin/plugins/jquery-ui/jquery-ui.js" type="text/javascript" ></script>
    <!-- jQuery UI ends here -->
    <?php $this->load->view('fb_like_script');?>
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body>

<section class="container">
	<nav class="navbar navbar-default navbar">
		<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php $this->load->view('includes/menu');?>
        </div>
		<!-- /.navbar-collapse -->
<!-- /.container -->
    </nav>