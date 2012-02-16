<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Forums Controller 
*
* @author			Chris Baines
* @package			Dove Forums
* @copyright		© 2010 - 2011 Dove Forums
* @last modified	31/01/2011
**/
class Forums extends MY_Controller {
	
	/**
	* Constructor Method
	**/	
	public function __construct()
	{
		//Call constructor
		parent::__construct();
		
		// Load authentication model
		$this->load->model('ion_auth_model');
		
		// Load required language files
		$this->load->language('forums');
		$this->load->language('messages');
		
		$module = 'forums';
	}
		
	/**
	* Index Function - List all topics, no category selected
	**/	
	public function index($limit='', $offset='')
	{	
		/**
		* Setup config settings for pagination
		*
		* @base_url - The base url for the pagination.
		* @total_rows - The total number of returned rows.
		* @url_segment - Part of url to look at for pagination offset.
        * @per_page - Setting for topics to show per page.
		**/
		$config['base_url'] = site_url().'/forums/index/';
		$config['total_rows'] = $this->topics_m->count_topics(); 
		$config['uri_segment'] = 3;
		$config['per_page'] = $this->sSettings[0]['topicsPerPage'];
		
		/**
		* Initialize the pagination
		**/
		$this->pagination->initialize($config);
		
		/**
		* Build links for the pagination
		**/		
		$links = $this->pagination->create_links();
        
        /**
        * Offset & Limit for topics query
        **/
	   	$limit = $this->sSettings[0]['topicsPerPage'];
	   	$offset = $this->uri->segment(3); // For pagination

		/**
		* Construct the data array for the page
		**/
		$data = array(
			'siteName' 				=> $this->siteName,			
			'siteTheme' 			=> $this->siteTheme,
			'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],
			'topics' 				=> $this->topics_m->get_topics($limit, $offset),
			'categories' 			=> $this->categories_m->get_categories(),
			'category' 				=> $this->lang->line('noCategory'),
			'errorMessageTitle' 	=> $this->errorTitle,
			'Error' 				=> $this->Error,
			'successMessageTitle' 	=> $this->messageTitle,
			'Message' 				=> $this->Message,
			'links' 				=> $links,
			'forumsInstalled'		=> $this->forumInstalled,
            'navigation'            => $this->build_navigation(),
            'deleteOwnDiscussions'  => $this->sSettings[0]['deleteOwnDiscussions'],
            'editOwnDiscussions'    => $this->sSettings[0]['editOwnDiscussions'],
            'modsEditDiscussions'   => $this->sSettings[0]['modsEditDiscussions'],
            'modsDeleteDiscussions' => $this->sSettings[0]['modsDeleteDiscussions'],
		);
				
		/**
		* Send page to the page constructor
		**/
		$page = $this->sSettings[0]['forumsLayout'];
		$title = $this->lang->line('titleHome');
		$this->forums_page_construct($page, $title, $data, 'forums');
		
		/**
		* Log 
		**/
		log_message('debug', 'Index function executed successfully! - /modules/forums/controllers/forums/index');
		/**
		* Benchmark
		**/
		$this->output->enable_profiler(FALSE); 
	}

	/**
	* Topics Function - List all topics in a category with pagination
	**/		
	public function topics($category='', $offset='')
	{		
		/**
		* Setup config settings for pagination
		*
		* @base_url - The base url for the pagination
		* @total_rows - The total number of returned rows
		* @url_segment - Part of url to look at for pagination offset
        * @per_page - Setting for topics to show per page.
		**/
		$config['base_url'] = site_url().'/forums/topics/'.$this->uri->segment(3).'';
		$config['total_rows'] = $this->topics_m->count_cat_topics($category); 
		$config['uri_segment'] = 4;
		$config['per_page'] = $this->sSettings[0]['topicsPerPage'];
		
		/**
		* Initialize the pagination
		**/
		$this->pagination->initialize($config);
		
		/**
		* Build links for the pagination
		**/		
		$links = $this->pagination->create_links();
        
        /**
        * Limit & Offset for topics query
        **/
		$limit = $this->sSettings[0]['topicsPerPage'];
		$offset = $this->uri->segment(4);

		/**
		* Construct the data array for the page
		**/
		$data = array(
			'siteName' 				=> $this->siteName,			
			'siteTheme' 			=> $this->siteTheme,
			'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],			
			'topics' 				=> $this->topics_m->get_cat_topics($category, $limit, $offset), 	
			'pagination' 			=> $this->pagination->create_links(),
			'categories'			=> $this->categories_m->get_categories(),
			'category' 				=> $this->categories_m->get_current_cat($category),
			'errorMessageTitle' 	=> $this->errorTitle,
			'Error' 				=> $this->Error,
			'successMessageTitle' 	=> $this->messageTitle,
			'Message' 				=> $this->Message,
			'links' 				=> $links,
			'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
            'navigation'            => $this->build_navigation(),
            'deleteOwnDiscussions'  => $this->sSettings[0]['deleteOwnDiscussions'],
            'editOwnDiscussions'    => $this->sSettings[0]['editOwnDiscussions'],
            'modsEditDiscussions'   => $this->sSettings[0]['modsEditDiscussions'],
            'modsDeleteDiscussions' => $this->sSettings[0]['modsDeleteDiscussions'],
		);
		
		/**
		* Send page to the page constructor
		**/
		$page = 'forums';
		$title = $this->lang->line('titleTopics');
		$this->forums_page_construct($page, $title, $data);

		/**
		* Log 
		**/	
		log_message('debug', 'Topics function executed successfully! - /modules/forums/controllers/forums/topics');
		
		/**
		* Benchmark
		**/	
		$this->output->enable_profiler(FALSE);	 
	}	
	
	/**
	* Posts Function - List all posts in a category with pagination
	**/		
	public function posts($category_id=NULL, $topic_id=NULL, $offset=NULL)
    {
		/**
		* Setup config settings for pagination
		*
		* @base_url - The base url for the pagination
		* @total_rows - The total number of returned rows
		* @url_segment - Part of url to look at for pagination offset
        * @per_page - Setting for topics to show per page.
        * 
		**/
		$config['base_url'] = site_url().'/forums/posts/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'';
		$config['total_rows'] = $this->topics_m->count_posts($topic_id);
		$config['uri_segment'] = 5;
		$config['per_page'] = $this->sSettings[0]['postsPerPage']; 
		
		/**
		* Initialize the pagination
		**/
		$this->pagination->initialize($config);

		/**
		* Build links for the pagination
		**/		
		$links = $this->pagination->create_links();
        
        /**
        * Limit & Offset for topics query
        **/
        $limit = $this->sSettings[0]['postsPerPage'];
        $offset = $this->uri->segment(5);
        
        if($this->ion_auth->logged_in())
        {
            // Update the bookmarks table if the user is checking the post from there bookmark
            $data = array(
                'bookmark_replys' => '0',
            );
        
            $options = array(
                'bookmark_user_id' => $this->session->userdata('user_id'),
                'bookmark_topic_id' => $this->uri->segment(4),
            );
        
            $this->db->update('bookmarks', $data, $options);
        }

		/**
		* Construct the data array for the page
		**/
		$data = array(
			'siteName' 				=> $this->siteName,			
			'siteTheme' 			=> $this->siteTheme,
			'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],			
			'pagination' 			=> $this->pagination->create_links(),
			'categories' 			=> $this->categories_m->get_categories(),
			'category' 				=> $this->categories_m->get_current_cat($category_id),
			'errorMessageTitle' 	=> $this->errorTitle,
			'Error' 				=> $this->Error,
			'successMessageTitle' 	=> $this->messageTitle,
			'Message' 				=> $this->Message,
			'topicName' 			=> $this->topics_m->get_topic_name($topic_id),
            'firstPost'             => $this->topics_m->get_first_post($topic_id),
			'posts' 				=> $this->topics_m->get_posts($limit, $topic_id, $offset),
			'links' 				=> $links,
			'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
            'navigation'            => $this->build_navigation(),
            'editOwnPosts'          => $this->sSettings[0]['editOwnPosts'],
            'deleteOwnPosts'        => $this->sSettings[0]['deleteOwnPosts'],
            'modsEditPosts'         => $this->sSettings[0]['modsEditPosts'],
            'modsDeletePosts'       => $this->sSettings[0]['modsDeletePosts'],
		);	
		
		/**
		* Send page to the page constructor
		**/
		$page = 'posts';
		$title = ''.$this->categories_m->get_current_cat($category_id).' | '.$this->topics_m->get_topic_name($topic_id).'';
		$this->forums_page_construct($page, $title, $data);
		
		/**
		* Logs
		**/		
		log_message('debug', 'Posts function executed successfully! - /modules/forums/controllers/forums/posts');
		/**
		* Benchmark
		**/	
		$this->output->enable_profiler(FALSE);
    }

	/**
	* submit Post Function - Enters the post into the database via posts_m model
	**/		
	public function submit_post()
	{
		/**
		* Check to see if the user is logged in.
		**/	
		if(!$this->ion_auth->logged_in())
		{
			/**
			* The user is not logged in, redirect them with a message.
			**/	
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect('forums');
		}
		else
		{            
    		/**
    		* Logs
    		**/		
    		log_message('debug', 'Submit Post function executed successfully! - /modules/forums/controllers/forums/subit_post');
            
			/**
			* The user is logged in, submit there post.
			**/	
			$this->posts_m->submit_post();
		}
	}
	
	public function login()
	{
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		
		/**
		* Check to see if the user can login.
		**/	
		if($this->sSettings[0]['allowLogin'])
		{
			/**
			* Form validation settings.
			**/	
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');		
			$this->form_validation->set_rules('password', 'Password', 'required');				
		
			if($this->form_validation->run() == true)		
			{			
				if($this->input->post('remember') == '1')			
				{				
					$remember = true;			
				}			
				else			
				{				
					$remember = false;			
				}								
			
				if($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))			
				{								
					$data = array(
						'username' 			=> $this->session->userdata('username'),
						'date' 				=> time(),
						'activity' 			=> 'login',
					);				
					$this->db->insert('activity', $data);
				
					$this->session->set_flashdata('message', $this->lang->line('messageLoginSuccess'));
					redirect('forums', 'refresh');
				}			
				else			
				{					
					$this->session->set_flashdata('error', $this->lang->line('errorLoginFailed'));				
					redirect('forums', 'refresh');			
				}		
			}
			else
			{
				if($this->form_validation->run() == FALSE)		
				{			
					$this->session->set_flashdata('error', validation_errors());
					// Send the user back to the page they came from
					redirect($this->session->userdata('refered_from'));
				}
			}
		}
		else
		{	
			// Login feature is turned off, redirect the user and let them know.
			$this->session->set_flashdata('error', $this->lang->line('messageFeatureOff'));
			// Send the user back to the page they came from
			redirect($this->session->userdata('refered_from'));	
				
		}
		
		log_message('debug', 'Login function executed successfully! - /modules/forums/controllers/forums/login');			
		$this->output->enable_profiler(FALSE);	
	}	
	
	public function logout()
    {
		/**
		* Perform the logout.
		**/	
        $this->ion_auth->logout();
		
		/**
		* Redirect the user.
		**/	
		$this->session->set_flashdata('message', $this->lang->line('messageLogoutSuccess'));
        redirect('forums');
    }
		
	public function new_topic()	
	{	
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        
		if(!$this->ion_auth->logged_in())
		{
			/**
			* The user is not logged in, redirect them.
			**/	
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}
		else
		{	
			/**
			* Get all categories from the database.
			**/	
			$categories = $this->categories_m->get_categories();
            			
			/**
			* Create a dropdown box.
			**/	
            $category_options = array('0' => 'None Selected');
			foreach($categories as $row)		
			{
                $category_options[$row['CategoryID']] = $row['Name'];
				$subCategories = $this->categories_m->get_sub_categories($row['CategoryID']);
				foreach($subCategories as $sub_row)
				{
					$category_options[$sub_row['CategoryID']] = '-- '.$sub_row['Name'].'';
				}	
			}				
			/**
			* Build the form fields.
			**/	
			$title = array(			
				'name' 				=> 'title',
				'id' 				=> 'title',
				'type' 				=> 'text',
				'class' 			=> 'textbox',
			);			 		
	
			$comments = array(			
				'name' 				=> 'comment',			
				'id' 				=> 'comment',	
				'class'				=> 'textarea',
			);	

			$sticky = array(
				'name'        => 'Sticky',
				'class'       => 'checkbox',
				'value'       => '1',
				'checked'     => FALSE,
			);	

			$close = array(
				'name'		=> 'Close',
				'class'		=> 'checkbox',
				'value'		=> '1',
				'checked'	=> FALSE,
			);
			
			$postDiscussion = array(
				'name'		=> 'postDiscussion',
				'id'		=> 'postDiscussion',
				'class'		=> 'btn_alt',
				'type'		=> 'submit',
				'value'	=> $this->lang->line('newTopicButton'),
			);
			/**
			* Construct the data array for the page
			**/
			$data = array(			
				'siteName' 				=> $this->siteName,			
				'siteTheme' 			=> $this->siteTheme,
				'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],			
				'category_options' 		=> $category_options,			
				'Title' 				=> $title,			
				'Comments' 				=> $comments,	
				'Sticky'				=> $sticky,
				'Close'					=> $close,
				'postDiscussion'		=> $postDiscussion,
				'errorMessageTitle' 	=> $this->errorTitle,
				'Error' 				=> $this->Error,
				'successMessageTitle' 	=> $this->messageTitle,
				'Message' 				=> $this->Message,		
				'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
                'navigation'            => $this->build_navigation(),
                'modsStickyDiscussions' => $this->sSettings[0]['modsStickyDiscussions'],
                'modsCloseDiscussions'  => $this->sSettings[0]['modsCloseDiscussions'],
                'canStickyDiscussions'  => $this->sSettings[0]['canStickyDiscussions'],
                'canCloseDiscussions'   => $this->sSettings[0]['canCloseDiscussions'],
			);			

			/**
			* Send page to the page constructor
			**/
			$page = 'new_topic';
			$title = $this->lang->line('titleCreateNewDiscussion');
			$this->forums_page_construct($page, $title, $data);			
			/**
			* Logs
			**/	
			log_message('debug', 'new_topic function executed successfully! - /modules/forums/controllers/forums/new_topic');		
			/**
			* Benchmarking
			**/	
			$this->output->enable_profiler(FALSE); 
		}	
	}
    
    public function remove_bookmark($topicID)
    {
        /**
        * Store the page the user came from.
        **/
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        
        /**
        * Check to see if the user is logged in.
        **/
        if(!$this->ion_auth->logged_in())
        {
            /**
            * The user is not logged in, redrect them with a message.
            **/
            $this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
            redirect($this->session->userdata('refered_from'));
        }
        else
        {
            $bookmark = $this->topics_m->remove_bookmark($topicID);
            
            if($bookmark == true)
            {
                $this->session->set_flashdata('message', $this->lang->line('messageBookmarkRemoved'));
                redirect($this->session->userdata('refered_from'));
            }
            else
            {
                $this->session->set_flashdata('error', $this->lang->line('errorBookmarkRemoved'));
                redirect($this->session->userdata('refered_from'));
            }
        }
    }
    
    public function bookmark_topic($topicID)
    {
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        
        /**
        * Check to see if the user is loggen in.
        **/
        if(!$this->ion_auth->logged_in())
        {
            /**
            * The user is not logged in, redirect them with a message.
            **/
            $this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
            redirect($this->session->userdata('refered_from'));
        }
        else
        {
            $topicTitle = $this->topics_m->get_topic_name($topicID);
            
            $bookmark = $this->topics_m->add_bookmark($topicID, $topicTitle);
            
            if($bookmark == true)
            {
                $this->session->set_flashdata('message', $this->lang->line('messageBookmarkAdded'));
                redirect($this->session->userdata('refered_from'));
            }
            else
            {
                // There has being a error inserting the data, let the user know
                $this->session->set_flashdata('error', $this->lang->line('errorBookmarkFailed'));
                redirect($this->session->userdata('refered_from'));
            }
        }
    }
	
	public function submit_topic()	
	{	
		/**
		* Check to see if the user is logged in.
		**/		
		if(!$this->ion_auth->logged_in())
		{
			/**
			* The user is not logged in, redirect them with a message.
			**/	
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect('forums');		
		}
		else
		{
			/**
			* The user is logged in, submit there post.
			**/	
			$this->topics_m->submit_topic();	
		}
	}
    
    public function delete_topic($topic_id)
    {
		/**
		* Check to see if the user is logged in.
		**/		
		if(!$this->ion_auth->logged_in())
		{
			/**
			* The user is not logged in, redirect them with a message.
			**/	
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect('forums');		
		}
		else
		{
    		/**
    		* Store the page the user came from.
    		**/	 
    		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
            
            if($this->ion_auth->is_admin())
            {
                // The user is a admin let's delete the discussion.   
                if($this->topics_m->remove_discussion($topic_id))
                {
                    $this->session->set_flashdata('message', 'The discussion has being removed successfully!');
                    redirect($this->session->userdata('refered_from'));
                } 
            }
            if($this->ion_auth->is_group('moderators'))
            {
                // The user is a moderator, if they can delete discussions, let them.
                if($this->sSettings[0]['modsDeleteDiscussions'] == '1')
                {
                    if($this->topics_m->remove_discussion($topic_id))
                    {
                        $this->session->set_flashdata('message', 'The discussion has being removed successfully!');
                        redirect($this->session->userdata('refered_from'));
                    }else{
                        $this->session->set_flashdata('error', 'The discussion could not be removed, please try again!.');
                        redirect($this->session->userdata('refered_from'));
                    }
                }else{
                    $this->session->set_flashdata('error', 'Moderators do not have permissions to remove discussions!');
                    redirect($this->session->userdata('refered_from'));
                }
            }
            elseif($this->sSettings[0]['deleteOwnDiscussions'] == '1')
            {
                // The user has permission to remove there own discussion.
                if($this->topics_m->remove_discussion($topic_id))
                {
                    //Topic was removed, inform the user and redirect.
                    $this->session->set_flashdata('message', 'Your discussion has being removed successfully!');
                    redirect($this->session->userdata('refered_from'));
                }else{
                    //Something went wrong, inform the user and redirect.
                    $this->session->set_flashdata('error', 'You do not have permission to remove this discussion!.');
                    redirect($this->session->userdata('refered_from'));
                }    
            }           
        }
    }
    
    public function edit_topic($topic_id)
    {
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		
		if ($this->ion_auth->logged_in())
		{
            $discussion = $this->topics_m->get_topic($topic_id);
            
			/**
			* Get all categories from the database.
			**/	
			$categories = $this->categories_m->get_categories();
            			
			/**
			* Create a dropdown box.
			**/	
            $category_options = array('0' => 'None Selected');
			foreach($categories as $row)		
			{
                $category_options[$row['CategoryID']] = $row['Name'];
				$subCategories = $this->categories_m->get_sub_categories($row['CategoryID']);
				foreach($subCategories as $sub_row)
				{
					$category_options[$sub_row['CategoryID']] = '-- '.$sub_row['Name'].'';
				}	
			}	
            
            foreach($discussion as $row)
            {   
                $title = array(
                    'name' => 'title',
                    'id' => 'title',
                    'type' => 'text',
                    'value' => $row['TopicName'],
                    'class' => 'textbox',
                );
                
                $body = array(
                    'name' => 'body',
                    'id' => 'body',
                    'type' => 'text',
                    'value' => $row['Body'],
                    'class' => 'textarea',
                );
                
                if($row['Sticky'] == '1')
                {
                    $sticky = TRUE;
                } else {
                    $sticky = FALSE;
                }
                
                $sticky = array(
                    'name' => 'sticky',
                    'id' => 'sticky',
                    'value' => '1',
                    'class' => 'checkbox',
                    'checked' => $sticky,
                );
                
                if($row['Closed'] == '1')
                {
                    $closed = TRUE;
                } else {
                    $closed = FALSE;
                }
                
                $closed = array(
                    'name' => 'closed',
                    'id' => 'closed',
                    'value' => '1',
                    'class' => 'checkbox',
                    'checked' => $closed,
                );
                
                $update_discussion = array(
                    'name' => 'update_discussion',
                    'id' => 'update_discussion',
                    'class' => 'btn_alt',
                    'type' => 'submit',
                    'value' => $this->lang->line('updateTopicButton'),
                );
                
    			$data = array(			
    				'siteName' 				=> $this->siteName,			
    				'siteTheme' 			=> $this->siteTheme,
    				'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],						
    				'Title' 				=> $title,			
    				'Body' 				    => $body,	
    				'Sticky'				=> $sticky,
    				'Close'					=> $closed,
    				'update_discussion'		=> $update_discussion,
    				'errorMessageTitle' 	=> $this->errorTitle,
    				'Error' 				=> $this->Error,
    				'successMessageTitle' 	=> $this->messageTitle,
    				'Message' 				=> $this->Message,		
    				'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
                    'navigation'            => $this->build_navigation(),
                    'modsStickyDiscussions' => $this->sSettings[0]['modsStickyDiscussions'],
                    'modsCloseDiscussions'  => $this->sSettings[0]['modsCloseDiscussions'],
                    'canStickyDiscussions'  => $this->sSettings[0]['canStickyDiscussions'],
                    'canCloseDiscussions'   => $this->sSettings[0]['canCloseDiscussions'],
                    'category_options'      => $category_options,
                    'topic_id'              => $topic_id,
                    'comment_id'            => $row['CommentID'],
    			);
                
                //Page construction variables
                $page ='edit_topic';
                $title = 'Edit Discussion';
                
                // Send all information to the constructor
                $this->forums_page_construct($page, $title, $data);
            } 
        } else {
            $this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
            redirect($this->session->userdata('refered_from'));
        }
    }
    
    public function update_topic()
    {
		if ($this->ion_auth->logged_in())
		{
			if($this->input->post('sticky') == '1')
          	{
            	$sticky = '1';  
          	} else {
                $sticky = '0';
          	}
          
          	if($this->input->post('closed') == '1')
          	{
                $closed = '1';
          	} else {
                $closed = '0';
          	}
          
		  	$discussion_data = array(
		      	'TopicName' => $this->input->post('title'),
              	'Sticky'  	=> $sticky,
              	'Closed'  	=> $closed,
		  	);
					
		  	$this->db->where('TopicID', $this->input->post('topic_id'));
          
				if($this->db->update('topics', $discussion_data))
				{
          
                      $comment_data = array(
                            'Title' => $this->input->post('title'),
                            'Body' => $this->input->post('body'),
                      );
                      
                      $this->db->where('CommentID', $this->input->post('comment_id'));
                      
                      if($this->db->update('comments', $comment_data))
                      {
                            $this->session->set_flashdata('message', $this->lang->line('messageDiscussionUpdated'));
                            redirect('forums');
                      } else {
                            $this->session->set_flashdata('error', $this->lang->line('errorUpdateDiscussion'));
                            redirect('forums');
                      }
                } else {
                    $this->session->set_flashdata('error', $this->lang->line('errorUpdateDiscussion'));
                    redirect('forums');
                }
          }	else {
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}        
    }
	
	public function create_random_password() 
	{

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
		return $pass;
	}
	
	function settings()
	{
		if(!$this->ion_auth->logged_in())
		{
			/* User is not logged in do not allow to post */
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect('forums/login', 'refresh');
		}
		else
		{	
			$data = array(
				'siteName' 				=> $this->siteName,			
				'siteTheme' 			=> $this->siteTheme,
				'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],				
				'user_profile' 			=> $this->users_m->user_profile($this->session->userdata('username')),
				'errorMessageTitle' 	=> $this->errorTitle,
				'Error' 				=> $this->Error,
				'successMessageTitle' 	=> $this->messageTitle,
				'Message' 				=> $this->Message,
				'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
                'navigation'            => $this->build_navigation(),
			);
		
			//Page construction variables
			$page = 'settings';
			$title = $this->lang->line('titleSettings');
				
			//Send all information to the constructor
			$this->forums_page_construct($page, $title, $data);	

			log_message('debug', 'Settings function executed successfully! - /modules/forums/controllers/forums/settings');		
			$this->output->enable_profiler(FALSE); 				
		}
	}
	
	public function update_settings($username)
	{
		$this->users_m->update_settings($username);
	}
	
	public function change_password()
	{
		$this->form_validation->set_rules('old', 'Old password', 'required');	    
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|matches[new_confirm]');
	    $this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');	    
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('forums/login', 'refresh');	    
		}	    
		$user = $this->ion_auth->get_user($this->session->userdata('user_id'));	    
		
		if ($this->form_validation->run() == false) 
		{ 
			//display the form	        
			//set the flash data error message if there is one	        
			$val_message = (validation_errors());	
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			
			$old_password  = array(
				'name'    			=> 'old',
				'id'      			=> 'old',
				'type'    			=> 'password',
				'class' 			=> 'textbox',	
			);	       

			$new_password  = array(
				'name'    			=> 'new',
				'id'      			=> 'new',
				'type'    			=> 'password',
				'class' 			=> 'textbox',	
			);        	
		
			$new_password_confirm = array(
				'name'    			=> 'new_confirm',
				'id'      			=> 'new_confirm', 
				'type'   			=> 'password', 
				'class' 			=> 'textbox',	
			);        	
		
			$user_id = array(
				'name'    			=> 'user_id',
				'id'      			=> 'user_id',
				'type'    			=> 'hidden', 
				'value'   			=> $user->id,
			);        	
			//render        	
			$data = array(
				'siteName' 				=> $this->siteName,			
				'siteTheme' 			=> $this->siteTheme,	
				'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],				
				'category' 				=> '',
				'errorMessageTitle' 	=> $this->errorTitle,
				'Error' 				=> $this->Error,
				'successMessageTitle' 	=> $this->messageTitle,
				'Message' 				=> $this->Message,
				'old_password' 			=> $old_password,
				'new_password' 			=> $new_password,
				'new_password_confirm' 	=> $new_password_confirm,
				'user_id' 				=> $user_id,
				'links' 				=> '',
				'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
                'navigation'            => $this->build_navigation(),
			);
			
			//Page construction variables
			$page = 'changePassword';
			$title = $this->lang->line('titleChangePassword');
				
			//Send all information to the constructor
			$this->forums_page_construct($page, $title, $data);

			log_message('debug', 'change_password function executed successfully! - /modules/forums/controllers/forums/change_password');		
			$this->output->enable_profiler(FALSE); 			
		}	    
		else 
		{	        
		
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));	        
			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
			if ($change) 
			{ 
				//if the password was successfully changed    			
				$this->session->set_flashdata('message', $this->lang->line('messagePasswordChanged'));
				redirect('forums', 'refresh');				
			}    		
			else 
			{    			
				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect('forums/changePassword', 'refresh');    		
			}	    
		}		
	}
	
  	public function register()
	{		
		// Check and see if our site is in maintenance mode.
		if($this->sSettings[0]['allowRegistration'] == '1')
		{
			// Validate the form
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		
			if($this->form_validation->run() == true)
			{
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->create_random_password();
			}
		
			if($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email))
			{
				// Redirect them back to the home page with a message
				$this->session->set_flashdata('message', $this->lang->line('messageRegistrationSuccess'));
				redirect('forums', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', validation_errors());
				redirect('forums', 'refresh');
			}
		}
		else
		{
			// registration has being turned off, redirect
			$this->session->set_flashdata('error', $this->lang->line('messageFeatureOff'));
			
			// Send the user back to the page they came from
			redirect('forums');		
		}
	}
	
	public function activate($id, $code=false)
	{
		$activation = $this->ion_auth->activate($id, $code);

        if($activation) 
        {
        	$username = $this->users_m->get_username($id);
        	
        	// Insert information into the activity database.
			$data = array(
				'username' => $username,
				'date' => time(),
				'activity' => 'registered',
			);
			
			$this->db->insert('activity', $data); // Insert activity into activity's table 	
				
			//redirect
			$this->session->set_flashdata('message', $this->lang->line('messageActivationSuccess'));
			redirect('forums', 'refresh');
        }
        else 
        {
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("forums/forgot_password", 'refresh');
        }
    }
	
	public function profile($username)
	{
		$data = array(
			'siteName' 						=> $this->siteName,			
			'siteTheme' 					=> $this->siteTheme,		
			'welcomeMessage'				=> $this->sSettings[0]['siteWelcomeMessage'],			
			'user_profile' 					=> $this->users_m->user_profile($username),
			'errorMessageTitle' 			=> $this->errorTitle,
			'Error' 						=> $this->Error,
			'successMessageTitle' 			=> $this->messageTitle,
			'Message' 						=> $this->Message,
			'username' 						=> $username,
			'forumsInstalled'		        => $this->sSettings[0]['forumInstalled'],
            'navigation'                    => $this->build_navigation(),
            'userid'                        => $this->users_m->get_userid($username),
            'extra'                         => '',
		);
			
		//Page construction variables
		$page = 'profile';
		$title = $this->lang->line('titleProfile');
			
		//Send all information to the constructor
		$this->forums_page_construct($page, $title, $data);
			
		log_message('debug', 'Profile function executed successfully! - /modules/forums/controllers/forums/profile');		
		$this->output->enable_profiler(FALSE); 	
	}
	
	public function report_post()
	{
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		
		// Check and see if the user is logged in
		if (!$this->ion_auth->logged_in())
		{
			// User is not logged in, redirect
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}
		else
		{
			// User passed the test, report the post 
			$data = array(
				'reported' => '1',
			);
			$this->db->where('CommentID', $this->uri->segment(3));
			$this->db->update('comments', $data);
			
			if($this->db->affected_rows() >= '1')
			{		
				// Lets flag the topics for the admins attention.
				$data = array(
					'Flagged' => '1',
				);
				$this->db->where('TopicID', $this->uri->segment(4));
				$this->db->update('topics', $data);
				
				$this->session->set_flashdata('message', $this->lang->line('messagePostReported'));
				redirect($this->session->userdata('refered_from'));
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('errorPostReportFailed'));
				redirect($this->session->userdata('refered_from'));
			}
		}
	}
	
	public function remove_report()
	{
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		
		// Check and see if the user is logged in
		if (!$this->ion_auth->logged_in())
		{
			// User is not logged in, redirect
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}
		else
		{
			// User passed the test, report the post 
			$data = array(
				'reported' => '0',
			);
			$this->db->where('CommentID', $this->uri->segment(3));
			$this->db->update('comments', $data);
			
			if($this->db->affected_rows() >= '1')
			{		
				// Lets flag the topics for the admins attention.
				$data = array(
					'Flagged' => '0',
				);
				$this->db->where('TopicID', $this->uri->segment(4));
				$this->db->update('topics', $data);
				
				$this->session->set_flashdata('message', $this->lang->line('messagePostRemoveReport'));
				redirect($this->session->userdata('refered_from'));
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('errorPostRemoveReport'));
				redirect($this->session->userdata('refered_from'));
			}
		}	
	}
	
	public function delete_post($postID)
	{
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		
		// Check and see if the user is logged in
		if(!$this->ion_auth->logged_in())
		{
			// User is not logged in, redirect
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}
		else
		{
            //The user is a admin and logged in, remove the post 
			$this->db->where('CommentID', $postID);
			$this->db->delete('comments');
				
			if($this->db->affected_rows() >= 1)
			{
				$this->session->set_flashdata('message', $this->lang->line('messagePostDeleted'));
				redirect($this->session->userdata('refered_from'));
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('errorPostDeleteFailed'));
				redirect($this->session->userdata('refered_from'));
			}
		}
	}
	
	public function edit_post($postID)
	{
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
		
		if ($this->ion_auth->logged_in())
		{
			$post = $this->posts_m->get_post($postID);
				
			foreach($post as $row)
			{
				$body = array(
					'name' => 'postBody',
					'id' => 'postBody',
					'type' => 'text',
					'value' => $row['Body'],
					'class' => 'textarea',
				);
					
				if($row['reported'] == '1')
				{
					$checked = TRUE;
				}
				else
				{
					$checked = FALSE;
				}
					
				$reported = array(
					'name' => 'reported',
					'id' => 'reported',
					'value' => '1',
					'class' => 'checkbox',
					'checked' => $checked,
				);
					
				$updatePost = array(
					'name'		=> 'updatePost',
					'id'		=> 'updatePost',
					'class'		=> 'btn_alt',
					'type'		=> 'submit',
					'value'	=> $this->lang->line('updatePostButton'),
				);
					
				$commentID = array(
					'name' => 'commentID',
					'id' => 'commentID',
					'type' => 'hidden',
					'value' => $row['CommentID'],
				);
			}

				$data = array(
					'siteName' 					=> $this->siteName,			
					'siteTheme' 				=> $this->siteTheme,		
					'welcomeMessage'			=> $this->sSettings[0]['siteWelcomeMessage'],			
					'errorMessageTitle' 		=> $this->errorTitle,
					'Error' 					=> $this->Error,
					'successMessageTitle' 		=> $this->messageTitle,
					'Message' 					=> $this->Message,
					'body' 						=> $body,
					'reported'					=> $reported,
					'commentID'					=> $row['CommentID'],
					'updatePost'				=> $updatePost,
					'forumsInstalled'		    => $this->sSettings[0]['forumInstalled'],
                    'navigation'                => $this->build_navigation(),
				);
			
				//Page construction variables
				$page = 'editPost';
				$title = $this->lang->line('titleEditPost');
			
				//Send all information to the constructor
				$this->forums_page_construct($page, $title, $data);				
		}
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}
	}
	
	public function update_post()
	{
		if ($this->ion_auth->logged_in())
		{
			$CommentID = $this->uri->segment(3);
				
			if ($this->ion_auth->is_admin())
			{
				if ($this->input->post('reported') == '1')
				{
					$reported = '1';
				}
				else
				{
					$reported = '0';
				}
			
				$data = array(
					'Body' => $this->input->post('postBody'),
					'reported' => $reported,
				);

				$this->db->where('CommentID', $CommentID);
				$this->db->update('comments', $data);
			
				if ($this->db->affected_rows() >= '1')
				{
					$this->session->set_flashdata('message', $this->lang->line('messageUpdatePost'));
					redirect($this->session->userdata('refered_from'));
				}
				else
				{
					$this->session->set_flashdata('error', $this->lang->line('errorUpdatePost'));
					redirect('forums');
				}
			}
			else
			{
				$data = array(
					'Body' => $this->input->post('postBody'),
				);
				
				$this->db->where('CommentID', $CommentID);
				$this->db->update('comments', $data);
			
				if($this->db->affected_rows() >= '1')
				{
					$this->session->set_flashdata('message', $this->lang->line('messageUpdatePost'));
					redirect($this->session->userdata('refered_from'));
				}
				else
				{
					$this->session->set_flashdata('error', $this->lang->line('errorUpdatePost'));
					redirect('forums');
				}
			}
				
		}
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('errorLoginRequired'));
			redirect($this->session->userdata('refered_from'));
		}			
	}
	
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$email = array(
				'name' 		=> 'email',
				'id' 		=> 'email',
				'class' 	=> 'textbox',
			);
			//set any errors and display the form

			$data = array(
				'siteName' 						=> $this->siteName,			
				'siteTheme' 					=> $this->siteTheme,		
				'welcomeMessage'				=> $this->sSettings[0]['siteWelcomeMessage'],			
				'errorMessageTitle' 			=> $this->errorTitle,
				'Error' 						=> $this->Error,
				'successMessageTitle' 			=> $this->messageTitle,
				'Message' 						=> $this->Message,
				'email' 						=> $email,
				'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
                'navigation'            => $this->build_navigation(),
			);
			
			//Page construction variables
			$page = 'forgot_password';
			$title = $this->lang->line('titleForgotPassword');
			
			//Send all information to the constructor
			$this->forums_page_construct($page, $title, $data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->lang->line('messageResetPassword'));
				redirect('forums');
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('errorResetPassword'));
				redirect('forums');
			}
		}
	}

	public function reset_password($code)
	{
		$reset = $this->ion_auth->forgotten_password_complete($code);

		if ($reset)
		{ //if the reset worked then send them to the login page
			$this->session->set_flashdata('message', $this->lang->line('messageResetPasswordComplete'));
			redirect('forums');
		}
		else
		{ //if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->lang->line('messageResetPasswordFailed'));
			redirect("forums/forgot_password", 'refresh');
		}
	}
	
	public function search($limit=NULL, $offset=NULL)
	{
		//What action ?
		$action = $this->uri->segment(3);
		
		switch($action) {
		
			case 'display':

				$this->input->load_query($this->uri->segment(4));
				
				$query_array = array(
					'search' => $this->input->get('search'),
				);
				
				$results = $this->core_m->search($query_array, $this->sSettings[0]['topicsPerPage'], $this->uri->segment(5));
				
				/**
				* Construct the data array for the page
				**/
				$data = array(
					'siteName' 				=> $this->siteName,			
					'siteTheme' 			=> $this->siteTheme,
					'welcomeMessage'		=> $this->sSettings[0]['siteWelcomeMessage'],
					'topics' 				=> $results,
					'categories' 			=> $this->categories_m->get_categories(),
					'category' 				=> $this->lang->line('searchResults'),
					'errorMessageTitle' 	=> $this->errorTitle,
					'Error' 				=> $this->Error,
					'successMessageTitle' 	=> $this->messageTitle,
					'Message' 				=> $this->Message,
					'links' 				=> '',
					'forumsInstalled'		=> $this->sSettings[0]['forumInstalled'],
                    'navigation'            => $this->build_navigation(),
                    'deleteOwnDiscussions'  => $this->sSettings[0]['deleteOwnDiscussions'],
            		'editOwnDiscussions'    => $this->sSettings[0]['editOwnDiscussions'],
            		'modsEditDiscussions'   => $this->sSettings[0]['modsEditDiscussions'],
            		'modsDeleteDiscussions' => $this->sSettings[0]['modsDeleteDiscussions'],
				);
				
				/**
				* Send page to the page constructor
				**/
				$page = 'forums';
				$title = $this->lang->line('titleSearchResults');
				$this->forums_page_construct($page, $title, $data);
			
			break;
			
			default:
			
				$query_array = array(
					'search' => $this->input->post('search'),
				);
		
				$query_id = $this->input->save_query($query_array);
				
				redirect('forums/search/display/'.$query_id.'');
				
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
    
    public function update_order($order)
    {
		/**
		* Store the page the user came from.
		**/	 
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        
        if($order == 'asc')
        {
            $this->session->set_userdata('topicsOrder', 'asc');
        }
        elseif($order == 'desc')
        {
            $this->session->set_userdata('topicsOrder', 'desc');
        }
        
		redirect($this->session->userdata('refered_from'));
    }
}

/* End of file forums.php */
/* Location: ./application/modules/core/controllers/forums.php */