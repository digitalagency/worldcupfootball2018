<?php
if (!empty($player_detail)) {
    $country_id = $player_detail['0']->country_id;
    $action = base_url() . 'admin/Country/editPlayerProcess/' . $player_detail['0']->id.'/'.$country_id;
} else {
    $action = base_url() . 'admin/Country/addPlayerProcess/'.$country_id;
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1 class="col-sm-7">
            <?php if (!empty($player_detail)) { echo "Edit Player"; } else { echo "Add Player"; } ?>
          </h1>
          <div class="col-sm-5">
            <a class="btn btn-success" style="float:right;" href="<?php echo base_url().'admin/Country/listPlayers/'.$country_id; ?>"><i class="fa fa-list" data-original-title="View Basket"></i> List All Players </a>
          </div>

        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Country Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
              <select class="form-control" name="country_id" id="country_id">
                <option value="">Select Country</option>
                <?php foreach($countries as $country){?>                
                <option value="<?php echo $country->id;?>" <?php if($country_id==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                <?php } ?>
              </select>            
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Player Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="player_name" id='player_name' class="form-control" value='<?php if (!empty($player_detail)) echo $player_detail['0']->player_name; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($player_detail)) {
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

