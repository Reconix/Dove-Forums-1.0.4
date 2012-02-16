<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

echo '<h1>'.$this->lang->line('newTopicHeader').'</h1>';

echo '

'.form_open('forums/submit_topic', 'class="form"').'

<div class="page_list">
<ul>
    <div class="general">
    <div class="general_inner_border">
	<li>
		<h3>'.$this->lang->line('section1Title').'</h3>
		'.form_input($Title).''.$this->lang->line('newTopicHintDiscussionTitle').'
	</li>
	<li>
		<h3>'.$this->lang->line('section2Title').'</h3>
		'.form_dropdown('category', $category_options, 'class="dropdown"').''.$this->lang->line('newTopicHintCategory').'
	</li>
	<li>
		<h3>'.$this->lang->line('section3Title').'</h3>
		'.form_textarea($Comments).''.$this->lang->line('newTopicHintDiscussionBody').'
	</li>';
	if($this->ion_auth->logged_in())
	{
		if($this->ion_auth->is_admin())
		{
		echo '
		<li>
			<h3>'.$this->lang->line('section4Title').'</h3>
				'.form_checkbox($Sticky).''.$this->lang->line('sticky').''.$this->lang->line('newTopicHintSticky').'<br>
				'.form_checkbox($Close).''.$this->lang->line('close').''.$this->lang->line('newTopicHintClosed').'
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
                            echo ''.form_checkbox($Sticky).''.$this->lang->line('sticky').''.$this->lang->line('newTopicHintSticky').'<br>';
                        }
                        if($modsCloseDiscussions == '1')
                        {
                            echo ''.form_checkbox($Close).''.$this->lang->line('close').''.$this->lang->line('newTopicHintClosed').'<br>';                        
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
                            echo ''.form_checkbox($Sticky).''.$this->lang->line('sticky').''.$this->lang->line('newTopicHintSticky').'<br>';
                        }
                        if($canCloseDiscussions == '1')
                        {
                            echo ''.form_checkbox($Close).''.$this->lang->line('close').''.$this->lang->line('newTopicHintClosed').'<br>';                        
                        }
                echo '</li>';                
            }
        }
	}
	echo '
	<li>
        '.form_submit($postDiscussion).'
        <div class="clear">&nbsp;</div>
	</li>
</div>
</div>
</ul>
</div>
'.form_close().'';