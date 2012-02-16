<?php

if($categories)
{
?>
<div class="sidebar_box">
<div class="sidebar_heading"><h3><?php echo $this->lang->line('categoriesHeader'); ?></h3></div>
	<ul>
		<?php
		
		// Build all top level categories
		foreach($categories as $row)
		{
            if($this->uri->segment(1) == 'forums')
            {
                echo '<li>'.anchor(''.site_url().'/forums/topics/'.$row['CategoryID'].'', ''.$row['Name'].'').'</li>';
                $sub_categories = $this->categories_m->get_sub_categories($row['CategoryID']);
                foreach($sub_categories as $sub_row)
                {
				    echo '<li>'.anchor(''.site_url().'/forums/topics/'.$sub_row['CategoryID'].'', '-- '.$sub_row['Name'].'').'</li>';
                }
            }
		}
		
		?>
	</ul>
</div>
<?php
}
?>