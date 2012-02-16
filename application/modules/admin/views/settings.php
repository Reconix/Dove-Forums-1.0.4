<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
*
* Admin Settings View 
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		© 2010 - 2011 Dove Forums
* @last modified	03/02/2011
**/
?>

<div class="header_bg"><h1><?php echo $this->lang->line('forumsSettings'); ?></h1></div>
<div class="content_box">

<?php echo form_open('admin/settings/update/', 'class="form"'); ?>
<ul>
    <li>
        <h3><?php echo $this->lang->line('forumsSettings'); ?></h3>
        <p><?php echo $this->lang->line('siteName'); ?><br><?php echo form_input($sName); ?><?php echo $this->lang->line('hintSiteName'); ?></p>
        <p><?php echo $this->lang->line('adminEmail'); ?><br><?php echo form_input($adminEmail); ?><?php echo $this->lang->line('hintAdminEmail'); ?></p>
        <p><?php echo $this->lang->line('siteUrl'); ?><br><?php echo form_input($siteUrl); ?><?php echo $this->lang->line('hintSiteUrl'); ?></p>
        <p><?php echo $this->lang->line('siteLanguage'); ?><br><?php echo form_input($siteLanguage); ?><?php echo $this->lang->line('hintSiteLanguage'); ?></p>
        <p><?php echo $this->lang->line('siteKeywords'); ?><br><?php echo form_textarea($siteKeywords); ?><?php echo $this->lang->line('hintSiteKeywords'); ?></p>
        <p><?php echo $this->lang->line('siteDescription'); ?><br><?php echo form_textarea($siteDescription); ?><?php echo $this->lang->line('hintSiteDescription'); ?></p><br>
    </li>
    <li>
        <h3><?php echo $this->lang->line('loginRegistration'); ?></h3>
        <p><?php echo $this->lang->line('allowRegistration'); ?><?php echo form_checkbox($allowRegistration); ?><?php echo $this->lang->line('hintAllowRegistration'); ?></p>
    </li>
    <li>
        <h3><?php echo $this->lang->line('discussionsPosts'); ?></h3>
        <p><?php echo $this->lang->line('topicsPerPage'); ?><br><?php echo form_input($topicsPerPage); ?><?php echo $this->lang->line('hintTopicsPerPage'); ?></p>
        <p><?php echo $this->lang->line('postsPerPage'); ?><br><?php echo form_input($postsPerPage); ?><?php echo $this->lang->line('hintPostsPerPage'); ?></p><br>
    </li>
    <li>
        <h3><?php echo $this->lang->line('userSettings'); ?></h3>
        <p><?php echo $this->lang->line('editOwnPosts'); ?><?php echo form_checkbox($editOwnPosts); ?><?php echo $this->lang->line('hintEditOwnPosts'); ?></p>
        <p><?php echo $this->lang->line('deleteOwnPosts');?><?php echo form_checkbox($deleteOwnPosts); ?><?php echo $this->lang->line('hintDeleteOwnPosts'); ?></p>
        <p><?php echo $this->lang->line('editOwnDiscussions'); ?><?php echo form_checkbox($editOwnDiscussions); ?><?php echo $this->lang->line('hintEditOwnDiscussions'); ?></p>
        <p><?php echo $this->lang->line('deleteOwnDiscussions'); ?><?php echo form_checkbox($deleteOwnDiscussions); ?><?php echo $this->lang->line('hintDeleteOwnDiscussions'); ?></p>
        <p><?php echo $this->lang->line('stickyOwnDiscussions'); ?><?php echo form_checkbox($canStickyDiscussions); ?><?php echo $this->lang->line('hintStickyOwnDiscussions'); ?></p>
        <p><?php echo $this->lang->line('closeOwnDiscussions'); ?><?php echo form_checkbox($canCloseDiscussions); ?><?php echo $this->lang->line('hintCloseOwnDiscussions'); ?></p>
    </li>
    <li>
        <h3><?php echo $this->lang->line('moderatorSettings'); ?></h3>
        <p><?php echo $this->lang->line('moderatorsEditPosts'); ?><?php echo form_checkbox($modsEditPosts); ?><?php echo $this->lang->line('hintModeratorsEditPosts'); ?></p>
        <p><?php echo $this->lang->line('moderatorsDeletePosts'); ?><?php echo form_checkbox($modsDeletePosts); ?><?php echo $this->lang->line('hintModeratorsDeletePosts'); ?></p>
        <p><?php echo $this->lang->line('moderatorsEditDiscussions'); ?><?php echo form_checkbox($modsEditDiscussions); ?><?php echo $this->lang->line('hintModeratorsEditDiscussions'); ?></p>
        <p><?php echo $this->lang->line('moderatorsDeleteDiscussions'); ?><?php echo form_checkbox($modsDeleteDiscussions); ?><?php echo $this->lang->line('hintModeratorsDeleteDiscussions'); ?></p>
        <p><?php echo $this->lang->line('moderatorsStickyDiscussions'); ?><?php echo form_checkbox($modsStickyDiscussions); ?><?php echo $this->lang->line('hintModeratorsStickyDiscussions'); ?></p>
        <p><?php echo $this->lang->line('moderatorsCloseDiscussions'); ?><?php echo form_checkbox($modsCloseDiscussions); ?><?php echo $this->lang->line('hintModeratorsCloseDiscussions'); ?></p>
    </li>
    <li>
        <h3><?php echo $this->lang->line('themeSettings'); ?></h3>
        <p><?php echo $this->lang->line('siteTheme'); ?><br><?php echo form_dropdown('theme', $theme_options, 'class="dropdown"'); ?><?php echo $this->lang->line('hintSiteTheme'); ?></p><br>
    </li>
    <li>
        <?php echo form_submit('submit', $this->lang->line('updateSettingsButton'));?> 
    </li>
</ul>

<?php echo form_close(); ?>

</div>