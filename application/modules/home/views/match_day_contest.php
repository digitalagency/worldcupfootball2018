<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel">
  <div class="col-md-12">
    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
    <div style="overflow:hidden; height:250px">
      <?php
      foreach($question_info as $question)
      {
        ?>
      <div class="row">
        <div class="col-md-2"><?php echo $question->match_date;?>
        </div>
        <div class="col-md-8"><?php echo $this->home_model->get_country_name($question->team_1);?> Vs <?php echo $this->home_model->get_country_name($question->team_2);?>
        </div>
        <div class="col-md-2"><a href="<?php echo base_url();?>match-day-contest-question/<?php echo $question->id;?>">Click to Play</a>
        </div>
      </div>
      <?php
    }
    ?>
    <div>
  </div>
</div>