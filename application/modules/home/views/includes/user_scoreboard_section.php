<?php
$this->home_model->checkLoggedIn();
$user_id = $this->session->userdata('user_id');
$user_info = $this->home_model->getUser($user_id);
?>
<div class="col-md-6 user_score">
    Your Score : 100<br>
    Click to see the Scoreboard
  </div>
  <div class="col-md-6  user_image">
    <img src="<?php echo base_url().$user_info['0']->imagepath;?>">
    <p><?php echo $this->session->userdata('username');?></p>
  </div>