<?php echo $template['partials']['header']; ?>
<body>
<div id="header_wrap">
	<?php echo $template['partials']['page_header']; ?>
</div>
<div id="content_wrap">
	<div id="content">
		<div id="logo"><img src="<?php echo base_url(); ?>/assets/images/admin/logo.png" /></div>
		<div id="navigation"><?php echo $template['partials']['navigation']; ?></div>
		<?php echo $template['partials']['messages']; ?>
		<div class="col1"><?php echo $template['partials']['left_sidebar']; ?></div>
		<div class="main"><?php echo $template['body']; ?></div>
	</div>
</div>
<div id="footer_wrap">
	<?php echo $template['partials']['footer']; ?>
</div>
</body>
</html>