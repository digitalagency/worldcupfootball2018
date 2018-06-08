
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
    <title>Asian Nepal / Home Page</title>

    <link href="<?php echo base_url();?>content_home/new/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?php echo base_url();?>content_home/new/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/new/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>content_home/new/css/responsive.css" rel="stylesheet" media="screen">
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

<div class="container">
	<nav class="navbar navbar-default navbar">
		<div class="container">
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
		</div>
	<!-- /.container -->
	</nav>
</div>
<section class="container">
	<header class="header">
		<!-- <img src="<?php echo base_url();?>content_home/new/images/header-bg1.jpg" alt="Brand Logo"> -->
		<figure class="logo">
			<img class="img-responsive" src="<?php echo base_url();?>content_home/new/images/logo1.png" alt="Brand Logo">
			<figcaption><p>रंग सजिन्छ मनमा <br><span> REWARD, CASH </span> र <span> CAR</span> घरमा </p></figcaption>
		</figure>
		
	</header>
	<div class="right-product">
		<figure><img class="express" src="<?php echo base_url();?>content_home/new/images/b-express.png" alt=""></figure>
		<figure><img class="product" src="<?php echo base_url();?>content_home/new/images/right-product.png" alt=""></figure>
	</div>
	<div class="offers clearfix">
		<div class="row">
			<div class="top_offers clearfix">
				<div class="col-md-4">
					<div class="offer-item bumper">
						<h2>Cash</h2>
						<figure>
							<img src="<?php echo base_url();?>content_home/new/images/cash.png" alt="1">
						</figure>
						<figcaption>
							<p>घरधनीह्रुलाई <br><strong>२५ लाखसम्म <span>CASH</span></strong></p>
						</figcaption>
					</div>
				</div>
				<div class="col-md-8">
					<div class="offer-item super">
					<h2>SURE SHOT</h2>
						<figcaption>
							<p>बर्जर एक्सप्रेस पेन्टि·को प्रयोगमा <strong><span>100 SQ ft Silk Illusions +</span> ई–कुपनबाट <span>BALTRA</span> को <span>Electric Kettle, Toaster, Sandwich Maker, Personal Fan</span> वा <span>Samsung J1 NXT PRIME</span> पक्का</strong></p>
						</figcaption>
						<figure>
							<img src="<?php echo base_url();?>content_home/new/images/berger-box1.png" alt="1">
						</figure>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="offer-item sure">
					<div class="row">
						<div class="col-md-7 col-sm-7 no-padding">
							<figure>
								<img src="<?php echo base_url();?>content_home/new/images/berger-box2.png" alt="1">
							</figure>

						</div>

						<div class="col-md-5 col-sm-5">
							<h2>SURE SHOT</h2>
							<figcaption>
								<p>बर्जरको  <span>WCAG, WCS, SILK, Easy <br>Clean </span> / <span>RTC</span> पेन्टले घर रंगाउ“दा <br><strong><span>100 SQ ft Silk Illusions</span> पक्का</strong></p>
							</figcaption>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="offer-item so-cash text-center">
					<figure>
						<img src="<?php echo base_url();?>content_home/new/images/offer/3.png" alt="1">
					</figure>
					<figcaption>
						<p>सबैभन्दा धेरै <span>LIKE</span> पाउने <br><strong>१ घरधनीलाई <br> रु. १० हजार</strong></p>
					</figcaption>
				</div>
			</div>
		</div>		
	</div>
	<div class="footer clearfix">
		<div class="col-sm-1 col-sm-1 col-xs-1 no-padding">
			<img class="mobile" src="<?php echo base_url();?>content_home/new/images/mobile.png" alt="mobile">
		</div>
		<div class="col-md-7 col-sm-5 col-xs-11">
				<div class="footer-left">
					<p>टोल फ्री नं. १६६०–०१–२३४३४ <span>(NTC) /</span> ९८०–१५७–१००१ <span>(Ncell)</span> मा कल वा <span> &lt;berger&gt; </span> टाइप गरी ३३७७ मा एस्.एम्.एस्. गरी योजनामा सहभागी हुनुहोस् । थप जानकारीका लागि तपाईं नजिकैको डिलर, <span>www.rangmagical.bergerpaintsnepal.com</span> वा हाम्रो फेसबुक पेज <span>Facebook.com/AsianPaintsNepal</span> मा हेर्नुहोस् ।</p>
					<p class="small">योजनामा सहभागिताको लागि १५ भाद्र २०७४ देखि १५ मङ्सिर २०७४ सम्म दर्ता गरिसक्नुपर्नेछ भने १५ पौष २०७४ सम्म रंगरोगन कार्य समापन गरिसक्नुपर्नेछ ।</p>
				</div>
		</div>
		<div class="col-md-2 col-sm-3 col-xs-6 nopadding">
			<div class="footer-right">
				<figure><img src="<?php echo base_url();?>content_home/new/images/building-bg1.png" alt="building"></figure>
				<figcaption>
					<p>उत्कृष्ट कमर्सियल <br>भवन</p>
					<p class="border">१ घरधनीलाई <br> रु. १ लाख</p>
				</figcaption>
			</div>
		</div>
		<div class="col-md-2 col-sm-3 col-xs-6 nopadding">
			<div class="footer-right">
				<figure><img src="<?php echo base_url();?>content_home/new/images/building-bg.png" alt="building"></figure>
				<figcaption>
					<p>शहरोन्मुख २०<br> शहर</p>
					<p class="border">२० घरधनीहरुलाई<br> रु. २०–२० हजार</p>
				</figcaption>
			</div>
		</div>
	</div>
</section>



<a href="#" class="scrollToTop" title="Scroll Back To Top"><i class="fa fa-angle-up"></i></a>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>content_home/new/js/jquery-1.10.1.min.js"></script>
    <script src="<?php echo base_url();?>content_home/new/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>content_home/new/js/main.js"></script>    

</body>
</html>