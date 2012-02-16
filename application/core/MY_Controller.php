<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

class MY_Controller extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Load required files	
        /* Language Files */	
		$this->load->language('forums/messages');	
		$this->load->language('core/core');
		$this->load->language('forums/forums');
        /* Model Files */
		$this->load->model('forums/topics_m');
		$this->load->model('core/core_m');
		$this->load->model('forums/topics_m');
		$this->load->model('forums/users_m');
		$this->load->model('forums/posts_m');
		$this->load->model('categories/categories_m');
        /* Libray Files */
        $this->load->library('plugins');
        /* Extra */
		$this->sSettings = $this->topics_m->get_settings();
        
        // Load the required admin files
        /* Language files */
		$this->load->language('admin/admin');
		$this->load->language('admin/admin_messages');
        /* Model Files */
		$this->load->model('admin/admin_m');
		
		/* Load messages sitewide */		
		$this->Message      = $this->session->flashdata('message');		
		$this->Error        = $this->session->flashdata('error');		
		$this->Warning      = $this->session->flashdata('warning');	
		$this->val_message  = $this->session->flashdata('val_message');
		
		/* Load message titles */		
		$this->messageTitle = $this->lang->line('messageTitle');		
		$this->errorTitle   = $this->lang->line('errorTitle');		
		$this->warningTitle = $this->lang->line('warningTitle');
		
		/* Load sitewide settings */
		$this->siteName   = $this->sSettings[0]['sName'];
		$this->adminEmail = $this->sSettings[0]['adminEmail'];
        $this->siteTheme  = $this->sSettings[0]['siteTheme'];
		$this->siteLayout = $this->sSettings[0]['themeLayout'];
		$this->adminTheme = $this->sSettings[0]['adminTheme'];
        $this->forumInstalled = $this->sSettings[0]['forumInstalled'];
        $this->useGravatars = $this->sSettings[0]['useGravatars'];
        $this->loggedIn = $this->ion_auth->logged_in();
        
        if(!$this->session->userdata('topicsOrder'))
        {
            $this->session->set_userdata('topicsOrder', 'desc');
        }
	}
    
    public function build_navigation()
    {
        $data['navigation'] = array();
        
        if($this->forumInstalled == '1')
        {
            array_push($data['navigation'], '<li><a href="'.site_url().'/forums/">Discussions</a></li>');
        }
        
		if($this->ion_auth->logged_in())
		{
			if($this->ion_auth->is_admin())
			{
				array_push($data['navigation'], '<li><a href="'.site_url().'/admin">Admin</a></li>');
			}
		}
            
        $data['navigation'] = do_action('forums.navigation.links', $data['navigation']);
        
        return $data;
    }
	
	public function forums_page_construct($page, $title, $data)
	{
        // [HOOK] Before anything is run in the forums page construct
        do_action('pre.forums.construct');
        
		$this->template->set_partial('header', 'core/main/header');
		$this->template->set_partial('toppanel', 'core/main/toppanel');
		$this->template->set_partial('page_header', 'forums/sections/page_header');
		$this->template->set_partial('messages', 'core/sections/messages');
		$this->template->set_partial('footer', 'core/main/footer');
        
        // [HOOK] forums page keywords hook (allows plugins to modify keywords)
        $keywords = do_action('forums.meta.keywords', $this->sSettings[0]['siteKeywords']);
        
        // [HOOK] Forums page description
        $description = do_action('forums.meta.description', $this->sSettings[0]['siteDescription']);
		
		// Build site meta data
		$this->template->set_metadata('keywords', $keywords);
		$this->template->set_metadata('description', $description);
        
        // [HOOK] Set the theme to use for forum pages
        $sitetheme = do_action('forums.sitetheme', $this->siteTheme);
        
        // [HOOK] Set layout for forum pages
        $sitelayout = do_action('forums.sitelayout', $this->siteLayout);
		
		// Get the sites theme 
		$this->template->set_theme($sitetheme);
		$this->template->set_layout($sitelayout);
        
        // [HOOK] Forums page title
        $title = do_action('forums.page.title', $title);
        
        // [HOOK] Forums page view
        $page = do_action('forums.page.view', $page);
        
        // [HOOK] Forums page data
        $data = do_action('forums.page.data', $data);
		
		// Construct the template
		$this->template->title($title);
		$this->template->build($page, $data);
        
        // [HOOK] Called after everything has run successfully
        do_action('post.forums.construct');
	}
	
	public function admin_construct($page, $title, $data)
	{
        // [HOOK] Before anything is run in the admin page construct
        do_action('pre.admin.construct');
        
        // Default admin layout
        $default_layout = "admin";
        
		// Build the template sections
		$this->template->set_partial('header', 'admin/main/header');
		$this->template->set_partial('page_header', 'admin/sections/page_header');
		$this->template->set_partial('navigation', 'admin/sections/navigation');
		$this->template->set_partial('left_sidebar', 'admin/sections/left_sidebar');
		$this->template->set_partial('messages', 'admin/sections/messages');
		$this->template->set_partial('footer', 'admin/main/footer');
        
        // [HOOK] Admin page meta keywords
        $keywords    = do_action('admin.meta.keywords', $this->sSettings[0]['siteKeywords']);
        
        // [HOOK] Admin page meta description
        $description = do_action('admin.meta.description', $this->sSettings[0]['siteDescription']);
        
        // Build site meta data
        $this->template->set_metadata('keywords', $keywords);
        $this->template->set_metadata('description', $description);
        
        // [HOOK] Set the theme to use for forum pages
        $sitetheme = do_action('admin.sitetheme', $this->siteTheme);
        
        // [HOOK] Set layout for forum pages
        $sitelayout = do_action('admin.sitelayout', $default_layout);
        
        // Get the sites theme 
        $this->template->set_theme($sitetheme);
        $this->template->set_layout($sitelayout);
        
        // [HOOK] Blog page title
        $title = do_action('admin.page.title', $title);
        
        // [HOOK] Blog page view
        $page = do_action('admin.page.view', $page);
        
        // [HOOK] Blog page data
        $data = do_action('admin.page.data', $data);
        
		// Construct the template
		$this->template->title($title);
		$this->template->build($page, $data);
        
        // [HOOK] Called after everything has run successfully
        do_action('post.admin.construct');
	}

	public function create_random_password() 
	{
        // [HOOK] Create random password
        do_action('pre.generate.password');
        
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";

		srand((double)microtime()*1000000);

		$i = 0;
		$pass = '' ;
	
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
        
        // [HOOK] Allow the contents of the random password to be used
        $pass = do_action('string.random.password', $pass);
        
		return $pass;
        
        // [HOOK] After the password has been generated and returned
        do_action('post.generate.password');        
	}
}