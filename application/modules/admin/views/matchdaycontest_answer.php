<?php
  $this->load->model('Country_model');
  //print_r($match_question);
  //echo $match_id;
  $match_info = $this->Match_model->get_match_by_id($match_id);
  //print_r($match_info);
?>
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">  
            <?php
            $action = base_url() . 'admin/Question/MatchDayContestAnswer/'.$this->uri->segment(4);
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
                if (!empty($match_question)) { 
                  $counter=0;
                  foreach ($match_question as $row):
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
                    if($row->question_number=="1" || $row->question_number=="3")
                    {
                    ?>
                    <select class="form-control" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>">
                      <option value="">Select Answer</option>                
                      <option value="<?php echo $match_info['0']->team_1;?>" <?php if($row->answer==$match_info['0']->team_1) echo 'selected="selected"';?>><?php echo $this->Country_model->get_country_name($match_info['0']->team_1);?></option>
                      <option value="<?php echo $match_info['0']->team_2;?>" <?php if($row->answer==$match_info['0']->team_2) echo 'selected="selected"';?>><?php echo $this->Country_model->get_country_name($match_info['0']->team_2);?></option>
                    </select>
                    <?php
                    }
                    if($row->question_number=="2")
                    {
                      ?>
                      <?php echo $this->Country_model->get_country_name($match_info['0']->team_1);?> VS <?php echo $this->Country_model->get_country_name($match_info['0']->team_2);?>
                      <input type="text" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>" value="<?php echo $row->answer; ?>" placeholder="0-0">
                      <?php
                    }
                    if($row->question_number=="4")
                    {
                    ?>
                    <select class="form-control" name="answer_<?php echo $counter;?>" id="answer_<?php echo $counter;?>">
                      <option value="">Select Answer</option>                
                      <option disabled><?php echo $this->Country_model->get_country_name($match_info['0']->team_1);?></option>
                        <option value="1" <?php if($row->answer=='1') echo 'selected="selected"';?>> - Player 1</option>
                        <option value="2" <?php if($row->answer=='2') echo 'selected="selected"';?>> - Player 2</option>
                      <option disabled><?php echo $this->Country_model->get_country_name($match_info['0']->team_2);?></option>
                        <option value="3" <?php if($row->answer=='3') echo 'selected="selected"';?>> - Player 1</option>
                        <option value="4" <?php if($row->answer=='4') echo 'selected="selected"';?>> - Player 2</option>
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
        <div class="modal-body center">
           
          <a class="btn btn-success get_link" href="">Yes</a>
          &nbsp; | &nbsp; 
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>