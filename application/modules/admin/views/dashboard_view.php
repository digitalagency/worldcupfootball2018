<div class="row">
  <div class="col-md-12">
    <h1>Welcome To <?php echo $title;?>.</h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-xs-6">     
    <!-- small box -->    
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $total_registered_users; ?>
        </h3>
        <p>Registered Users</p>
      </div>
      <div class="icon"> <i class="ion ion-person-stalker"></i> </div>
      <a href="<?php echo base_url(); ?>admin/User/registered" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
  </div>  
  <!-- ./col -->  
  <div class="col-lg-3 col-xs-6">     
    <!-- small box -->    
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>32
          <?php //echo $total_registration_numbers; ?>
        </h3>
        <p>Participating Countries</p>
      </div>
      <div class="icon"> <i class="ion ion-ios-people"></i> </div>
      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
  </div>  
  <!-- ./col -->  
  <div class="col-lg-3 col-xs-6">     
    <!-- small box -->    
    <div class="small-box bg-red">
      <div class="inner">
        <h3>64
          <?php //echo $total_gift_coupons; ?>
        </h3>
        <p>Total Matches</p>
      </div>
      <div class="icon"> <i class="ion ion-xbox"></i> </div>
      <a href="<?php echo base_url(); ?>admin/Match/listAll" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
  </div>  
  <!-- ./col -->  
  <div class="col-lg-3 col-xs-6">     
    <!-- small box -->    
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>256
          <?php //echo $gift_coupons_taken; //$total_giftcoupons_taken; ?>
        </h3>
        <p>Questions</p>
      </div>
      <div class="icon"> <i class="ion ion-ios-chatbubble"></i> </div>
      <a href="<?php echo base_url(); ?>admin/Question/MatchDayContest" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> </div>
  </div>  
  <!-- ./col -->   
</div>