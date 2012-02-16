<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<h1><?php echo $this->lang->line('titleChangePassword'); ?></h1>
<?php echo form_open('forums/change_password', 'class="form"'); ?>
<div class="page_list">
<ul>
    <div class="general">
    <div class="general_inner_border">
    <li>
        <h3><?php echo $this->lang->line('changePassOldPass'); ?></h3>
        <?php echo form_input($old_password); ?>&nbsp;&nbsp;<?php echo $this->lang->line('oldPasswordHint'); ?>
    </li>
    
    <li>
        <h3><?php echo $this->lang->line('changePassNewPass'); ?></h3>
        <?php echo form_input($new_password); ?>&nbsp;&nbsp;<?php echo $this->lang->line('newPasswordHint'); ?>
    
        <h3><?php echo $this->lang->line('changePassPewPassConfirm'); ?></h3>
        <?php echo form_input($new_password_confirm); ?>&nbsp;&nbsp;<?php echo $this->lang->line('newRePasswordHint'); ?>
    </li>
    
    <li>
        <?php echo form_hidden($user_id); ?>
        <?php echo form_submit('submit', $this->lang->line('changePassButton'), 'class="btn_alt"'); ?>
        <div class="clear">&nbsp;</div>
    </li>
    </div>
    </div>
</ul>

</div>

<?php echo form_close(); ?>