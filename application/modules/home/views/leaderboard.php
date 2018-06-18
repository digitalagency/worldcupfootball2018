<div id="opt">
  <div class="container">
    <div class="wrap">
      <div class="down">
        <div class="head">
            <h2>LEADERBOARD</h2>
        </div>
        <div class="cont">
          <div class="table-responsive">  
            <table class="table table-hover user_register" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="50%">Full Name</th>
                  <th width="30%">Gender</th>
                  <th width="20%">Score</th>
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
                    <td><?php echo ucwords($row->fname); ?></td>
                    <td><?php echo ucwords($row->gender); ?></td>
                    <td><?php echo $this->home_model->get_total_score_by_user_id($row->id);?></td>
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
        </div>
      </div>
    </div>
  </div>
</div>