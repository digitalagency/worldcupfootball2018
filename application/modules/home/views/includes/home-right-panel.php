 <form method="post" role="form"  name="frmt" action="<?php echo base_url();?>login-process" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="introform">
        <div class="formsection">
          <div class="form-group title_header_image">
            <p>LOG IN</p>
          </div>
          <div class="row">
            <div class="col-md-12 myform">
              <div class="form-group">
                <input type="text" class="form-control textbox" placeholder="Email Address :" required name="username" id="username" value="" autocomplete="off">
              </div>
              <div class="form-group">
                <input type="password" class="form-control textbox" placeholder="Password :" required name="userpassword" id="userpassword" value="" autocomplete="off">
              </div>
              <div class="form-group submit">
                <input value="Login" name="btnLogin" id="btnLogin" type="submit" class="btn">
              </div>
              <div class="form-group text-center"> <a href="">Forgot your Password ?</a> </div>
              <!-- <div class="form-group">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=167208116672576&autoLogAppEvents=1';
                    fjs.parentNode.insertBefore(js, fjs);
                  }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>