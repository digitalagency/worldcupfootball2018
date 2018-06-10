<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel">
  <div class="col-md-4 circle_container center-block text-center">
    <img src="<?php echo base_url();?>content_home/images/match_day_contest.png">
    <a href="">How to play the contest ?</a><br>
    <a class="btn_match" href="<?php echo base_url().'match-day-contest';?>">Click to Play</button>
  </div>
  <div class="col-md-4 circle_container text-center">
    <img src="<?php echo base_url();?>content_home/images/the_ultimate_contest.png">
    <a href="">How to play the contest ?</a><br>
    <a class="btn_ultimate" href="<?php echo base_url().'ultimate-contest-question';?>">Click to Play</a>
  </div>
  <div class="col-md-4 circle_container text-center">
    <img src="<?php echo base_url();?>content_home/images/all_time_contest.png">
    <a href="">How to play the contest ?</a><br>
    <a class="btn_all" href="<?php echo base_url().'all-time-contest';?>">Click to Play</a>
  </div>
</div>