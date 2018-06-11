 <form method="post" role="form"  name="frmt" action="<?php echo base_url();?>forgot-password-process" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="introform">
        <div class="formsection">
          <div class="form-group title_header_image">
            <p>FORGOT PASSWORD</p>
          </div>
          <div class="row">
            <div class="col-md-12 myform">
              <div class="form-group">
                <input type="email" class="form-control textbox" placeholder="YOUR EMAIL ADDRESS" required name="username" id="username" value="" autocomplete="off">
              </div>
              <div class="form-group submit">
                <input value="Submit" name="btnForget" id="btnForget" type="submit" class="btn">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>