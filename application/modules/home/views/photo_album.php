<?php 
/*print_r($this->session->all_userdata());
print_r($user_info);*/
?>
<div class="user_section">
  <div class="col-md-6 user_score">
    Your Score : 100<br>
    Click to see the Scoreboard
  </div>
  <div class="col-md-6  user_image">
    <img src="<?php echo base_url().$user_info['0']->imagepath;?>">
    <p><?php echo $this->session->userdata('username');?></p>
  </div>
</div>
<div class="row mainpanel">
  <div class="col-md-4 circle_container center-block text-center">
    <img src="<?php echo base_url();?>content_home/images/match_day_contest.png">
    <a href="">How to play the contest ?</a><br>
    <button class="btn_match">Click to Play</button>
  </div>
  <div class="col-md-4 circle_container text-center">
    <img src="<?php echo base_url();?>content_home/images/the_ultimate_contest.png">
    <a href="">How to play the contest ?</a><br>
    <button class="btn_ultimate">Click to Play</button>
  </div>
  <div class="col-md-4 circle_container text-center">
    <img src="<?php echo base_url();?>content_home/images/all_time_contest.png">
    <a href="">How to play the contest ?</a><br>
    <button class="btn_all">Click to Play</button>
  </div>
</div>