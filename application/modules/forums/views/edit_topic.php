<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

echo '<h1>'.$this->lang->line('editTopicHeader').'</h1>';

echo '

'.form_open('forums/update_topic', 'class="form"').'

<div class="page_list">
<ul>
    <div class="general">
    <div class="general_inner_border">
	<li>
		<h3>'.$this->lang->line('section1Title').'</h3>
		'.form_input($Title).''.$this->lang->line('hintDiscussionTitle').'
	</li>
	<li>
		<h3>'.$this->lang->line('section3Title').'</h3>
		'.form_textarea($Body).''.$this->lang->line('hintDiscussionBody').'
	</li>';
	if($this->ion_auth->logged_in())
	{
		if($this->ion_auth->is_admin())
		{
		echo '
		<li>
			<h3>'.$this->lang->line('section4Title').'</h3>
				'.form_checkbox($Sticky).''.$this->lang->line('sticky').''.$this->lang->line('hintDiscussionSticky').'<br>
				'.form_checkbox($Close).''.$this->lang->line('close').''.$this->lang->line('hintDiscussionClosed').'
		</li>';
		}
        if($this->ion_auth->is_group('moderators'))
        {
            if($modsStickyDiscussions == '1' || $modsCloseDiscussions == '1')
            {
                echo '
                <li>
                    <h3>'.$this->lang->line('section4Title').'</h3>';
                        if($modsStickyDiscussions == '1')
                        {
                            echo ''.form_checkbox($Sticky).''.$this->lang->line('sticky').''.$this->lang->line('hintDiscussionSticky').'<br>';
                        }
                        if($modsCloseDiscussions == '1')
                        {
                            echo ''.form_checkbox($Close).''.$this->lang->line('close').''.$this->lang->line('hintDiscussionClosed').'<br>';                        
                        }
                echo '</li>';
            }
        }
        if($this->ion_auth->is_group('members'))
        {
            if($canStickyDiscussions == '1' || $canCloseDiscussions == '1')
            {
                echo '
                <li>
                    <h3>'.$this->lang->line('section4Title').'</h3>';
                        if($canStickyDiscussions == '1')
                        {
                            echo ''.form_checkbox($Sticky).''.$this->lang->line('sticky').''.$this->lang->line('hintDiscussionSticky').'<br>';
                        }
                        if($canCloseDiscussions == '1')
                        {
                            echo ''.form_checkbox($Close).''.$this->lang->line('close').''.$this->lang->line('hintDiscussionClosed').'<br>';                        
                        }
                echo '</li>';                
            }
        }
	}
	echo '
	<li>
        '.form_hidden('topic_id', $this->uri->segment(3)).'
        '.form_hidden('comment_id', $comment_id).'
        '.form_submit($update_discussion).'
        <div class="clear">&nbsp;</div>
	</li>
</div>
</div>
</ul>
</div>
'.form_close().'';