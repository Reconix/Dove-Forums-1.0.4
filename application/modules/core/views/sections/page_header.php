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
		
		if($blogInstalled == '1')
		{
			echo '<li><a href="'.site_url().'/blog/">Blog</a></li>';
		}
		if($forumsInstalled == '1')
		{
			echo '<li><a href="'.site_url().'/forums/">Discussions</a></li>';
		}
		?>
		<?php
		if($this->ion_auth->logged_in())
		{
			if($this->ion_auth->is_admin())
			{
				echo '<li><a href="'.site_url().'/admin">Admin</a></li>';
			}
		}
		?>
	</ul>	
	</div>
		<div id="search">
		<form method="post" id="searchform" action="<?php echo ''.site_url().'/forums/search'; ?>">
			<fieldset class="search">
			<input name="search" type="text" class="box" />
			<button class="btn" title="Submit Search">Search</button>
			</fieldset>
		</form>
		</div>
</div>