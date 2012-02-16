<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<h1>Dove Forums Installer</h1>
<div class="page_list">
    <div class="general">
    <div class="general_inner_border">
        <h3><?php echo $this->lang->line('Title'); ?></h3>
        <p><?php echo $this->lang->line('welcomeText'); ?></p>
        
        <div class="buttons">
            <div class="smallButton"><div class="pageButton"><div class="content"><?php echo ''.anchor('installer/setup/step1', $this->lang->line('nextButton')).''; ?></div></div></div>       
        </div>
    </div>
    </div>
</div>