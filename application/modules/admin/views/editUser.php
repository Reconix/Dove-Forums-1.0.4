<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
*
* Admin Edit User View
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		© 2010 - 2011 Dove Forums
* @last modified	03/02/2011
**/
?>

<div class="header_bg"><h1><?php echo $this->lang->line('editUser'); ?></h1></div>
<div class="content_box">

<?php echo form_open('admin/users/update/'.$userID.'', 'class="form"'); ?>
<ul>
    <li>
        <h3><?php echo $this->lang->line('userDetails'); ?></h3>
        <p><?php echo $this->lang->line('username'); ?><br><?php echo form_input($username); ?>&nbsp;&nbsp;<cite>Enter Users Username.</cite></p>
        <p><?php echo $this->lang->line('firstName'); ?><br><?php echo form_input($first_name); ?>&nbsp;&nbsp;<cite>Enter Users First Name.</cite></p>
        <p><?php echo $this->lang->line('lastName'); ?><br><?php echo form_input($last_name); ?>&nbsp;&nbsp;<cite>Enter Users Last Name.</cite></p>
        <p><?php echo $this->lang->line('userEmail'); ?><br><?php echo form_input($email); ?>&nbsp;&nbsp;<cite>Enter Users Email Address.</cite></p>
        <p><?php echo $this->lang->line('gender'); ?><br><?php echo form_dropdown('gender', $gender, $sex); ?>&nbsp;&nbsp;<cite>Select Users Gender.</cite></p><br>
    </li>
    <li>
        <h3><?php echo $this->lang->line('userBio'); ?></h3>
        <p><?php echo $this->lang->line('interests'); ?><br><?php echo form_textarea($interests); ?>&nbsp;&nbsp;<cite>Enter Users Interests.</cite></p>
        <p><?php echo $this->lang->line('occupation'); ?><br><?php echo form_input($occupation); ?>&nbsp;&nbsp;<cite>Enter Users Occupation.</cite></p>
        <p><?php echo $this->lang->line('location'); ?><br><?php echo form_input($location); ?>&nbsp;&nbsp;<cite>Enter Users Location.</cite></p><br>
    </li>
    <li>
        <h3><?php echo $this->lang->line('userSettings'); ?></h3>
        <p><?php echo $this->lang->line('signature'); ?><br><?php echo form_textarea($signature); ?>&nbsp;&nbsp;<cite>Enter Users Signature.</cite></p>
        <p><?php echo $this->lang->line('userGroup'); ?><br><?php echo form_dropdown('group', $group_options, $group); ?>&nbsp;&nbsp;<cite>Select Users User Group.</cite></p>
        <p><?php echo $this->lang->line('userActive'); ?><?php echo form_checkbox($active); ?>&nbsp;&nbsp;<cite>Is User Active?.</cite></p><br>
    </li>
    <li>
        <?php echo form_submit('submit', $this->lang->line('updateUserButton'));?>
    </li>
</ul>

<?php echo form_close(); ?>

</div>