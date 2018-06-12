<?php
$this->home_model->checkLoggedIn();
$user_id = $this->session->userdata('user_id');
$user_info = $this->home_model->getUser($user_id);
$your_score = $this->home_model->calculateUserScore();
?>
<div id="user-bar">
    <div class="container">
        <div class="left">
            <p>Your Score: <span><?php if($your_score>0) echo $your_score; else echo 0;?></span></p>
            <a href="#">Click to See Scoreboard</a>
        </div>
        <div class="right">
            <div class="wrap">
                <img src="<?php echo base_url().$user_info['0']->imagepath;?>" alt="..." class="img-circle" width="100%">
                <p><?php echo $this->session->userdata('username');?></p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>