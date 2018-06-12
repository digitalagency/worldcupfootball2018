<div class="circle-line">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="wrap">
          <img src="<?php echo base_url();?>content_home/images/con-cir1.png" alt="">
          <div class="low">
            <button type="button" class="btn btn-default one"><?php echo $this->home_model->calculate_point_by_contest_type('1');?></button>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="wrap">
          <img src="<?php echo base_url();?>content_home/images/con-cir2.png" alt="">
          <div class="low">
            <button type="button" class="btn btn-default two"><?php echo $this->home_model->calculate_point_by_contest_type('2');?></button>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="wrap">
          <img src="<?php echo base_url();?>content_home/images/con-cir3.png" alt="">
          <div class="low">
            <button type="button" class="btn btn-default three"><?php echo $this->home_model->calculate_point_by_contest_type('3');?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>