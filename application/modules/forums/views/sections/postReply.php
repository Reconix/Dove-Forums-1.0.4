<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

	

<?php echo form_open('forums/submit_post/', 'class="form" name="quickReply"');?>
<div class="page_list">
<ul class="page_list">
<li class="alt">
<h3>Quick Reply</h3>
<div class="avatar">
<?php 
    echo '<img src="'.$this->users_m->gravatar($this->session->userdata('email'), "x", "45").'" title="'.$this->session->userdata('username').''.$this->lang->line('avatarTitle').'" height="45px" width="45px"/>';
?>
</div>
<div><textarea id="comments_box" name="comments_box" class="quickReplyBox" rows="10" style="width:670px"></textarea></div>

<?php
echo form_hidden('CategoryID', $this->uri->segment(3));
echo form_hidden('TopicID', $this->uri->segment(4));
?>

<br />

<?php echo form_submit('submit', $this->lang->line('submitPostButton'), 'class="btn" title="'.$this->lang->line('submitPostButton').'"'); ?>

</form>
</li>
</ul>
</div>