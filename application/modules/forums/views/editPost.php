<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo '<h1>'.$this->lang->line('headerEditPost').'</h1>';
echo form_open('forums/update_post/'.$commentID.'', 'class="form"'); 
?>

<div class="page_list">
<ul>
    <div class="general">
    <div class="general_inner_border">
    
    <li class="alt">
    	<h3><?php echo $this->lang->line('postText'); ?></h3>
    	<?php echo form_textarea($body); ?><?php echo $this->lang->line('hintPostText'); ?>
    </li>
    
    <?php
    if($this->ion_auth->logged_in())
    {
    	if($this->ion_auth->is_admin())
    	{
    	echo '<li>
    		<h3>'.$this->lang->line('postReported').'</h3>
    		'.form_checkbox($reported).''.$this->lang->line('hintPostReported').'
    	</li>';
    	}
    }
    ?>
    
    <li class="alt">
    	<?php echo form_submit($updatePost); ?>
        <div class="clear">&nbsp;</div>
    </li>
    
    </div></div>
</ul>
</div>

<?php echo form_close(); ?>