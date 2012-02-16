<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->language('search');
	}
	
	public function index()
	{
        $this->load->view('search');
    }
 }