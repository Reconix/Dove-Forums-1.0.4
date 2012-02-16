<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!$user_profile)
{
	echo '<h1>'.$this->lang->line('sNoProfile').'</h1>';
}
else
{
	echo '<h1>'.$this->lang->line('profileSection1').'</h1>';
}

echo '<div class="page_list">';
echo '<ul>';
echo '<div class="general">';
echo '<div class="general_inner_border">';
foreach ($user_profile as $row) 
{
	echo '<li class="alt">';

		if ($row['first_name']) 
		{
			echo '<h3>'.$this->lang->line('profileFirstName').'</h3> '.$row['first_name'].'';
		}

		if ($row['last_name'])
		{
			echo '<h3>'.$this->lang->line('profileLastName').'</h3> '.$row['last_name'].'';
		}

		if ($row['gender'])
		{		
			echo '<h3>'.$this->lang->line('profileGender').'</h3> '.$row['gender'].'';
		}

	echo '</li>';
	echo '<li>';

	    if ($row['occupation'])
	    {
			echo '<h3>'.$this->lang->line('profileOccupation').'</h3> '.$row['occupation'].'';
		}
        
		if ($row['location'])
		{
			echo '<h3>'.$this->lang->line('profileLocation').'</h3>	'.$row['location'].'';
		}

		if ($row['interests'])
		{
			echo '<h3>'.$this->lang->line('profileInterests').'</h3> '.$row['interests'].'';
		}	

	echo '</li>';
	echo '<li class="alt">';
		echo '<h3>'.$this->lang->line('profileJoined').'</h3>
		'.$this->timeword->convert($row['created_on'], time()).' '.$this->lang->line('agoText').'';
		echo '<h3>'.$this->lang->line('profileLastActive').'</h3>
		'.$this->timeword->convert($row['last_login'], time()).' '.$this->lang->line('agoText').'';
		echo '<h3>'.$this->lang->line('profileTotalPosts').'</h3>
		'.$this->posts_m->count_total_posts($row['username']).'';
	echo '</li>';
    if(!$extra)
    {
        // Do nothing
    } else {
        echo $extra;
    }
}
echo '</div>';
echo '</div>';
echo '</ul>';
echo '</div>';

# End of file /views/profile.php