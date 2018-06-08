<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">


      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space" href="<?php echo base_url(); ?>admin/User/add"><i class="fa fa-plus" data-original-title="View Basket"></i> Add User </a>
            <div class="col-xs-10">
              <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for User" />
            </div>
        </div>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="1%">S.N.</th>
                  <th width="10%">Registration Date </th>
                  <th width="5%">Registration Number</th>
                  <th width="10%">Passcode</th>
                  <th width="20%">Full Name</th>
                  <th width="10%">Main Region</th>
                  <th width="10%">Sub Region</th>
                  <th width="20%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $pno = $this->uri->segment(5);
                if(empty($pno))
                  $pno = 0;
                if ($this->uri->segment(5) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(5) + 1;
                }
                if (!empty($user_info)) { 
                  $counter=0;
                  foreach ($user_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    $cnt = $pno+$counter;
                    ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row->registration_date; ?></td>
                    <td><?php echo $row->registration_number; ?></td>
                    <td><?php echo $row->passcode; ?></td>
                    <td><?php echo $row->full_name;?></td>
                    <td><?php echo $row->main_region;?></td>
                    <td><?php if($row->sub_region!="0")  echo $row->sub_region; else echo "n/a"; ?></td>
                    <td class="table-action text-center">
                      <?php $delete_link = base_url().'admin/User/deleteUser/'.$row->id.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);?>
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/User/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Activity"></i> Edit</a>
                      |
                      <button type="button" class="btn btn-success btn-sm delete_Activity" link="<?php echo $delete_link; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Activity"></i> Delete</button>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No User Found !!!</center></td>
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
          <h4 class="modal-title green">Are you sure to delete this User ?</h4>
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
        source: "../../User/get_users",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>