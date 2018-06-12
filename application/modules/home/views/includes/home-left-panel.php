<form method="post" role="form"  name="frmt" action="<?php echo base_url();?>registration_process" enctype="multipart/form-data">
  <div class="row float-right">
    <div class="col-md-12 col-sm-12">
      <div class="introform">
        <div class="formsection">
          <div class="form-group title_header_image">
            <p>REGISTER</p>
          </div>
          <div class="row">
            <div class="col-md-12 myform">
              <div class="form-group">
                <input type="text" class="form-control textbox" placeholder="NAME" required name="fname" id="fname" value="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control textbox" placeholder="USERNAME" required name="username" id="username" value="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control textbox" placeholder="EMAIL" required name="emailaddress" id="emailaddress" value="">
              </div>
              <div class="form-group">
                <input type="password" class="form-control textbox" placeholder="CREATE A PASSWORD" required name="userpassword" id="userpassword" value="">
              </div>
              <div class="form-group">
                <input type="password" class="form-control textbox" placeholder="CONFIRM PASSWORD" required name="conf_password" id="conf_password" value="">
              </div>
  	          <div class="form-group">
                <label class="myButton">
                  <input name="yourimage" id="yourimage"  type="file" required/>
                  <span>UPLOAD YOUR IMAGE</span>
                </label>                  
  	          </div>
  	          <div class="form-group submit">
                <input value="<?php if(isset($user['facebook_link'])) echo $user['facebook_link'];?>" name="facebook_link" id="facebook_link" type="hidden">
                <input value="<?php if(isset($user['name'])) echo $user['name'];?>" name="facebook_name" id="facebook_name" type="hidden">
                <input value="<?php if(isset($user['email'])) echo $user['email'];?>" name="facebook_email" id="facebook_email" type="hidden">
                <input value="Submit" name="btnsubmit" id="btnsubmit" type="submit" class="btn">
  	          </div>
  	          <div class="form-group check_box">
  	          	<div class="col-md-1 col-sm-1 no-padding">
                  <input name="i_agree" type="checkbox"> 
                </div>
                <spam>By Clicking on submit, you agree to our terms and condition</span>
  	          </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>