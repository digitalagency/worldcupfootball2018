<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel">

    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
  
        <div class="col-md-12">
          <div class="table-responsive">  
            <?php
            $action = base_url() . 'admin/Question/TheUltimateContest/'.$this->uri->segment(4);
            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
            echo form_open_multipart($action, $attributes);
            ?>
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <tbody>
                <?php
                $i = 1;
                if (!empty($question_info)) { 
                  $counter=0;
                  foreach ($question_info as $row):
                  //print_r($row);
                  //echo $key->ordering;
                    ++$counter;
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

                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_1;?>"> <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_2;?>"> <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
                                          
                     
                      <?php
                    }
                    if($row->question_number=="2")
                    {
                      $answer_1 = '';
                      $answer_2 = '';
                      if(!empty($row->answer))
                      {
                        $aa = explode(',',$row->answer);
                        $answer_1 = $aa['0'];
                        $answer_2 = $aa['1'];
                      }
                      ?>                                            
                      <select class="form-control" name="answer1_<?php echo $counter;?>" id="answer1_<?php echo $counter;?>[]" required>
                        <option value="" >Select Country</option>
                        <?php foreach($countries as $country){?>                
                        <option value="<?php echo $country->id;?>"><?php echo $country->country_name;?></option>
                        <?php } ?>
                      </select>                                            
                      <select class="form-control" name="answer2_<?php echo $counter;?>" id="answer2_<?php echo $counter;?>[]" required>
                        <option value="">Select Country</option>
                        <?php foreach($countries as $country){?>                
                        <option value="<?php echo $country->id;?>"><?php echo $country->country_name;?></option>
                        <?php } ?>
                      </select>
                      <?php
                    }
                    if($row->question_number=="3")
                    {
                    ?>
                      <input type="text" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $row->answer; ?>" placeholder="0-0">
                    <?php
                    }
                    if($row->question_number=="4")
                    {
                    ?>
                      <select class="form-control" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" required>
                        <option value="">Select a Player</option>
                        <?php foreach($countries as $country){?>                
                        <option value="" disabled><?php echo $country->country_name;?></option>
                        <?php 
                        $players = $this->home_model->get_all_players($country->id);
                        foreach($players as $player){?>
                        <option value="<?php echo $player->id;?>">&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $player->player_name;?></option>
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
                    <td><button class="btn btn-success btn-flat" type="submit">Update</button></td>
                  </tr>
                  <?php
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Question has been added !!!</center></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>              
              <?php echo form_close(); ?>
            </div><!-- table-responsive -->
           <?php echo $this->pagination->create_links();?>
          </div><!-- col-md-6 -->
</div>