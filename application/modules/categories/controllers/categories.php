<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('categories');
		$this->load->model('categories_m');
	}
	
	public function index()
	{				
		$data['categories'] = $this->categories_m->get_categories();					
		$this->load->view('categories', $data);		
	}
}