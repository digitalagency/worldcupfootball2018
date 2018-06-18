<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">


      <div class="row">
        <div class="col-md-12">
        <!--<div class="panel-footer">
            <div class="col-xs-12">
              <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for User" />
            </div>
        </div> -->
          <div class="table-responsive">  
            <table class="table table-hover user_register" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="5%" class="text-center">S.N.</th>
                  <th width="20%">Registered On</th>
                  <th width="20%">Full Name</th>
                  <th width="10%">Gender</th>
                  <th width="20%">Mobile No.</th>
                  <th width="20%">Email</th>
                  <th width="5%">Score</th>
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
                    ?>
                  <tr>
                    <td class="text-center"><?php echo $counter+$page; ?></td>
                    <td><?php echo $row->registered_on; ?></td>
                    <td><?php echo $row->fname; ?></td>
                    <td><?php echo $row->gender; ?></td>
                    <td><?php echo $row->mobile_number;?></td> 
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $this->User_model->get_total_score_by_user_id($row->id);?></td>
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
        source: "../../User/get_users",
            minLength: 1,
            select: function (e, ui) {
                //alert('hello');
                location.href = ui.item.the_link;
            }
      });
    });
  </script>