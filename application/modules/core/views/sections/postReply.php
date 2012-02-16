<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php echo form_open('forums/submit_post/', 'class="form"');?>
<div class="page_list">
<ul class="page_list">
<li class="alt">
<h3>Quick Reply</h3>
<div><textarea name="comments_box" class="comments" rows="10" style="width:90%"></textarea></div>

<?php
echo form_hidden('CategoryID', $this->uri->segment(3));
echo form_hidden('TopicID', $this->uri->segment(4));

?>
<br />
<?php echo form_submit('submit', $this->lang->line('submitPostButton'), 'class="btn"');?>
</form>
</li>
</ul>
</div>