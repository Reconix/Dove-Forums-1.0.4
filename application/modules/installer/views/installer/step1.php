<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<h1>Dove Forums Installer</h1>
<div class="page_list">
    <div class="general">
    <div class="general_inner_border">
        <?php echo validation_errors(); ?>
        <?php echo form_open('installer/run_install', 'class="form"'); ?>
        <h3><?php echo $this->lang->line('databaseHost'); ?></h3>
        <?php echo form_input($db_host); ?><?php echo $this->lang->line('databaseHostHint'); ?>
        <h3><?php echo $this->lang->line('databaseName'); ?></h3>
        <?php echo form_input($db_name); ?><?php echo $this->lang->line('databaseNameHint'); ?>
        <h3><?php echo $this->lang->line('databaseUsername'); ?></h3>
        <?php echo form_input($db_user); ?><?php echo $this->lang->line('databaseUsernameHint'); ?>
        <h3><?php echo $this->lang->line('databasePassword'); ?></h3>
        <?php echo form_input($db_password); ?><?php echo $this->lang->line('databasePasswordHint'); ?>
        <h3><?php echo $this->lang->line('databasePrefix'); ?></h3>
        <?php echo form_input($db_prefix); ?><?php echo $this->lang->line('databasePrefixHint'); ?>
        <h3><?php echo $this->lang->line('siteName'); ?></h3>
        <?php echo form_input($site_name); ?><?php echo $this->lang->line('siteNameHint'); ?>
        <h3><?php echo $this->lang->line('installLocation'); ?></h3>
        <?php echo form_input($install_location); ?><?php echo $this->lang->line('installLocationHint'); ?>
        <h3><?php echo $this->lang->line('adminUsername'); ?></h3>
        <?php echo form_input($admin_username); ?><?php echo $this->lang->line('adminUsernameHint'); ?>
        <h3><?php echo $this->lang->line('adminEmail'); ?></h3>
        <?php echo form_input($admin_email); ?><?php echo $this->lang->line('adminEmailHint'); ?>
        <h3><?php echo $this->lang->line('adminPassword'); ?></h3>
        <?php echo form_input($admin_password); ?><?php echo $this->lang->line('adminPasswordHint'); ?>
        <h3><?php echo $this->lang->line('adminConfirmPassword'); ?></h3>
        <?php echo form_input($admin_confirm); ?><?php echo $this->lang->line('adminConfirmPasswordHint'); ?>
        <br />
        <?php echo form_submit($submit); ?>
        <div class="clear">&nbsp;</div>
        <?php echo form_close(); ?>        
    </div>
    </div>
</div>