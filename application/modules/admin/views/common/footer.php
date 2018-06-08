 <footer class="main-footer">
    <strong>Copyright © <?php echo date('Y ');?>Asian Paints Nepal.</strong>  All rights reserved.
  </footer>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>/content_admin/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>/content_admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/content_admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- FastClick -->
<!--delete button pop up-->
<script src="<?php echo base_url();?>/content_admin/common.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>/content_admin/popup-box.css">

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/content_admin/dist/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>content_admin/bootstrapValidator.js"></script>
<script src="<?php echo base_url();?>content_admin/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  $('document').ready(function() {

      //-----------Datepicker------------------------------
      $('.match_date').each(function(){
        $(this).datetimepicker({            
            format: 'YYYY-MM-DD HH:mm:00'
        });
      });
  });
</script>
</body>
</html>
