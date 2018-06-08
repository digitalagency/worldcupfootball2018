<ul class="nav navbar-nav">
	<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
	<li <?php if(@$menu == 'home') echo 'class="active"'; ?>><a href="<?php echo base_url();?>">Home</a></li>
	<li <?php if(@$menu == 'terms') echo 'class="active"'; ?>><a href="<?php echo base_url();?>terms-and-condition">Terms & Conditions</a></li>
	<li <?php if(@$menu == 'procedure') echo 'class="active"'; ?>><a href="<?php echo base_url();?>upload-procedure">Upload Procedure</a></li>
	<li <?php if(@$menu == 'register') echo 'class="active"'; ?>><a href="<?php echo base_url();?>photo-upload">Photo Upload</a></li>
	<li <?php if(@$menu == 'album') echo 'class="active"'; ?>><a href="<?php echo base_url();?>photo-album">Photo Album</a></li>
</ul>