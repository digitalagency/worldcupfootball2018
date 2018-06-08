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
                  <th width="5%">SN</th>
                  <th width="45%">Country </th>
                  <th width="50%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($this->uri->segment(4) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(4) + 1;
                }
                if (!empty($country_info)) { 
                  $counter=0;
                  foreach ($country_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->country_name; ?></td>                    
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Country/listPlayers/<?php echo $row->id; ?>"><i class="fa fa-list tooltips" data-original-title="List all Players"></i> List all Players</a>
                      |
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Country/addPlayer/<?php echo $row->id; ?>"><i class="fa fa-plus tooltips" data-original-title="Add Player"></i> Add Player</a>
                      |
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Country/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Activity"></i> Edit</a>
                      |
                      <button type="button" class="btn btn-success btn-sm delete_Activity" link="<?php echo base_url(); ?>admin/Country/deleteCountry/<?php echo $row->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Activity"></i> Delete</button>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Country has been added !!!</center></td>
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
        source: "../Country/get_countrys",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>