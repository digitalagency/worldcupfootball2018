<?php
  $this->load->model('Country_model');
  $countries = $this->Country_model->get_all_countries();
?>

<section class="content"> 
  
  <!-- Default box -->
  
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <?php
            $action = base_url() . 'admin/Question/TheUltimateContest/'.$this->uri->segment(4);
            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
            echo form_open_multipart($action, $attributes);
            ?>
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Question/Answer</th>
                </tr>
              </thead>
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
                  <td><?php echo $row->question; ?>
                    <input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>"></td>
                </tr>
                <tr>
                  <td>
          <?php
                    if($row->question_number=="1")
                    {
                      ?>
                    <select class="form-control" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" required>
                      <option value="">Select Country</option>
                      <?php foreach($countries as $country){?>
                      <option value="<?php echo $country->id;?>" <?php if($row->answer==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                      <?php } ?>
                    </select>
                    <?php
                    }
                    if($row->question_number=="2")
                    {
                      $answer_1 = '';
                      $answer_2 = '';
                      if(!empty($row->answer))
                      {
                        $aa = explode(',',$row->answer);
                        if(isset($aa['0']))
                          $answer_1 = $aa['0'];
                        if(isset($aa['1']))
                          $answer_2 = $aa['1'];
                      }
                      ?>
                    <select class="form-control" multiple name="answer_<?php echo $counter;?>[]" id="answer_<?php echo $counter;?>[]" required>
                      <option value="" disabled>Select any two Country</option>
                      <?php foreach($countries as $country){?>
                      <option value="<?php echo $country->id;?>" <?php if($answer_1==$country->id || $answer_2==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                      <?php } ?>
                    </select>
                    Press Ctrl for multiple Country selection
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
                        $players = $this->Country_model->get_all_players($country->id);
                        foreach($players as $player){?>
                      <option value="<?php echo $player->id;?>" <?php if($row->answer==$player->id) echo 'selected="selected"';?>>&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $player->player_name;?></option>
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
                  <td colspan="8"><center>
                      No Question has been added !!!
                    </center></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php echo form_close(); ?> </div>
          <!-- table-responsive --> 
          
          <?php echo $this->pagination->create_links();?> </div>
        <!-- col-md-6 --> 
        
      </div>
    </div>
  </div>
  
  <!-- /.box --> 
  
</section>

<!-- Delete Modal -->

<div id="myModalDelete" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title green">Are you sure to delete this Country ?</h4>
      </div>
      <div class="modal-body center"> <a class="btn btn-success get_link" href="">Yes</a> &nbsp; | &nbsp;
        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>