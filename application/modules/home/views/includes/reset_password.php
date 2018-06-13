<form method="post" role="form"  name="frmt" action="<?php echo base_url().'reset-password/'.$this->uri->segment(2);?>" enctype="multipart/form-data">
<div class="home h-right">
  <div class="up">
    <h3>RESET PASSWORD</h3>
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
      <label for="Email">CHOOSE YOUR PASSWORD</label>
      <input type="password" class="form-control" id="your_password" name="your_password" required>
    </div>
    <div class="form-group">
      <label for="Email">CONFIRM YOUR PASSWORD</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit" class="btn btn-default" name="btnForget">RESET</button>
  </div>
</div>
</form>