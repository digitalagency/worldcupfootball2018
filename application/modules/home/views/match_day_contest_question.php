<?php
$match_id = $this->uri->segment(2);
$now = date('Y-m-d H:i:s');
$match_date = $this->home_model->get_match_date_by_match_id($match_id);
//echo $match_date;
$left_hours = $this->home_model->dateDiff($now, $match_date);
//echo $left_hours;
if($left_hours>24)
  redirect(base_url() . 'dashboard');
?>

<div id="opt">
  <div class="container">
    <div class="wrap">
      <div class="up one">
        <h1>MATCH DAY CONTEST</h1>
      </div>      
      <?php
      $action = base_url() . 'match-day-contest-question/'.$this->uri->segment(2);
      $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
      echo form_open_multipart($action, $attributes);
      ?>
      <div class="down">
        <div class="head">
          <h2>GROUP STAGE</h2>
        </div>
        <div class="cont">
          <div class="q-wrap">
            <?php
            $isAnswered = $this->home_model->check_if_already_answered($match_id);
            $i = 1;
            if (!empty($question_info)) { 
              $counter=0;
              foreach ($question_info as $row):
              //print_r($row);
              //echo $key->ordering;
                ++$counter;
              //echo $isAnswered;
              if($isAnswered==1)
                $answer = $this->home_model->get_user_answer_by_question_id($row->id);
              else
                $answer = '';
              //echo $answer;
            ?>
            <div class="q">
              <p><?php echo $counter;?>. <?php echo $row->question; ?><input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>"></p>
              <?php
              if($row->question_number=="1")
              {
              ?>
              <label class="radio-inline">
                <input type="radio" <?php if($counter == 3){?>onclick="handleClick(this);"<?php }?> name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_1;?>" <?php if($match_info['0']->team_1==$answer) echo 'checked="checked"';?>>
                <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?>
              </label>
              <label class="radio-inline">
                <input type="radio" <?php if($counter == 3){?>onclick="handleClick(this);"<?php }?> name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_2;?>" <?php if($match_info['0']->team_2==$answer) echo 'checked="checked"';?>>
                <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
              </label>
                <label class="radio-inline">
                  <input type="radio"  name="answer_<?php echo $counter;?>" value="0" <?php if($match_info['0']->team_2==$answer) echo 'checked="checked"';?>>
                  Draw
                </label>
              <?php
              }
              if($row->question_number=="3")
              {
              ?>
              <label class="radio-inline">
                <input type="radio" <?php if($counter == 3){?>onclick="handleClick(this);"<?php }?> name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_1;?>" <?php if($match_info['0']->team_1==$answer) echo 'checked="checked"';?>>
                <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?>
              </label>
              <label class="radio-inline">
                <input type="radio" <?php if($counter == 3){?>onclick="handleClick(this);"<?php }?> name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_2;?>" <?php if($match_info['0']->team_2==$answer) echo 'checked="checked"';?>>
                <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
              </label>
                <label class="radio-inline">
                  <input type="radio"  name="answer_<?php echo $counter;?>" value="0" <?php if($match_info['0']->team_2==$answer) echo 'checked="checked"';?>>
                  None
                </label>
              <?php
              }
              if($row->question_number=="2")
              {
                if(!empty($answer))
                  $aa = explode('-',$answer);
                else
                  $aa = array('','');
                ?>
                <label class="radio-inline">
                  <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?>
                  <input type="number" min="0" name="answer1_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $aa['0']; ?>"> 
                </label>
                <label class="radio-inline">
                  <input type="number" min="0" name="answer2_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $aa['1']; ?>"> 
                  <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
                </label>
                
                <?php
              }
              if($row->question_number=="4")
              {
              ?>
              <select class="form-control firstteamplayer"  name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>">
                <option value="">Select Answer</option>
                <option value="0">None</option>
                <option disabled class="countrydisable"><?php echo $this->home_model->get_country_name($match_info['0']->team_1);?></option>
                  <?php 
                  $players = $this->home_model->get_all_players($match_info['0']->team_1);
                  foreach($players as $player){?>
                  <option value="<?php echo $player->id;?>" <?php if($answer==$player->id) echo 'selected="selected"';?>>-&nbsp;<?php echo $player->player_name;?></option>
                  <?php 
                  }
                  ?>
                <option disabled class="countrydisable"><?php echo $this->home_model->get_country_name($match_info['0']->team_2);?></option>
                  <?php 
                  $players = $this->home_model->get_all_players($match_info['0']->team_2);
                  foreach($players as $player){?>
                  <option value="<?php echo $player->id;?>" <?php if($answer==$player->id) echo 'selected="selected"';?>>-&nbsp;<?php echo $player->player_name;?></option>
                  <?php 
                  }
                  ?>
              </select>
              <?php
              }
              ?>              
            </div>
            <?php
            $i++;
            endforeach;
            }
            ?>
            <?php 
            $matchdatetime = $match_info[0]->match_date;
            $dt = new DateTime($matchdatetime);
            $date = $dt->format('Y-m-d');

            $today = strtotime(date("Y-m-d"));
            $date    = strtotime($date);

            $datediff = $date - $today;
            $difference = floor($datediff/(60*60*24));
            if($difference < 0 && $this->home_model->check_if_already_answered($match_id)==0){
              $disable =  'disabled';
              echo '<label class="radio-inline">This question deadline is over.</label>';
            }
            else{
              $disable = '';
            }
            if($this->home_model->check_if_already_answered($match_id)>0){?>
            <label class="radio-inline">You have already answered to these match questions. &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'dashboard';?>">Go to Home</a></label>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if($this->home_model->check_if_already_answered($match_id)==0 && $difference > 0){?>
      <button name="btnSubmit" class="btn btn-default submit" <?php echo $disable;?> type="submit">Submit</button>
      <?php } ?>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>