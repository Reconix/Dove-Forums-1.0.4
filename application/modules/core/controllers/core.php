<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Forums Controller 
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		© 2010 - 2011 Dove Forums
* @last modified	17/05/2011
**/
class Core extends MY_Controller {
	
	/**
	* Constructor Method
	**/	
	public function __construct()
	{
		//Call constructor
		parent::__construct();	
        $this->load->helper('directory');
	}
	
	public function index()
	{
        if($this->sSettings[0]['forumInstalled'])
        {
            // The forums package is installed so redirect them to the forums
			$this->redirect('forums');
        }
		else
		{
			// Neither modules are installed so lets launch setup;
			redirect('installer/');
		}
	}
	
	public function redirect($method=NULL)
	{
		$action = $method;
		
		switch($action){
		
		case 'forums':
		
			// Lets redirect the user to the forums controller
			redirect('forums');
		
		break;
		
		}
	}
    
    public function get_all_plugins()
    {
        $data = array();
        $this->plugins_dir = FCPATH . "plugins/";   
        $plugins = directory_map($this->plugins_dir, 1);
        
        if($plugins !== false)
        {
            foreach($plugins as $key => $name)
            {
                $name = strtolower(trim($name));
                $data[] = $name;
            }
            return $data;
        }
    }
    
    public function install_plugin($name)
    {
        $this->core_m->install_plugin($name);
    }	
    
    public function uninstall_plugin($name)
    {
        $this->core_m->uninstall_plugin($name);
    }
}