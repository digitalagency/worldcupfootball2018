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
                  <th width="5%">S.N</th>
                  <th width="10%">Date</th>
                  <th width="75%">Question</th>
                  <th width="10%">Answer</th>
                  <th><a href="<?php echo base_url().'admin/Question/add';?>" class="btn btn-success btn-flat">Add Question</a></th>
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
                    <td><?php echo $counter;?></td>
                    <td><?php echo substr($row->datetime,0,10); ?><input type="hidden" name="question_id_<?php echo $counter;?>" id="question_id_<?php echo $counter;?>" value="<?php echo $row->id; ?>"></td>
                    <td><?php echo $row->question; ?></td>
                    <td><?php echo $row->answer; ?></td>
                    <td><a href="<?php echo base_url().'admin/Question/edit/3/'.$row->id;?>">Edit</a></td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
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