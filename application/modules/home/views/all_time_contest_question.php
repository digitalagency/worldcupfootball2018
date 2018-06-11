<?php
$question_id = $this->uri->segment(2);
$now = date('Y-m-d H:i:s');
$question_date = $this->home_model->get_question_date_by_question_id($question_id);
$left_hours = $this->home_model->dateDiff($now, $question_date);
if($left_hours>24)
  redirect(base_url() . 'dashboard');
?>
<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel listing">

    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
  <div class="col-md-12 question_listing_section">
          <div class="table-responsive">  
            <?php
            $action = base_url() . 'all-time-contest-question/'.$this->uri->segment(2);
            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
            echo form_open_multipart($action, $attributes);
            ?>
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <tbody>
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
                  <tr>
                    <td><?php echo $row->question; ?><input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>"></td>
                  </tr>
                  <tr>
                    <td>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_1;?>" <?php if($answer==$row->option_1) echo 'checked="checked"';?>> <?php echo $row->option_1;?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_2;?>" <?php if($answer==$row->option_2) echo 'checked="checked"';?>> <?php echo $row->option_2;?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_3;?>" <?php if($answer==$row->option_3) echo 'checked="checked"';?>> <?php echo $row->option_3;?>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                  ?>                  
                  <tr>
                    <td>
                      <?php
                      if($this->home_model->check_if_already_answered_by_question_id($question_id)==0){?>
                      <button name="btnSubmit" class="btn btn-success btn-flat" type="submit">Submit</button>
                      <?php } else{
                        echo "You have already answered to these match questions.";
                      }
                      ?>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>              
              <?php echo form_close(); ?>
            </div><!-- table-responsive -->
          </div>
        </div>
</div>