<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Messages View 
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		© 2010 - 2011 Dove Forums
* @last modified	31/01/2011
**/

// All site error messages template.
if($Error)
{
echo '<div id="errorBox">
	<h3>'.$errorMessageTitle.'</h3>
    <p>'.$Error.'</p>
	</div>';
}

// All site messages template.
if($Message)
{
	echo '<div id="successBox">
	<h3>'.$successMessageTitle.'</h3>
	<p>'.$Message.'</p>
	</div>';
}
#End of file 'views/sections/messages.php