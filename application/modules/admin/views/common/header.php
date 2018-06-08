<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>content_admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>content_admin/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>content_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>content_admin/dist/css/skins/_all-skins.min.css">
<!--   <link rel="stylesheet" href="<?=base_url();?>admin_css/dist/css/style.default.css">
 -->  
    <script src="<?php echo base_url();?>content_home/js/jquery-1.10.1.min.js"></script>
 
<!--validation -->
<script src="<?php echo base_url(); ?>content_admin/jquery-form-validation.js"></script>
<!-- datetime picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>content_admin/bootstrap/css/bootstrap-datetimepicker.min.css">
<!-- datetime picker ends here -->
  <!--datetime picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<!-- jQuery UI -->
<link href="<?php echo base_url();?>content_admin/plugins/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="<?php echo base_url();?>content_admin/plugins/jquery-ui/jquery.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>content_admin/plugins/jquery-ui/jquery-ui.js"></script>
<!-- jQuery UI ends here -->
  <script>
    function site_url(url) {
        return "<?php echo base_url(); ?>" + url;
    }
  </script>
</head>
