<?php
//print_r($question_detail);
if (!empty($question_detail)) {
    $action = base_url() . 'admin/Question/editQuestionProcess/3/' . $question_detail->id;
} else {
    $action = base_url() . 'admin/Question/addQuestionProcess/3';
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1 class="col-sm-7">
            <?php if (!empty($question_detail)) { echo "Edit Question"; } else { echo "Add Question"; } ?>
          </h1>
          <div class="col-sm-5">
            <a class="btn btn-success" style="float:right;" href="<?php echo base_url().'admin/Question/AllTimeContest/'; ?>"><i class="fa fa-list" data-original-title="View Basket"></i> List All Questions </a>
          </div>

        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class=" form-group">
            <div class="col-sm-12">
                <label class="col-sm-12">Question Date :<span class="asterisk">*</span></label>
                <input type="text" class="form-control question_date" name="question_date" id="datepicker" value="<?php if (!empty($question_detail)) echo $question_detail->datetime; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-12">Question :<span class="asterisk">*</span></label>
                <input type="text" required name="question" id='question' class="form-control" value='<?php if (!empty($question_detail)) echo $question_detail->question; ?>' />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="col-sm-12">Correct Answer :<span class="asterisk">*</span></label>
                <input type="text" required name="answer" id='answer' class="form-control" value='<?php if (!empty($question_detail)) echo $question_detail->answer; ?>' />
            </div>
        </div>
        <div class="form-group">
            <?php for($i=1;$i<=3;$i++){
                $option = 'option_'.$i;
            ?>
            <div class="col-sm-4">
                <input type="text" required name="option_<?php echo $i;?>" id='option_<?php echo $i;?>' class="form-control" value='<?php if (!empty($question_detail)) echo $question_detail->$option; ?>' placeholder="Option <?php echo $i;?>" />
            </div>
            <?php } ?>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($question_detail)) {
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



<script type="text/javascript">
  $( function() {
    $('.question_date').each(function(){
        $(this).datetimepicker({locale: 'sv'});
        $( "#question_date_" ).datepicker();
        $( "#question_date_" ).datepicker( "option", "showAnim", 'clip' );                 
        $( "#question_date_" ).datepicker( "option", "dateFormat", "yy-mm-dd h:i:s" );
        $( "#question_date_" ).datepicker("setDate", "2018-09-25 16:00:00");
    });
  } );
</script>
