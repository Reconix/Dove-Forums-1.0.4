<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>

<div class="header_bg"><h1><?php echo $this->lang->line('headingEditCategory'); ?></h1></div>
<div class="content_box">

<?php echo form_open('admin/categories/update/'.$categoryID.'', 'class="form"'); ?>
<ul>
    <li>
        <h3><?php echo $this->lang->line('headingCategorySettings'); ?></h3>
        <p><?php echo $this->lang->line('categoryName'); ?><br><?php echo form_input($name); ?>&nbsp;&nbsp;<cite>Enter Category Name.</cite></p>
        <p><?php echo $this->lang->line('categoryDescription'); ?><br><?php echo form_textarea($description); ?>&nbsp;&nbsp;<cite>Enter Category Description.</cite></p>
        <p><?php echo $this->lang->line('categoryActive'); ?><?php echo form_checkbox($active); ?>&nbsp;&nbsp;<cite>Is Category Active?.</cite></p>
    </li>
    <li>
        <?php echo form_submit('submit', $this->lang->line('updateCategoryButton'));?>
    </li>
</ul>

<?php echo form_close(); ?>

</div>