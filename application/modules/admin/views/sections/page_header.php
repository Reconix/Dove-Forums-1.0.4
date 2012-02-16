<div id="header">
	<?php echo ''.$this->lang->line('hello').' '.$this->session->userdata('username').' - '.anchor('forums/logout/', $this->lang->line('logout'), 'title="'.$this->lang->line('logout').'"').''; ?>
</div>