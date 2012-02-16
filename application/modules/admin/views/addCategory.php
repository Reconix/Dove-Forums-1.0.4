<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>

<div class="header_bg"><h1><?php echo $this->lang->line('headingNewCategory'); ?></h1></div>
<div class="content_box">
<?php echo form_open('admin/categories/save_category', 'class="form"'); ?>
<ul>
<li>
<h3><?php echo $this->lang->line('headingCategorySettings'); ?></h3>
<p><?php echo $this->lang->line('categoryName'); ?><br><?php echo form_input($name); ?>&nbsp;&nbsp;<cite>Enter Category Name.</cite></p>
<p>Parent Category:<br><?php echo form_dropdown('category', $category_options, 'class="dropdown"'); ?>&nbsp;&nbsp;<cite>Select Parent Category.</cite></p>
<p>Category Type:<br><?php echo form_dropdown('type', $category_type, 'class="dropdown"'); ?>&nbsp;&nbsp;<cite>Select Category Type.</cite></p>
<p><?php echo $this->lang->line('categoryDescription'); ?><br><?php echo form_textarea($description); ?>&nbsp;&nbsp;<cite>Enter Category Description.</cite></p>
<p><?php echo $this->lang->line('categoryActive'); ?><?php echo form_checkbox($active); ?>&nbsp;&nbsp;<cite>Is category Active?.</cite></p>
</li>
<li>
<?php echo form_submit('submit', $this->lang->line('addCategoryButton'));?>
</li>
</ul>
<?php echo form_close(); ?>
</div>