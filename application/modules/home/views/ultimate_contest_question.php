<div class="row mainpanel listing">

    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
  
        <div class="col-md-12 question_listing_section">
          <div class="table-responsive">  
            <?php
            $action = base_url() . 'ultimate-contest-question/';
            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
            echo form_open_multipart($action, $attributes);
            ?>
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <tbody>
                <?php
                $i = 1;
                $answer='';
                if (!empty($question_info)) { 
                  $counter=0;
                  foreach ($question_info as $row):
                  //print_r($row);
                  //echo $key->ordering;
                    ++$counter;
                    $answer = $this->home_model->get_user_answer_by_question_id($row->id);
                    ?>
                  <tr>
                    <td><?php echo $row->question; ?><input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>"></td>
                  </tr>
                  <tr>
                    <td>                     
                    <?php
                    if($row->question_number=="1")
                    {
                    ?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_1;?>" <?php if($answer==$match_info['0']->team_1) echo 'selected="selected"';?>> <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_2;?>" <?php if($answer==$match_info['0']->team_2) echo 'selected="selected"';?>> <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
                    <?php
                    }
                    if($row->question_number=="2")
                    {
                      $answer_1 = '';
                      $answer_2 = '';
                      if(!empty($answer))
                      {
                        $aa = explode(',',$answer);
                        $answer_1 = $aa['0'];
                        $answer_2 = $aa['1'];
                      }
                      ?>                                            
                      <select class="form-control selectbox" name="answer1_<?php echo $counter;?>" id="answer1_<?php echo $counter;?>[]" required  style="background:#1c1c1c; width:40%; color:#FFFFFF; float:left;">
                        <option value="" >Select Country</option>
                        <?php foreach($countries as $country){?>                
                        <option value="<?php echo $country->id;?>" <?php if($answer_1==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                        <?php } ?>
                      </select>                                            
                      <select class="form-control" name="answer2_<?php echo $counter;?>" id="answer2_<?php echo $counter;?>[]" required style="background:#1c1c1c; width:40%; color:#FFFFFF; float:left; margin-left:20px;">
                        <option value="">Select Country</option>
                        <?php foreach($countries as $country){?>                
                        <option value="<?php echo $country->id;?>" <?php if($answer_2==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                        <?php } ?>
                      </select>
                      <?php
                    }
                    if($row->question_number=="3")
                    {
                    ?>
                      <input type="text" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $answer; ?>" placeholder="0-0" style="background:#1c1c1c; width:40%; color:#FFFFFF;">
                    <?php
                    }
                    if($row->question_number=="4")
                    {
                    ?>
                      <select class="form-control" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" required style="background:#1c1c1c; width:40%; color:#FFFFFF;">
                        <option value="">Select a Player</option>
                        <?php foreach($countries as $country){?>                
                        <option value="" disabled><?php echo $country->country_name;?></option>
                        <?php 
                        $players = $this->home_model->get_all_players($country->id);
                        foreach($players as $player){?>
                        <option value="<?php echo $player->id;?>" <?php if($answer==$player->id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $player->player_name;?></option>
                        <?php }
                        } ?>
                      </select>
                    <?php
                    }
                    ?>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                  ?>                  
                  <tr>
                    <td><?php if(empty($answer)){?><button class="btn btn-success btn-flat" type="submit" name="btnSubmit">Submit</button><?php } else echo "You have already answered these questions."; ?></td>
                  </tr>
                  <?php
                }
                ?>
                </tbody>
              </table>              
              <?php echo form_close(); ?>
            </div><!-- table-responsive -->
           <?php echo $this->pagination->create_links();?>
          </div><!-- col-md-6 -->
</div>