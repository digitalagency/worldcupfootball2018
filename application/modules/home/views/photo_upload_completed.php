<?php 
if (!session_id()) {
    session_start();
}
?>


<div class="terms-conditions register">
  <div class="row">
    <div class="col-md-12">
      <form method="post" role="form"  name="frmt" action="<?php echo base_url();?>photo-upload-process" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-8 col-sm-12">
            <?php
            if (isset($_GET['message']) && $_GET['message'] != "") 
              $message = $_GET['message'];

            if (!empty($message)) { ?>
            <div class="error"><?php echo $message; ?></div>
            <?php } ?>
            <div class="introform">
              <div class="form-group">
                <label>Thank You Dear Valued customer's for immense support.<br><br>We are glad to get thousands of entries for Asian Rangmagical Competition. The judgment process is ongoing and we will be soon declaring the winners</label>
              </div>
            </div>
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>