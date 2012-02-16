<?php echo $template['partials']['header']; ?>
<body>
<div id="toppanel">
<?php echo $template['partials']['toppanel']; ?>
</div>
<div id="header_wrap">
	<?php echo $template['partials']['page_header']; ?>
</div>
<div id="content_wrap">
	<div id="content">
			<?php echo $template['partials']['messages']; ?>
			<?php echo $template['body']; ?>
	</div>

	<div id="sidebar">
        <div class="sidebar_box_inner_border">
			<?php echo modules::run('categories/categories/index'); ?>
			<?php 
			
			if($forumsInstalled)
			{
				echo modules::run('latest_topics/latest_topics/index'); 
			}
			?>
        </div>
	</div>
</div>
<div id="footer_wrap">
	<?php echo $template['partials']['footer']; ?>
</div>
</body>
</html>