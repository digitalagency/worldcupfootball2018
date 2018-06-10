<div class="user_section">
  <?php $this->load->view('includes/user_scoreboard_section'); ?>
</div>
<div class="row mainpanel">

    <img src="<?php echo base_url();?>content_home/images/match_day_contest_heading.png">
  <div class="col-md-12">
          <div class="table-responsive">  
            <?php
            $action = base_url() . 'match-day-contest/';
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
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_1;?>"> <?php echo $row->option_1;?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_2;?>"> <?php echo $row->option_2;?>
                    <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $row->option_3;?>"> <?php echo $row->option_3;?>

                    
                    <?php
                    if($row->question_number=="2")
                    {
                      ?>
                      <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?><input type="number" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $row->answer; ?>"> <input type="number" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $row->answer; ?>" > <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
                      
                      <?php
                    }
                    if($row->question_number=="4")
                    {
                    ?>
                    <select class="form-control" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>">
                      <option value="">Select Answer</option>                
                      <option disabled><?php echo $this->home_model->get_country_name($match_info['0']->team_1);?></option>
                        <?php 
                        $players = $this->home_model->get_all_players($match_info['0']->team_1);
                        foreach($players as $player){?>
                        <option value="<?php echo $player->id;?>" <?php if($row->answer==$player->id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $player->player_name;?></option>
                        <?php 
                        }
                        ?>
                      <option disabled><?php echo $this->home_model->get_country_name($match_info['0']->team_2);?></option>
                        <?php 
                        $players = $this->home_model->get_all_players($match_info['0']->team_2);
                        foreach($players as $player){?>
                        <option value="<?php echo $player->id;?>">&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $player->player_name;?></option>
                        <?php 
                        }
                        ?>
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
          </div>
        </div>
</div>