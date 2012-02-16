<div id="header">
	<img src="<?php echo base_url(); ?>assets/images/forums_logo.gif" alt="logo" />
	<div id="header_tab">
		<span id="toggle_panel">
			<?php if(!$this->ion_auth->logged_in()){ echo '<a id="open" class="open" href="#">Log In | Register</a>'; } elseif($this->ion_auth->logged_in()) { echo '<a id="open" class="open" href="#">My Account</a>'; } ?>
			<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
		</span>
	</div>
	<div id="navigation">
	<ul>
		<?php
        
        foreach($navigation['navigation'] as $nav)
        {
            echo $nav;
        }
        
		?>
	</ul>	
	</div>
</div>