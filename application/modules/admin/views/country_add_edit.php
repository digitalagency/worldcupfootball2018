<?php
if (!empty($country_detail)) {
    $action = base_url() . 'admin/Country/editCountry/' . $country_detail->id;
} else {
    $action = base_url() . 'admin/Country/addCountry';
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($country_detail)) { echo "Edit Country"; } else { echo "Add Country"; } ?>
          </h1>
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
                <input type="text" required name="country_name" id='country_name' class="form-control" value='<?php if (!empty($country_detail)) echo $country_detail->country_name; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($country_detail)) {
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

