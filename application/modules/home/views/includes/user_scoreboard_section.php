<?php
$this->home_model->checkLoggedIn();
$user_id = $this->session->userdata('contestant_id');
$user_info = $this->home_model->getUser($user_id);
$your_score = $this->home_model->calculateUserScore();
$gender = $this->home_model->getGender($user_id);
if($gender=="male")
    $gender_img="male.png";
elseif($gender=="female")
    $gender_img="female.png";
$page = $this->uri->segment(1);
if($page!="terms-and-conditions" && $page!="privacy-policy" && $page!="thank-you" && $page!="")
{
?>
<div id="user-bar">
    <div class="container">
        <div class="left">
            <a href="<?php echo base_url();?>dashboard"><img src="<?php echo base_url();?>content_home/images/home.png" title="Go to Home"></a>
            <p>Your Score: <span><?php if($your_score>0) echo $your_score; else echo 0;?></span></p>
            <a href="<?php echo base_url();?>scoreboard">Click to See Scoreboard</a>
            <p><a href="<?php echo base_url();?>leaderboard">Click to See Leaderboard</a></p>
        </div>
        <div class="right">
            <div class="wrap text-center">
                <?php if(file_exists($user_info['0']->imagepath)){?>
                <img src="<?php echo base_url().$user_info['0']->imagepath;?>" alt="..." class="img-circle" width="50">
                <?php } else { 

                ?>
                <img src="<?php echo base_url().'content_home/images/'.$gender_img;?>" alt="..." class="img-circle" width="50">
                <?php } ?>
                <p><?php echo $user_info['0']->fname;?> <a href="<?php echo base_url();?>log-out"><img src="<?php echo base_url();?>content_home/images/logout.png"></a></p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php
}
?>