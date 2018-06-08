<?php 
if (!session_id()) {
    session_start();
}

/* Facebook Login Check starts here */
require_once('Facebook/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '777817859093252',
  'app_secret' => '23836e45f1df7d0fc46dac74edab86a9',
  'default_graph_version' => 'v2.11',
]);
/*$fb = new Facebook\Facebook([
  'app_id' => '119245252069925',
  'app_secret' => 'bcfb628056d58163b761635f999d26ab',
  'default_graph_version' => 'v2.10',
  ]);*/


if(isset($_GET['state']))
{
  $helper = $fb->getRedirectLoginHelper();
  $_SESSION['FBRLH_state']=$_GET['state'];
  
    $accessToken = $helper->getAccessToken();
    //echo "accessToken = ".$accessToken;
    $response = $fb->get('/me?fields=id,name,email,gender', $accessToken);
    $user = $response->getGraphUser();
    //echo 'User Details:<br><br> '; print_r($user);//['name'];
    //echo $fb_name = $user['name'];
}
else
{
  $helper = $fb->getRedirectLoginHelper();
  $permissions = ['email']; // Optional permissions
  $loginUrl = $helper->getLoginUrl('https://rangmagical.bergernepal.com/photo-upload', $permissions);
}

/* Facebook Login Check ends here */
?>
<script src="<?php echo base_url();?>content_home/js/jquery-min-1.11.1.js"></script>

<!-- prettyPhoto starts here -->
<link rel="stylesheet" href="<?php echo base_url();?>content_home/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo base_url();?>content_home/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<style type="text/css">      
a.pp_previous, a.pp_next, pp_arrow_previous, pp_arrow_next, .pp_nav, .pp_description, .pp_gallery, .pp_expand{
display: none !important;
}
</style>
<!-- prettyPhoto ends here -->
<script type="text/javascript">
$(document).ready(function() {
  var container = document.getElementsByClassName("file-controls")[0];
  container.onkeyup = function (e) {
    var target = e.srcElement;
    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;
    if (myLength >= maxLength) {
      var next = target;
      while (next = next.nextElementSibling) {
        if (next == null)
          break;
        if (next.tagName.toLowerCase() == "input") {
          next.focus();
          break;
        }
      }
    }
  }

  var wrapper = $(".container");
  $("#addButton").click(function(e){ //on add input button click
    e.preventDefault();
    $(wrapper).append('<div class="col-md-3"><div class="form-group"><input name="couponumber[]" id="couponumber[]" type="text" class="form-control" placeholder=""maxlength="10" ></div></div>');
  });
});
</script>

<script>
function showSubregion(region_id)
{
	$.get( "home/showSubregion/"+region_id, { region_id: region_id } )
	.done(function( data ) {
	$("#div_address").html(data);
	});
}

function showPatterns(shade)
{        
	if(shade=="metalica")
	{	  
    $(".pattern").prop('checked', false);
    $(".pattern").attr("checked", false);
    $("#nonmetalica").hide();
	  $("#metalica").fadeIn();
      //$("#pattern39").prop('checked', false);
      //$("#pattern1").prop('checked', 'checked');
  }
  else
  {      
    $(".pattern").prop('checked', false);
    $(".pattern").attr("checked", false);
    $("#metalica").hide();    
    $("#nonmetalica").fadeIn();
    //$("#pattern1").prop('checked', false);
    //$("#pattern39").prop('checked', 'checked');
  }
}
</script>
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
              <?php if(!isset($_GET['state'])){?>
              <div class="form-group">
                <label>You need to authenticate with Facebook to submit this registration form.<br>Please <a href="<?php echo $loginUrl;?>" style="color: #FFFFFF; text-decoration: underline;">click here</a> to Authenticate before filling up the form.</label>
              </div>
              <?php } ?>
              <div class="form-group">
                <label>Customers Name :</label>
                <input type="text" class="form-control" placeholder="" required name="fname" id="fname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname'];?>">
              </div>
              <div class="form-group">
                <label>Regd. No. :</label>
                <input type="text" class="form-control" placeholder="" required name="regno" id="regno" value="<?php if(isset($_POST['regno'])) echo $_POST['regno'];?>" maxlength="16" style="text-transform:uppercase">
              </div>
              <div class="form-group">
                <label>Passcode </label>
                <input type="password" class="form-control" placeholder="" required name="passcode" id="passcode" value="<?php if(isset($_POST['passcode'])) echo $_POST['passcode'];?>">
              </div>
            </div>
          </div>
          <div class="contact-field clearfix">
            <input type="hidden" name="id" value="[[+id]]">
            <div class="col-sm-12">
              <label>Coupon No. :</label>
            </div>
            <div class="file-controls">
              <div class="container">
                <?php for($i=0;$i<12;$i++){?>
                <div class="col-md-3">
                  <div class="form-group">
                    <input name="couponumber[]" id="couponumber[]" type="text" class="form-control" placeholder=""maxlength="10" value="<?php if(isset($_POST['couponumber'][$i])) echo $_POST['couponumber'][$i];?>" >
                  </div>
                </div>
                <?php } ?>
              </div>
              <div class="entry col-sm-3">
                <div class="input-group">
                  <div class="input-group-btn" style="float:right;">
                    <button class="btn btn-success btn-add" type="button"id='addButton'><span class="glyphicon glyphicon-plus"></span></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="radial-rorm clearfix">
            <div class="col-md-12 col-sm-12"> <span>Illusion Shade:</span>
              <?php
                $metallica_checked='checked="checked"';
                $nonmetallica_checked='';
                $metallica_show ='';
                $nonmetallica_show ='style="display:none;"';
                if(isset($_POST['shade']) && $_POST['shade']=="Non- Metallica")
                {
                  $metallica_checked="";
                  $nonmetallica_checked='checked="checked"';
                  $metallica_show ='style="display:none;"';
                  $nonmetallica_show ='';
                }
              ?>
              <div class="form-group no-margin">
                <input class="textbox" name="shade" id="shade" value="Metallica" type="radio" <?php echo $metallica_checked;?> onChange="showPatterns('metalica')">
                <label>Metalica</label>
              </div>
              <div class="form-group">
                <input class="textbox" name="shade" id="shade" value="Non- Metallica" type="radio" <?php echo $nonmetallica_checked;?> onChange="showPatterns('nonmetalica')">
                <label>Non- Metallica</label>
              </div>
              <div class="pattern">
                <div class="row" id="metalica" <?php echo $metallica_show;?>>
                <?php
                $counter=1;
                $dir = base_url()."content_home/images/metallica/";
                foreach($metallica as $key=>$value){
                $file = $value->pattern;
                $color = str_replace(".jpg","",$file);
                $colorname = str_replace(".jpg","",$file);
                $colorname = str_replace("Metalica ","",$colorname);
                $colorname = str_replace("Metallica ","",$colorname);
                $colorname = str_replace("_"," ",$colorname);
                ?>
                  <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="form-group">
                      <input type="radio" required class="textbox pattern" name="pattern" id="pattern<?php echo $counter;?>" value="<?php echo $file;?>"  <?php if(isset($_POST['pattern']) && $_POST['pattern']==$file) echo 'checked="checked"';?>>
                      <figure> <a href="<?php echo $dir.'large/'.$file;?>" rel="prettyPhoto[pp_gal]" title="<?php echo $colorname;?>"><img src="<?php echo $dir.$file;?>" title="<?php echo $colorname;?>" alt="<?php echo $colorname;?>"></a> </figure>
                    </div>
                  </div>
                  <?php
                  ++$counter;
                }
                ?>
                </div>
                <div class="row" id="nonmetalica"  <?php echo $nonmetallica_show;?>>
                  <?php
                    $counter=1;
                    $dir = base_url()."content_home/images/nonmetallica/";
                    foreach($nonmetallica as $key=>$value){
                    $file = $value->pattern;$color = str_replace(".jpg","",$file);
                    $colorname = str_replace(".jpg","",$file);
                    $colorname = str_replace("Metalica ","",$colorname);
                    $colorname = str_replace("Metallica ","",$colorname);
                    $colorname = str_replace("_"," ",$colorname);

                    ?>
                  <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="form-group">
                      <input required class="textbox pattern" name="pattern" id="pattern<?php echo $counter;?>" value="<?php echo $file;?>" <?php if(isset($_POST['pattern']) && $_POST['pattern']==$file) echo 'checked="checked"';?> type="radio">
                      <figure> <a href="<?php echo $dir.'large/'.$file;?>" rel="prettyPhoto[pp_gal]" title="<?php echo $colorname;?>"><img src="<?php echo $dir.$file;?>" title="<?php echo $colorname;?>" alt="<?php echo $colorname;?>"></a> </figure>
                    </div>
                  </div>
                  <?php
                     ++$counter;
                   }
                     ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="reg-form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Main Region :</label>
                <input type="text" class="form-control" name="main_region" id="main_region" placeholder="" required readonly value="<?php if(isset($_POST['main_region'])) echo $_POST['main_region'];?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Sub Region :</label>
                <div id="div_address">
                  <select name="sub_region" id="sub_region" class="form-control">
                    <option value="">Select sub region</option>
                    <?php
                    if(isset($_POST['main_region']))
                    {                    	
                      $subregion = $this->home_model->getSubregions_by_main_region($_POST['main_region']);
                      foreach($subregion as $key2=>$value2)
                      {
                      ?>
                        <option value="<?php echo $value2->region;?>" <?php if(isset($_POST['sub_region']) && $_POST['sub_region']==$value2->region) echo 'selected="selected"';?>><?php echo $value2->region;?></option>
                      <?php
                      }
                	}
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Your home Photo :</label>
                <input name="houseimage" id="houseimage" type="file" required style="color: #FFFFFF;"><br>
                <label><strong>Note : </strong>Image resolution must be 730px X 500px for the best view.</label>
              </div>
              <div class="form-group submit" style="margin-bottom: -7px;">
                  <input value="<?php if(isset($user['id'])) echo 'https://www.facebook.com/'.$user['id'];?>" name="facebook_id" id="facebook_id" type="hidden">
                  <input value="<?php if(isset($user['name'])) echo $user['name'];?>" name="facebook_name" id="facebook_name" type="hidden">
                  <input value="<?php if(isset($user['email'])) echo $user['email'];?>" name="facebook_email" id="facebook_email" type="hidden">
                  <input value="Register" name="btnsubmit" id="btnsubmit" type="submit">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
$("#regno").on("blur", function () {
regno = $(this).val();
regno = regno.toUpperCase();
//console.log(regno.indexOf('BRMG-K'));

if (regno.indexOf('BRMG-K') > -1)
{
  $("#main_region").val( "Kathmandu" );
  showSubregion('Kathmandu');
}
else if (regno.indexOf('BRMG-P') > -1)
{
  $("#main_region").val("Pokhara");
  showSubregion('Pokhara');
}
else if (regno.indexOf('BRMG-E') > -1 )
{
  $("#main_region").val("Eastern");
  showSubregion('Eastern');
}     
else if(regno.indexOf('BRMG-COM') > -1 )
{
    $("#main_region").val("Commercial");
    //showSubregion('Western');
}
else if (regno.indexOf('BRMG-C') > -1 )
{
  $("#main_region").val("Central");  
  showSubregion('Central');
}      
else if( regno.indexOf('BRMG-W') > -1 )
{
  $("#main_region").val("Western");
  showSubregion('Western');
}
else
{
  $("#main_region").html("");
}

});
</script>

<a href="#" class="scrollToTop" title="Scroll Back To Top"><i class="fa fa-angle-up"></i></a>
<!-- jQuery -->
<!-- <script src="js/jquery-1.10.1.min.js"></script> -->
<script src="<?php echo base_url();?>content_home/js/main.js"></script>       
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
$.noConflict();
  $("a[rel^='prettyPhoto']").prettyPhoto({
    animation_speed: 'normal', /* fast/slow/normal */
    opacity: 0.80, /* Value between 0 and 1 */
    show_title: true, /* true/false */
    allow_resize: true, /* true/false */
    default_width: 500,
    default_height: 500,
    theme: 'facebook', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
    horizontal_padding: 20, /* The padding on each side of the picture */
    modal: false, /* If set to true, only the close button will close the window */
    deeplinking: false, /* Allow prettyPhoto to update the url to enable deeplinking. */
    ie6_fallback: true,
    social_tools:false
  });
});
</script> 