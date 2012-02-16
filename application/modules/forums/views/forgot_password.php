<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<h1>Forgot Password</h1>
<?php echo form_open("forums/forgot_password");?>

<div class="page_list">
<ul>
    <div class="general">
        <div class="general_inner_border">
        	<li>
                <h3><?php echo $this->lang->line('forgotEmailAddress'); ?></h3>
                <?php echo form_input($email);?><?php echo $this->lang->line('hintEmailAddress'); ?><br>
            </li>
            <li>
                <?php echo form_submit('submit', $this->lang->line('forgotPasswordButton'), 'class="btn_alt"');?>
                <div class="clear">&nbsp;</div>       
            </li>
        </div>
    </div>
</ul>
</div>
<?php echo form_close();?>