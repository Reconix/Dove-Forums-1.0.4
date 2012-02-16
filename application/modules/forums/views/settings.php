<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

foreach ($user_profile as $row)
{
?>
<h1>Change Settings</h1>
<?php echo form_open('forums/update_settings/'.$row['username'].'', 'class="form"'); ?>
<div class="page_list">
<ul>
    <div class="general">
    <div class="general_inner_border">
    
    <li>
        <h3><?php echo $this->lang->line('settingsProfileFirstName'); ?></h3>
        <input type="text" name="first_name" size="50" value="<?php echo $row['first_name']; ?>" class="textbox" /><?php echo $this->lang->line('settingsHintFirstName'); ?><br />
    
        <h3><?php echo $this->lang->line('settingsProfileLastName'); ?></h3>
        <input type="text" name="last_name" size="50" value="<?php echo $row['last_name']; ?>" class="textbox" /><?php echo $this->lang->line('settingsHintLastName'); ?><br />
    
        <h3><?php echo $this->lang->line('settingsProfileGender'); ?></h3>
        <input type="text" name="gender" size="50" value="<?php echo $row['gender']; ?>" class="textbox" /><?php echo $this->lang->line('settingsHintGender'); ?><br />
    </li>
    <li>
        <h3><?php echo $this->lang->line('settingsProfileOccupation'); ?></h3>
        <input type="text" name="occupation" size="50" value="<?php echo $row['occupation']; ?>" class="textbox" /><?php echo $this->lang->line('settingsHintOccupation'); ?><br />
    
        <h3><?php echo $this->lang->line('settingsProfileLocation'); ?></h3>
        <input type="text" name="location" size="50" value="<?php echo $row['location']; ?>" class="textbox" /><?php echo $this->lang->line('settingsHintLocation'); ?><br />
        
        <h3><?php echo $this->lang->line('settingsProfileInterests'); ?></h3>
        <input type="text" name="interests" size="50" value="<?php echo $row['interests']; ?>" class="textbox" /><?php echo $this->lang->line('settingsHintInterests'); ?><br />
    </li>
    <li>
    <br />
        <?php echo form_submit('submit', $this->lang->line('settingsProfileButton'), 'class="btn_alt"');?>
        <div class="clear">&nbsp;</div>
    </li>
    </div>
    </div>
</ul>
</div>
</form>
<?php
} // End of foreach