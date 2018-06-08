<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="5%">Match#</th>
                  <th width="15%">Date</th>
                  <th width="16%">Team 1</th>
                  <th width="10%"></th>
                  <th width="16%">Team 2</th>
                  <th width="8%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $action = base_url() . 'admin/Match/listAll/'.$this->uri->segment(4);
                  $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');

                if ($this->uri->segment(4) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(4) + 1;
                }
                if (!empty($match_info)) { 
                  $counter=0;
                  foreach ($match_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>                  
                  <?php echo form_open($action, $attributes); ?>
                  <tr>
                    <td><?php echo $row->id; ?><input type="hidden" name="match_id" id="match_id" value="<?php echo $row->id; ?>"></td>
                    <td>
                      <!-- <input type="text" required="" name="match_date" id="match_date_<?php echo $counter;?>" class="form-control" value="<?php echo $row->match_date; ?>"> -->
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right match_date" name="match_date" id="datepicker" value="<?php if($row->match_date>0) echo $row->match_date; ?>">
                      </div>
                    </td>
                    <td>                      
                    <select class="form-control" name="team_1" id="team_1" required>
                      <option value="">Select Team 1</option>
                      <?php foreach($countries as $country){?>                
                      <option value="<?php echo $country->id;?>" <?php if($row->team_1==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                      <?php } ?>
                    </select>
                    </td>
                    <td class="text-center">VS</td>
                    <td>                     
                    <select class="form-control" name="team_2" id="team_2" required>
                      <option value="">Select Team 2</option>
                      <?php foreach($countries as $country){?>                
                      <option value="<?php echo $country->id;?>" <?php if($row->team_2==$country->id) echo 'selected="selected"';?>><?php echo $country->country_name;?></option>
                      <?php } ?>
                    </select>
                    </td>
                    <td><button class="btn btn-success btn-flat" type="submit" name="btnSubmit">Update</button></td>
                  </tr>
                  <?php echo form_close(); ?>
                  <?php
                  $i++;
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Country has been taken !!!</center></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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

  <script type="text/javascript">
    $('document').ready(function(){
      $('.delete_Activity').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "../Country/get_coupons",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });

  $( function() {
    $('.match_date').each(function(){
        $(this).datetimepicker({locale: 'sv'});
        $( "#match_date_" ).datepicker();
        $( "#match_date_" ).datepicker( "option", "showAnim", 'clip' );                 
        $( "#match_date_" ).datepicker( "option", "dateFormat", "yy-mm-dd h:i:s" );
        $( "#match_date_" ).datepicker("setDate", "2018-09-25 16:00:00");
    });
  } );
</script>