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
                  <th width="1%">Reg S.N.</th>
                  <th width="10%">Registration Date </th>
                  <th width="5%">Registration Code</th>
                  <th width="20%">Full Name</th>
                  <!-- <th width="10%">Main Region</th>
                  <th width="10%">Sub Region</th>
                  <th width="10%">Coupon No.</th>
                  <th width="10%">Coupon qty.</th> -->
                  <th width="10%">Fb Likes</th>
                  <th width="10%">Uploaded Image</th>
                  <th width="10%">Shades</th>
                  <th width="10%">Pattern</th>
                  <th width="20%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
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
                    if($row->shade=="Non- Metallica")
                      $shade_location = base_url()."content_home/images/nonmetallica/".$row->pattern;
                    else
                      $shade_location = base_url()."content_home/images/metallica/".$row->pattern;
                    $colorname = str_replace(".jpg","",$row->pattern);
                    $colorname = str_replace("Metalica ","",$colorname);
                    $colorname = str_replace("Metallica ","",$colorname);
                    $colorname = str_replace("_"," ",$colorname);
                    ?>
                  <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->uploaded_date; ?></td>
                    <td><?php echo $row->registration_number; ?></td>
                    <td><?php echo $row->full_name;?></td>
                    <!-- <td><?php echo $row->main_region; ?></td>
                    <td><?php echo $row->sub_region; ?></td>
                    <td><?php echo $row->coupon_no; ?></td>
                    <td><?php echo $row->coupon_qty;?></td> -->
                    <td><?php echo $row->likes; ?></td>
                    <td><img src="<?php echo base_url().$row->imagepath.$row->imagename; ?>" style="max-height:100px; max-width:100px;"></td>
                    <td><?php echo $row->shade; ?></td>
                    <td><img src="<?php echo $shade_location;?>" title="<?php echo $colorname;?>"></td>
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/User/edit/<?php echo $row->user_id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Activity"></i> Edit</a>
                      |
                      <?php $remove_link = base_url().'admin/User/removeUser/'.$row->id.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);?>
                      <button type="button" class="btn btn-success btn-sm delete_Activity" link="<?php echo $remove_link; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Remove User"></i> Remove</button>
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
          <h4 class="modal-title green">Are you sure to remove all uploaded information of this User ?</h4>
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
        source: "User/get_users",
            minLength: 1,
            select: function (e, ui) {
                alert('hello');
                location.href = ui.item.the_link;
            }
      });
    });
  </script>