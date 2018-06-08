<?php if($this->session->flashdata('success')){ ?>
        <div class="error"><?php echo strtoupper($this->session->flashdata('success')); ?></div>                             
<?php }else if($this->session->flashdata('error')){ ?>
        <div class="error"><?php echo strtoupper($this->session->flashdata('error')); ?></div>
<?php } ?>