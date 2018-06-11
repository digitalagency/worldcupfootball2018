<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel listing">
  <div class="col-md-12">
    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
    <div class="listing_section">
      <?php
      foreach($question_info as $question)
      {
        $now = date('Y-m-d H:i:s');
        $match_date = $question->datetime;

        $left_hours = $this->home_model->dateDiff($now, $match_date);
        ?>
      <div class="row">
        <div class="col-md-8"><p><?php echo date( "F d", strtotime( $question->datetime ) );?></p></div>
        <div class="col-md-4">          
          <?php if($left_hours>0 && $left_hours<=24){?>
          <a href="<?php echo base_url();?>all-time-contest-question/<?php echo $question->id;?>">Click to Play</a>
          <?php } ?>
        </div>
      </div>
      <?php
    }
    ?>
    <div>
  </div>
</div>