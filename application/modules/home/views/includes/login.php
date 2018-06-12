<form method="post" role="form"  name="frmt" action="<?php echo base_url();?>login-process" enctype="multipart/form-data">
<div class="home h-right">
  <div class="up">
    <h3>Log In</h3>
  </div>
  <div class="down">
    <div class="form-group">
      <label for="Email">EMAIL ADDRESS</label>
      <input type="email" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="Password">PASSWORD</label>
      <input type="password" class="form-control" id="userpassword" name="userpassword" required>
    </div>
    <button type="submit" class="btn btn-default" name="btnLogin">Log-In</button>
    <div class="ext">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="i_agree">
          Remember Password </label>
      </div>
      <a class="fp" href="<?php echo base_url();?>forgot-password">Forgot Password</a><br>
<!--       <button type="button" class="btn btn-primary face-but"><i class="fab fa-facebook-f"></i> Log in with Facebook</button>
 -->    </div>
  </div>
</div>
</form>