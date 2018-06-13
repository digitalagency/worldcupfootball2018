<div id="opt">
    <div class="container">
        <div class="wrap">
            <div class="uppd">
                <h1>TEST YOUR FOOTBALL KNOWLEDGE</h1>
            </div>
            <div class="down">
                <!--<div class="head">
                    <h2>GROUP STAGE</h2>
                </div>-->
                <div class="cont">
                    <div class="i-wrap">
                      <?php
                      foreach($question_info as $question)
                      {
                        $now = date('Y-m-d H:i:s');
                        $match_date = $question->datetime;

                        $left_hours = $this->home_model->calculateDateDiff($now, $match_date);
                        $title="";
                        if($this->home_model->check_if_already_answered_by_question_id($question->id)>0)
                            $title = "You have already answered to these questions.";
                        ?>
                        <div class="op">
                            <span class="date"><?php echo date( "F d", strtotime( $question->datetime ) );?></span>
                            <span class="off">&nbsp;</span>
                            <?php if($left_hours<0){?>
                              <a href="<?php echo base_url();?>all-time-contest-question/<?php echo $question->id;?>" class="click" title="<?php echo $title;?>">Click to Play</a>
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