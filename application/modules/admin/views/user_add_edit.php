<?php
if (!empty($user_detail)) {
    $action = base_url() . 'admin/User/editUser/' . $user_detail->id;
} else {
    $action = base_url() . 'admin/User/addUser';
}
?> 

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
<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($user_detail)) { echo "Edit Registration Number"; } else { echo "Add Registration Number"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Registration Number :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="registration_number" id='registration_number' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->registration_number; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Passcode:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="passcode" id='passcode' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->passcode; else echo rand('11111','99999'); ?>' />
            </div>
        </div>
        <?php //if (!empty($user_detail)) {?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Full Name:<!-- <span class="asterisk">*</span> --></label>
            <div class="col-sm-7">
                <input type="text" name="full_name" id='full_name' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->full_name; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Main Region:<!-- <span class="asterisk">*</span> --></label>
            <div class="col-sm-7">                
                <select class="form-control chosen-select" name='main_region' id="main_region" data-placeholder="Choose Main Region" onchange="showSubregion(this.value)">
                    <option value='0'>Main Region</option>
                    <?php foreach ($main_region as $key => $value) {?>
                    <option value='<?php echo $value->region; ?>' <?php if(!empty($user_detail) && $user_detail->main_region == $value->region){ echo "selected='selected'"; } ?>><?php echo $value->region; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sub Region:<!-- <span class="asterisk">*</span> --></label>
            <div class="col-sm-7">                               
                <select class="form-control chosen-select" name='sub_region' id="sub_region" data-placeholder="Choose Sub Region">
                    <option value='0'>Sub Region</option>
                    <?php 
                    if(!empty($user_detail)  && !empty($user_detail->main_region))
                    {
                        //echo "main_region = ".$user_detail->main_region;exit();
                    $parent_id = $user_detail->main_region;
                    $where = array('parent_id'=>$parent_id); 
                    $sub_region = $this->general_model->getAll('tbl_regions',$where);
                    
                    foreach ($sub_region as $key => $value) {?>
                    <option value='<?php echo $value->id; ?>' <?php if(!empty($user_detail) && $user_detail->sub_region == $value->id){ echo "selected='selected'"; } ?>><?php echo $value->region; ?></option>
                    <?php  
                    } 
                    }
                    ?>
                    <?php ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Coupon Number:<!-- <span class="asterisk">*</span> --></label>
            <div class="col-sm-7">
                <input type="text" name="coupon_no" id='coupon_no' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->coupon_no; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Coupon Quantity:<!-- <span class="asterisk">*</span> --></label>
            <div class="col-sm-7">
                <input type="text" name="coupon_qty" id='coupon_qty' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->coupon_qty; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Image:<!-- <span class="asterisk">*</span> --></label>
            <div class="col-sm-7">
                <?php
                if (!empty($user_photo_detail))
                {
                $imagepath = $user_photo_detail->imagepath;
                $imagename = $user_photo_detail->imagename;
                $abs_image = FCPATH.$imagepath.$imagename;
                if(file_exists($abs_image)){
                ?>
                <img src="<?php echo base_url().$imagepath.$imagename;?>" style="max-height:200px; max-width:200px;">
                <?php
                }
                }
                ?>
                <input type="file" name="image" id='image' class="form-control" />
            </div>
        </div>
        <?php //} 
        if (!empty($user_detail)){
        if($user_detail->shade=="Non- Metallica")
          $shade_location = base_url()."content_home/images/nonmetallica/".$user_detail->pattern;
        else
          $shade_location = base_url()."content_home/images/metallica/".$user_detail->pattern;
          
        $pattern = $user_detail->pattern;
        $pattern = str_replace(".jpg","",$pattern);
        $pattern = str_replace(".jpg","",$pattern);
        $pattern = str_replace("Metalica ","",$pattern);
        $pattern = str_replace("Metallica ","",$pattern);
        $pattern = str_replace("_"," ",$pattern);
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Illusion Shade:</label>
            <div class="col-sm-7">                
              <?php
                $metallica_checked='checked="checked"';
                $nonmetallica_checked='';
                $metallica_show ='';
                $nonmetallica_show ='style="display:none;"';
                if($user_detail->shade=="Non- Metallica")
                {
                  $metallica_checked="";
                  $nonmetallica_checked='checked="checked"';
                  $metallica_show ='style="display:none;"';
                  $nonmetallica_show ='';
                }
              ?>
                <?php //echo $user_detail->shade;?>

              
                <input class="textbox" name="shade" id="shade" value="Metallica" type="radio" <?php echo $metallica_checked;?> onChange="showPatterns('metalica')">
                <label>Metalica</label>&nbsp;&nbsp;&nbsp;
                <input class="textbox" name="shade" id="shade" value="Non- Metallica" type="radio" <?php echo $nonmetallica_checked;?> onChange="showPatterns('nonmetalica')">
                <label>Non- Metallica</label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Pattern:</label>
            <div class="col-sm-7">
              
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
                      <figure style="width: 85px; height: 60px;">
                      <input type="radio" required class="textbox pattern" name="pattern" id="pattern<?php echo $counter;?>" value="<?php echo $file;?>"  <?php if($user_detail->pattern==$file) echo 'checked="checked"';?>>
                      <img src="<?php echo $dir.$file;?>" title="<?php echo $colorname;?>" alt="<?php echo $colorname;?>">
                      </figure>
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
                    $file = $value->pattern;
                    $color = str_replace(".jpg","",$file);
                    $colorname = str_replace(".jpg","",$file);
                    $colorname = str_replace("Metalica ","",$colorname);
                    $colorname = str_replace("Metallica ","",$colorname);
                    $colorname = str_replace("_"," ",$colorname);

                    ?>
                  <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="form-group">
                      <figure style="width: 85px; height: 60px;">
                      <input required class="textbox pattern" name="pattern" id="pattern<?php echo $counter;?>" value="<?php echo $file;?>" <?php if($user_detail->pattern==$file) echo 'checked="checked"';?> type="radio">
                      <img src="<?php echo $dir.$file;?>" title="<?php echo $colorname;?>" alt="<?php echo $colorname;?>">
                      </figure>
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
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <input type="hidden" name="medium" id='medium' value='admin' />
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($user_detail)) {
                        echo 'Update';
                    } else {
                        echo 'Add';
                    }
                    ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->


<script>
function showSubregion(region_id)
{
    $.get( "showSubregion/"+region_id, { region_id: region_id } )
    .done(function( data ) {
    $("#sub_region").html(data);
    });
}
</script>