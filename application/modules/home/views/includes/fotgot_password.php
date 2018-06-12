<form method="post" role="form"  name="frmt" action="<?php echo base_url();?>forgot-password" enctype="multipart/form-data">
<div class="home h-right">
  <div class="up">
    <h3>FORGOT PASSWORD</h3>
  </div>
  <div class="down">
    <?php
    if(isset($message) && !empty($message))
    {
    ?>
    <div class="form-group">
      <label for="Email"><?php echo $message;?></label>
    </div>
    <?php
    }
    ?>
    <div class="form-group">
      <label for="Email">YOUR EMAIL ADDRESS</label>
      <input type="email" class="form-control" id="emailaddress" name="emailaddress" required>
    </div>
    <button type="submit" class="btn btn-default" name="btnForget">SEND</button>
  </div>
</div>
</form>