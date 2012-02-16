<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Bookmarks Controller 
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		© 2010 - 2011 Dove Forums
* @last modified	31/01/2011
**/
class Bookmarks extends MY_Controller {
	
	/**
	* Constructor Method
	**/	
	public function __construct()
	{
		//Call constructor
		parent::__construct();
        
        $this->load->model('bookmarks_m');
        $this->load->language('bookmarks'); 
	}
 
    public function index()
    {
        if($this->ion_auth->logged_in())
        {
            /**
            * The user is logged in, load there bookmarks and show the box
            **/
            $data['bookmarks'] = $this->bookmarks_m->get_bookmarks($this->session->userdata('user_id'));
            $this->load->view('bookmarks', $data);          
        }
    }   
}