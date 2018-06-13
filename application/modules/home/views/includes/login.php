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

<div class="face">
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=1536813856603295&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <div class="fb-page" data-href="https://www.facebook.com/setwet.np/" data-tabs="timeline" data-height="300" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/setwet.np/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/setwet.np/">Set Wet Nepal</a></blockquote></div>
</div>