<?php $this->load->view('includes/user_scoreboard_section'); ?>
<div class="circle-line">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="wrap">
          <img src="<?php echo base_url();?>content_home/images/con-cir1.png" alt="">
          <div class="low">
            <a href="#">How to play the contest</a><br>
            <button type="button" class="btn btn-default one" onclick="window.location='<?php echo base_url().'match-day-contest';?>'">Click to Play</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="wrap">
          <img src="<?php echo base_url();?>content_home/images/con-cir2.png" alt="">
          <div class="low">
            <a href="#">How to play the contest</a><br>
            <button type="button" class="btn btn-default two" onclick="window.location='<?php echo base_url().'ultimate-contest-question';?>'">Click to Play</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="wrap">
          <img src="<?php echo base_url();?>content_home/images/con-cir3.png" alt="">
          <div class="low">
            <a href="#">How to play the contest</a><br>
            <button type="button" class="btn btn-default three" onclick="window.location='<?php echo base_url().'all-time-contest';?>'">Click to Play</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>