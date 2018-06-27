<div id="opt">
  <div class="container">
    <div class="wrap">
      <div class="up one">
          <h1>MATCH DAY CONTEST</h1>
      </div>
      <div class="down">
        <div class="head" onclick="showhide('group_stage');">
            <h2>GROUP STAGE</h2>
        </div>
        <div class="cont" id="group_stage" style="display:none;">
          <div class="i-wrap">
          <?php
          foreach($question_info as $question)
          {
            if($question->team_1>0 && $question->team_2>0){
            $now = date('Y-m-d H:i:s');
            $match_date = $question->match_date;
            $left_hours = $this->home_model->dateDiff($now, $match_date);
            $title='';
            if($this->home_model->check_if_already_answered($question->id)>0){
              $title ="You have already answered this question.";
            }
            ?>
            <div class="op">
              <span class="date"><?php echo date( "F d H:i", strtotime( $question->match_date ) );?></span>
              <span class="off"><?php echo $this->home_model->get_country_name($question->team_1);?> Vs <?php echo $this->home_model->get_country_name($question->team_2);?>
                <?php echo '<div style="display:none;">match date='.$match_date.' -- Left hours : '.$left_hours.' -- isAnswered = '.$this->home_model->check_if_already_answered($question->id).'</div>';?>
              </span>
              <?php if($left_hours<24){?>
                <a class="click" href="<?php echo base_url();?>match-day-contest-question/<?php echo $question->id;?>" title="<?php echo $title;?>">Click to Play</a>
              <?php } ?>
            </div>
            <?php
            }
          }
          ?>
          </div>
        </div>
      </div>

      <div class="down">
        <div class="head" onclick="showhide('round_of_16');">
            <h2>ROUND OF 16</h2>
        </div>
        <div class="cont" id="round_of_16">
          <div class="i-wrap">
          <?php
          foreach($round_of_16 as $question)
          {
            $now = date('Y-m-d H:i:s');
            $match_date = $question->match_date;
            $left_hours = $this->home_model->dateDiff($now, $match_date);
            $title='';
            if($this->home_model->check_if_already_answered($question->id)>0){
              $title ="You have already answered this question.";
            }
            ?>
            <div class="op">
              <span class="date"><?php echo date( "F d H:i", strtotime( $question->match_date ) );?></span>
              <span class="off"><?php echo $this->home_model->get_country_name($question->team_1);?> Vs <?php echo $this->home_model->get_country_name($question->team_2);?>
                <?php echo '<div style="display:none;">match date='.$match_date.' -- Left hours : '.$left_hours.' -- isAnswered = '.$this->home_model->check_if_already_answered($question->id).'</div>';?>
              </span>
              <?php if($left_hours<24){?>
                <a class="click" href="<?php echo base_url();?>match-day-contest-question/<?php echo $question->id;?>" title="<?php echo $title;?>">Click to Play</a>
              <?php } ?>
            </div>
            <?php
          }
          ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>