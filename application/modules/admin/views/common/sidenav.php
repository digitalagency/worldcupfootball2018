<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="background-color: #fff;">
        <div class="pull-left">
          <img src="<?php echo base_url();?>/content_admin/images/logo.png" alt="S M Pharma" width="100%" class="img-responsive">
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class ="<?php if($nav == 'dashboard'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-home"></i><span>DASHBOARD</span></a></li>
        <li class ="<?php if($this->uri->segment(2) == 'Country'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-flag"></i><span>COUNTRY</span></a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2) == 'Country' && $this->uri->segment(3) == ''){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Country"><i class="fa fa-circle-o"></i> List All</a></li>
            <li class="<?php if($this->uri->segment(3) == 'add' || $this->uri->segment(3) == 'edit'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Country/add"><i class="fa fa-circle-o"></i> Manage Country</a></li>
          </ul>
        </li>
        <li class ="<?php if($this->uri->segment(2) == 'Match'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-users"></i><span>MATCHES</span></a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3) == 'listAll'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Match/listAll"><i class="fa fa-circle-o"></i> All</a></li>
          </ul>
        </li>
        <li class ="<?php if($nav == 'Question'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-question "></i><span>Questions</span></a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3) == 'MatchDayContest'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Question/MatchDayContest"><i class="fa fa-circle-o"></i> Match Day Contest</a></li>
            <li class="<?php if($this->uri->segment(3) == 'TheUltimateContest'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Question/TheUltimateContest"><i class="fa fa-circle-o"></i> The Ultimate Contest</a></li>
            <li class="<?php if($this->uri->segment(3) == 'AllTimeContest' || (isset($active) && $active == 'AllTimeContest')){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Question/AllTimeContest"><i class="fa fa-circle-o"></i> All time Contest</a></li>
          </ul>
        </li> 
      </ul>
  </section>
    <!-- /.sidebar -->
</aside>
