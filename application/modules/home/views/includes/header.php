<!DOCTYPE html>
<html lang="">
<head>
<?php $this->load->view('includes/prehead');?>
</head>

<body>
<?php
$user_id = $this->session->userdata('user_id');
if(isset($user_id) && $user_id>0)
    $home = base_url().'dashboard';
else
    $home = base_url();
?>          
<div id="banner" class="text-center"><a href="<?php echo $home;?>"> <img src="<?php echo base_url();?>content_home/images/banner.png" width="50%"></a> </div>
<?php
if(isset($user_id) && $user_id>0){ 
    $this->load->view('includes/user_scoreboard_section'); 
}
?>