<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Check whether the site is offline or not.
 *
 */
class site_installed_hook {

    public function __construct()
    {
    log_message('debug','Accessing site_installed hook!');
    }
    
    public function site_installed()
    {
    if(file_exists(APPPATH.'config/config.php'))
    {
        include(APPPATH.'config/config.php');
        
        if(isset($config['site_installed']) && $config['site_installed']===FALSE)
        {
        $this->show_install();
        exit;
        }
    }
    }

    private function show_install()
    {
   echo '<html><body>The site is not installed, please click <a href="install.php">HERE</a> to install..</body></html>';
    }

}
/* Location: ./system/application/hooks/site_installed_hook.php */