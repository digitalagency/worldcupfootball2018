<?php
$question_id = $this->uri->segment(2);
$now = date('Y-m-d H:i:s');
$question_date = $this->home_model->get_question_date_by_question_id($question_id);
$left_hours = $this->home_model->dateDiff($now, $question_date);
if($left_hours>24)
  redirect(base_url() . 'dashboard');
?>

<div id="opt">
  <div class="container">            
    <?php
    $action = base_url() . 'all-time-contest-question/'.$this->uri->segment(2);
    $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
    echo form_open_multipart($action, $attributes);
    ?>
    <div class="wrap">
      <div class="uppd">
          <h1>TEST YOUR FOOTBALL KNOWLEDGE</h1>
      </div>
      <div class="down">
        <div class="cont">
          <div class="q-wrap">                            
            <?php
            $i = 1;
            if (!empty($question_info)) {
            $counter=0;
            foreach ($question_info as $row):
            //print_r($row);
            //echo $key->ordering;
            ++$counter;
            $answer = $this->home_model->get_user_answer_by_question_id($row->id);
            ?>
            <div class="q">
              <p><?php echo $counter;?>. <?php echo $row->question; ?><input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>"></p>
              <label class="radio-inline">
                <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_1;?>" <?php if($row->option_1>0 && $answer==$row->option_1) echo 'checked="checked"';?>> <?php echo $row->option_1;?>
              </label>
              <label class="radio-inline">
                <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_2;?>" <?php if($row->option_2>0 && $answer==$row->option_2) echo 'checked="checked"';?>> <?php echo $row->option_2;?>
              </label>
              <label class="radio-inline">
                <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_3;?>" <?php if($row->option_3>0 && $answer==$row->option_3) echo 'checked="checked"';?>> <?php echo $row->option_3;?>
              </label>
            </div>
            <?php
            $i++;
            endforeach;
            }
            ?> 
            <?php if($this->home_model->check_if_already_answered_by_question_id($question_id)>0){?>
            <label class="radio-inline">You have already answered to these questions.</label>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php
      if($this->home_model->check_if_already_answered_by_question_id($question_id)==0){?>
      <button name="btnSubmit" class="btn btn-default submit" type="submit">SUBMIT</button>
      <?php } ?>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>