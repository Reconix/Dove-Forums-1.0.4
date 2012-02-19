<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
*
* Admin Edit User View
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		� 2010 - 2011 Dove Forums
* @last modified	03/02/2011
**/
?>

<div class="header_bg"><h1><?php echo $this->lang->line('addUser'); ?></h1></div>
<div class="content_box">

<?php echo form_open('admin/users/save_user/', 'class="form"'); ?>

<ul>
    <li>
        <h3><?php echo $this->lang->line('userDetails'); ?></h3>
        <p><?php echo $this->lang->line('username'); ?><br><?php echo form_input($username); ?>&nbsp;&nbsp;<cite>Enter Users Username.</cite></p>
        <p><?php echo $this->lang->line('password'); ?><br><?php echo form_input($password); ?>&nbsp;&nbsp;<cite>Users Password. <strong>Note - This password is generated automatically.</strong></cite></p>
        <p><?php echo $this->lang->line('firstName'); ?><br><?php echo form_input($first_name); ?>&nbsp;&nbsp;<cite>Enter Users First Name.</cite></p>
        <p><?php echo $this->lang->line('lastName'); ?><br><?php echo form_input($last_name); ?>&nbsp;&nbsp;<cite>Enter Users Last Name.</cite></p>
        <p><?php echo $this->lang->line('userEmail'); ?><br><?php echo form_input($email); ?>&nbsp;&nbsp;<cite>Enter Users Email Address.</cite></p>
        <p><?php echo $this->lang->line('gender'); ?><br><?php echo form_dropdown('gender', $gender); ?>&nbsp;&nbsp;<cite>Select Users Gender.</cite></p><br>
    </li>
    <li>
        <h3><?php echo $this->lang->line('userSettings'); ?></h3>
        <p><?php echo $this->lang->line('userGroup'); ?><br><?php echo form_dropdown('group', $group_options); ?>&nbsp;&nbsp;<cite>Select Users User Group.</cite></p>
    </li>
    <li>
        <?php echo form_submit('submit', $this->lang->line('addUserButton'));?>
    </li>
</ul>

<?php echo form_close(); ?>

</div>