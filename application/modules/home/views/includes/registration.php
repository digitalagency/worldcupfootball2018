<form method="post" role="form"  name="frmt" action="<?php echo base_url();?>registration_process" enctype="multipart/form-data">
<div class="home h-left">
  <div class="up">
    <h3>Register</h3>
  </div>
  <div class="down">
    <div class="form-group">
      <label for="Name">NAME</label>
      <input type="text" class="form-control" id="fname" name="fname" required>
    </div>
    <div class="form-group">
      <label for="Username">USERNAME</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="Email">EMAIL</label>
      <input type="email" class="form-control" id="emailaddress" name="emailaddress" required>
    </div>
    <div class="form-group">
      <label for="Password1">CHOOSE A PASSWORD</label>
      <input type="password" class="form-control" id="userpassword" name="userpassword" required>
    </div>
    <div class="form-group">
      <label for="ConfirmPasssword">CONFIRM PASSWORD</label>
      <input type="password" class="form-control" id="conf_password" name="conf_password" required>
    </div>
    <div class="form-group">
      <label class="myButton">
        <input name="yourimage" id="yourimage" type="file" required />
        <span>UPLOAD YOUR IMAGE</span>
      </label>
    </div>
    <div class="bottom">
      <button type="submit" class="btn btn-default" name="btnsubmit">SUBMIT</button>      
      <input value="<?php if(isset($user['facebook_link'])) echo $user['facebook_link'];?>" name="facebook_link" id="facebook_link" type="hidden">
      <input value="<?php if(isset($user['name'])) echo $user['name'];?>" name="facebook_name" id="facebook_name" type="hidden">
      <input value="<?php if(isset($user['email'])) echo $user['email'];?>" name="facebook_email" id="facebook_email" type="hidden">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="i_agree">
          By Clicking on submit, you agree to our terms and conditions. </label>
      </div>
    </div>
  </div>
</div>
</form>
<div class="clear"></div>