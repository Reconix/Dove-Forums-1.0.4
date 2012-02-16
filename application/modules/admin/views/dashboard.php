<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>

<div class="header_bg"><h1><?php echo $this->lang->line('dashboard'); ?></h1></div>
<div class="content_box">
<p><?php echo $this->lang->line('dashWelcomeMessage'); ?></p>
<ul>
	<li><p><?php echo ''.$users.' '.$this->lang->line('dashUsers').''; ?></p></li>
	<li><p><?php echo ''.$discussions.' '.$this->lang->line('dashDiscussions').''; ?></p></li>
	<li><p><?php echo ''.$posts.' '.$this->lang->line('dashPosts').''; ?></p></li>
</ul>
</div>