<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel">
  <div class="col-md-12">
    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
    <div>
      <?php
      foreach($question_info as $question)
      {
        ?>
      <div class="row">
        <div class="col-md-2"><?php echo substr($question->datetime,0,10);?>
        </div>
        <div class="col-md-8"> </div>
        <div class="col-md-2"><a href="<?php echo base_url();?>all-time-contest-question/<?php echo $question->id;?>">Click to Play</a>
        </div>
      </div>
      <?php
    }
    ?>
    <div>
  </div>
</div>