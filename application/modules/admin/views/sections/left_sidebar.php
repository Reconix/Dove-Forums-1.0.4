<div class="header_bg">
    <h1><a href="<?php echo site_url(); ?>/admin/"><?php echo $this->lang->line('dashboard'); ?></a></h1>
</div>

<div class="header_bg">
	<h1><a href="<?php echo site_url(); ?>/admin/users/manage/"><?php echo $this->lang->line('users'); ?></a></h1>
</div>

<div class="content_box">
<ul>
	<li><a href="<?php echo site_url(); ?>/admin/users/manage/"><?php echo $this->lang->line('manageUsers'); ?></a></li>
	<li><a href="<?php echo site_url(); ?>/admin/users/add_new/"><?php echo $this->lang->line('addNewUser'); ?></a></li>
</ul>
</div>

<div class="header_bg">
	<h1><a href="<?php echo site_url(); ?>/admin/categories/manage/"><?php echo $this->lang->line('categories'); ?></a></h1>
</div>

<div class="content_box">
<ul>
	<li><a href="<?php echo site_url(); ?>/admin/categories/manage/"><?php echo $this->lang->line('manageCategories'); ?></a></li>
	<li><a href="<?php echo site_url(); ?>/admin/categories/add_new/"><?php echo $this->lang->line('addNewCategory'); ?></a></li>
</ul>
</div>

<div class="header_bg">
	<h1><a href="<?php echo site_url(); ?>/admin/discussions/manage/"><?php echo $this->lang->line('discussions'); ?></a></h1>
</div>

<div class="content_box">
<ul>
	<li><a href="<?php echo site_url(); ?>/admin/discussions/manage/"><?php echo $this->lang->line('manageDiscussions'); ?></a></li>
</ul>
</div>

<div class="header_bg">
	<h1><a href="<?php echo site_url(); ?>/admin/settings/manage/"><?php echo $this->lang->line('forumsSettings'); ?></a></h1>
</div>

<div class="content_box">
<ul>
	<li><a href="<?php echo site_url(); ?>/admin/settings/manage/"><?php echo $this->lang->line('manageSettings'); ?></a></li>
</ul>
</div>
<?php do_action('admin.sidebar.extention'); ?>