<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>

<div class="layout_wide_left">
	<div class="header_bg">
		<h1><?php echo $this->lang->line('dashWelcomeTitle'); ?></h1>
	</div>
	<div class="widgetbox">
		<div class="content_box">
			<p><?php echo $this->lang->line('dashWelcomeMessage'); ?></p>
			<br>
		</div>
	</div>
</div>

<div class="layout_small_right">
	<div class="header_bg">
		<h1><?php echo $this->lang->line('stats'); ?></h1>
	</div>
	<div class="stat-box">
		<ul class="stats-list">
			<li><a href="#">Total Visits <span>142</span></a></li>
			<li><a href="#"><?php echo ''.$this->lang->line('dashUsers').''; ?> <span><?php echo ''.$users.''?></span></a></li>
			<li><a href="#"><?php echo ''.$this->lang->line('dashDiscussions').''; ?> <span><?php echo ''.$discussions.''?></span></a></li>
			<li><a href="#"><?php echo ''.$this->lang->line('dashPosts').''; ?> <span><?php echo ''.$posts.''?></span></a></li>
		</ul>
	</div>
</div>
