<div id="opt">
<div class="container">
  <div class="wrap">
    <div class="upper">
      <h1>KNOCKOUT CONTEST</h1>
    </div>
    <?php
    $action = base_url() . 'ultimate-contest-question/';
    $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
    echo form_open_multipart($action, $attributes);
    ?>
    <div class="down">
      <div class="head">
        <h2>Ultimate Round</h2>
      </div>
      <div class="cont">
        <div class="q-wrap">
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
          <div class="q">
            <p><?php echo $counter.'. '.$row->question; ?></p>
            <input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>">
            <?php
            if($row->question_number=="1")
            {
            ?>
            <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_1;?>" <?php if($answer==$match_info['0']->team_1) echo 'selected="selected"';?>>
            <?php echo $this->home_model->get_country_name($match_info['0']->team_1);?>
            <input type="radio" name="answer_<?php echo $counter;?>" value="<?php echo $match_info['0']->team_2;?>" <?php if($answer==$match_info['0']->team_2) echo 'selected="selected"';?>>
            <?php echo $this->home_model->get_country_name($match_info['0']->team_2);?>
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
            <select onchange="selectCountry();" class="form-control firstcountry"  name="answer1_<?php echo $counter;?>" id="answer1_<?php echo $counter;?>" required >
              <option value="" >Select Country</option>
              <?php foreach($countries as $country){?>
              <option value="<?php echo $country->id;?>" <?php if($answer_1==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
              <?php } ?>
            </select>
            <select  onchange="selectCountry();" class="form-control secondcountry" name="answer2_<?php echo $counter;?>" id="answer2_<?php echo $counter;?>" required >
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
            <div class="countryscore">
              <div id="firstcountryname"></div>
              <input type="text" name="answer_1_<?php echo $counter;?>" id="answer1_<?php echo $counter;?>" value="<?php echo $answer; ?>" placeholder="0-0">
            </div>
            <div class="countryscore">
              <div id="secoundcountryname"></div>
              <input type="text" name="answer_2_<?php echo $counter;?>" id="answer2_<?php echo $counter;?>" value="<?php echo $answer; ?>" placeholder="0-0">
            </div>
            <?php
            }           
            if($row->question_number=="4")
            {
                if($counter == '3'){?>
            <select class="form-control returncountry" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" required>
              <option value="">Select a Player</option>
              <?php foreach($countries as $country){?>
              <option value="" disabled class="countrydisable"><?php echo $country->country_name;?></option>
              <?php
                $players = $this->home_model->get_all_players($country->id);
                foreach($players as $player){?>
              <option value="<?php echo $player->id;?>" <?php if($answer==$player->id) echo 'selected="selected"';?>>-&nbsp;<?php echo $player->player_name;?></option>
              <?php }
                                } ?>
            </select>
            <?php }
                        elseif($counter == '4' ){?>
            <select class="form-control bestplayercountry" onchange="bestplayer();">
              <option value="">Select Country</option>
              <?php foreach($countries as $country){?>
              <option value="<?php echo $country->id;?>" ><?php echo $country->country_name;?></option>
              <?php } ?>
            </select>
            <select class="form-control bestplayer" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" required>
              <option value="">Select a Player</option>
              <?php foreach($countries as $country){?>
              <option value="" disabled class="countrydisable"><?php echo $country->country_name;?></option>
              <?php
                $players = $this->home_model->get_all_players($country->id);
                foreach($players as $player){?>
              <option value="<?php echo $player->id;?>" <?php if($answer==$player->id) echo 'selected="selected"';?>>-&nbsp;<?php echo $player->player_name;?></option>
              <?php }
                                } ?>
            </select>
            <?php }
                        elseif($counter == '5'){?>
            <select class="form-control highestscorecountry" onchange="highestscore();">
              <option value="">Select Country</option>
              <?php foreach($countries as $country){?>
              <option value="<?php echo $country->id;?>" ><?php echo $country->country_name;?></option>
              <?php } ?>
            </select>
            <select class="form-control highestscore" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" required>
              <option value="">Select a Player</option>
              <?php foreach($countries as $country){?>
              <option value="" disabled class="countrydisable"><?php echo $country->country_name;?></option>
              <?php
                $players = $this->home_model->get_all_players($country->id);
                foreach($players as $player){?>
              <option value="<?php echo $player->id;?>" <?php if($answer==$player->id) echo 'selected="selected"';?>>-&nbsp;<?php echo $player->player_name;?></option>
              <?php }
                                } ?>
            </select>
            <?php 
                        }
                    }
            ?>
          </div>
        <?php
        $i++;
        endforeach;                            
        }
        if(!empty($answer)){?>
        <label class="radio-inline">You have already answered to these questions.<a href="<?php echo base_url() . 'dashboard';?>">Go to Home</a></label>
        <?php
        }
        ?>
        </div>
      </div>
      <?php if(empty($answer)){?>
      <button class="btn btn-default submit" type="submit" name="btnSubmit">Submit</button>
      <?php } ?>
      <?php echo form_close(); ?> </div>
  </div>
</div>