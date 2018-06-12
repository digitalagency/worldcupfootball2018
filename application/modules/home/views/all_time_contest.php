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

                        $left_hours = $this->home_model->dateDiff($now, $match_date);
                        ?>
                        <div class="op">
                            <span class="date"><?php echo date( "F d", strtotime( $question->datetime ) );?></span>
                            <span class="off">&nbsp;</span>
                            <?php if($left_hours>0 && $left_hours<=24){?>
                              <a href="<?php echo base_url();?>all-time-contest-question/<?php echo $question->id;?>" class="click">Click to Play</a>
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