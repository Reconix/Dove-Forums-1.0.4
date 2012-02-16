<?php

if($bookmarks)
{
?>
<div class="sidebar_box">
<div class="sidebar_heading"><h3><?php echo $this->lang->line('bookmarksSidebarHeading'); ?></h3></div>
	<ul>
		<?php
		
		// Build all top level categories
		foreach($bookmarks as $row)
		{
            echo '<li>'.anchor('forums/posts/'.$this->topics_m->get_cat_id($row['bookmark_topic_id']).'/'.$row['bookmark_topic_id'].'', $row['bookmark_topic_title']).'</li>';
		}
		
		?>
	</ul>
</div>
<?php
}
?>