	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<?php

				if(!$this->ion_auth->logged_in())
				{
					echo '<h2>'.$this->lang->line('topWelcomeTo').''.$siteName.'</h2>';
					echo '<p class="grey">'.$welcomeMessage.'</p>';
				}

				if($this->ion_auth->logged_in())
				{
					echo '<h1>'.$this->lang->line('topWelcome').''.$this->session->userdata('username').'</h1>';
					echo '<div class="avatar"><img src="'.$this->users_m->gravatar($this->session->userdata('email'), "x", "60").'" alt="'.$this->lang->line('avatarAltText').'" title="'.$this->session->userdata('username').''.$this->lang->line('avatarTitle').'" height="60px" width="60px"/></div>';
					echo '<p><a href="'.site_url().'/forums/change_password/">'.$this->lang->line('topChangePassword').'</a></p>';
					echo '<p><a href="'.site_url().'/forums/settings/">'.$this->lang->line('topChangeSettings').'</a></p>';
					echo '<p><a href="'.site_url().'/forums/logout/">'.$this->lang->line('topLogout').'</a></p>';
				}
				?>
			</div>
			<div class="left">
				<?php 

				if(!$this->ion_auth->logged_in())
				{
					echo '<!-- Login Form -->
							<form class="clearfix" action="'.site_url().'/forums/login" method="post">
							<h2>'.$this->lang->line('topMemberLogin').'</h2>
							<label class="grey" for="email">'.$this->lang->line('topEmail').'</label>
							<input class="field" type="text" name="email" id="email" value="" size="23" />
							<label class="grey" for="password">'.$this->lang->line('topPassword').'</label>
							<input class="field" type="password" name="password" id="password" size="23" />
							<label><input name="remember" id="remember" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>
							<div class="clear"></div>
							<input type="submit" name="Login" value="'.$this->lang->line('topLogin').'" class="bt_login" />
							<a class="lost-pwd" href="forums/forgot_password">'.$this->lang->line('topLostPassword').'</a>
							</form>
					';
				}
				?>
			</div>
			<div class="left right">
				<?php
                
				if(!$this->ion_auth->logged_in())
				{
					echo '
					<!-- Register Form -->
					<form action="'.site_url().'/forums/register" method="post">
						<h2>'.$this->lang->line('topNotMember').'</h2>				
						<label class="grey" for="username">'.$this->lang->line('topUsername').'</label>
						<input class="field" type="text" name="username" id="username" value="" size="23" class="textbox" />
						'.form_error('username').'
						<label class="grey" for="email">'.$this->lang->line('topEmail').'</label>
						<input class="field" type="text" name="email" id="email" size="23" />
						'.form_error('email').'
						<label>A password will be e-mailed to you.</label>
						<input type="submit" name="Register" value="'.$this->lang->line('topRegister').'" class="bt_register" />
					</form>';
				}
				?>
			</div>
		</div>
	</div>