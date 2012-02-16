<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Topics_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_topics($limit, $offset=NULL)
	{
		$data = array(); 	

       	$this->db->select('topics.TopicID, topics.TopicName, topics.CreatedBy, topics.LastPost, topics.CategoryID, topics.CreatedTime, topics.LastPostTime, topics.Sticky, topics.Closed, topics.Flagged, users.id, users.username, users.email');
       	$this->db->join('users', 'users.username = topics.CreatedBy'); // Joins users
	   	$this->db->order_by('topics.Sticky desc, topics.LastPostTime '.$this->session->userdata('topicsOrder').', topics.Closed');
	   	$this->db->limit($limit, $offset); // For pagination

       	$options = array('topics.Active'=>'1'); // Only get active topics

	   	$q = $this->db->get_where('topics', $options); 

		if($q->num_rows() >0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}

			return $data;
		}
		else
		{
			return false;
			// There must have being a problem, create a error log
			log_message('error', 'get_topics function failed! - /modules/topics/models/topics_m/get_topics');
		}
	}
    
    public function get_topic($topic_id)
    {
        $data = array();
        
        $this->db->select('topics.TopicID, topics.TopicName, topics.CreatedBy, topics.LastPost, topics.CategoryID, topics.CreatedTime, topics.LastPostTime, topics.Sticky, topics.Closed, topics.Flagged, comments.CommentID, comments.Body');
        $this->db->join('comments', 'comments.Title = topics.TopicName');
        $this->db->limit('1');
        
        $options = array('topics.TopicID' => $topic_id);
        
        $q = $this->db->get_where('topics', $options);
        
        if($q->num_rows() >0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
            
            return $data;
        } else {
            return false;
        }
    }

	public function count_topics()
	{
		$options = array('Active' => '1');

		$q = $this->db->get_where('topics', $options);

		if($q->num_rows() >0)
		{
			return $q->num_rows();
		}
		else
		{
			return false;
		}
	}

	/**
    * Return a count of topics in a category
	*
	* @access public
	* @return $num_rows
	*/
    		
	public function count_cat_topics($category_id)
	{
		$options = array('CategoryID'=>$category_id, 'Active' => '1');
		$query = $this->db->get_where('topics', $options);

		return $query->num_rows();	
	}	

	/**
    * Return all the topics in a category
	*
	* @access public
	* @param $category a string containing the category
	* @param $limit a string containing the limit
	* @param $offset a string containing the offset
	* @return $data
	*/		
	public function get_cat_topics($category_id, $limit, $offset=NULL)
	{
		$data = array(); 	

       	$this->db->select('topics.TopicID, topics.TopicName, topics.CreatedBy, topics.LastPost, topics.CategoryID, topics.CreatedTime, topics.LastPostTime, topics.Sticky, topics.Closed, topics.Flagged, users.id, users.username, users.email');
   		$this->db->join('users', 'users.username = topics.CreatedBy');
   		$this->db->order_by('topics.Sticky desc, topics.LastPostTime '.$this->session->userdata('topicsOrder').'');
   		$this->db->limit($limit, $offset);

   		$options = array('topics.CategoryID'=>$category_id, 'topics.Active'=>'1');

   		$q = $this->db->get_where('topics', $options);

		if($q->num_rows() >0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}

		$q->free_result();

		return $data;
	}	

    public function count_posts($topic_id)
    {
    	$options = array('TopicID'=>$topic_id, 'Active'=>'1');
    	$query = $this->db->get_where('comments', $options);
    	return $query->num_rows();
    }	

	public function submit_topic() 
	{
		// Store the page the user came from.

		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
        
    	$this->form_validation->set_rules('title', 'Title', 'required|max_length[250]|htmlspecialchars');
    	$this->form_validation->set_rules('category', 'Category', 'required');
    	$this->form_validation->set_rules('comment', 'Comment', 'required|htmlspecialchars');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('error', validation_errors());
    		// Send the user back to the page they came from
			redirect($this->session->userdata('refered_from'));
		}
		else 
		{
		$TopicID = uniqid();					

		$data = array(			
			'username' => $this->session->userdata('username'),			
			'date' => time(),			
			'activity' => 'topic',			
			'topic_id' => $TopicID,			
			'category_id' => $this->input->post('category'),            		
		);		

		$this->db->insert('activity', $data); // Insert activity into activity's table 

		if($this->input->post('Sticky') == '1')
		{
			$sticky = $this->input->post('Sticky');
		}
		else
		{
			$sticky = '0';
		}

		if($this->input->post('Close') == '1')
		{
			$close = $this->input->post('Close');
		}
		else
		{
			$close = '0';
		}

    	$data = array(
    		'TopicID' => $TopicID,
        	'TopicName'     =>  $this->input->post('title'),
        	'CreatedBy' => $this->session->userdata('username'),
        	'LastPost' => $this->session->userdata('username'),
        	'CategoryID'  =>  $this->input->post('category'),
        	'CreatedTime' => time(),
        	'LastPostTime' => time(),
            'Active' => '1',
			'Sticky'		=> $sticky,
			'Closed'			=> $close,
    	);

    	$this->db->insert('topics', $data); 

    	$data = '';    	

    	$CommentID = uniqid();

    	$data = array(
    		'CommentID' => $CommentID,
    		'TopicID' => $TopicID,
			'CategoryID' => $this->input->post('category'),
    		'Title' => $this->input->post('title'),
    		'Body' => $this->input->post('comment'),
    		'CreatedBy' => $this->session->userdata('username'),
			'CategoryID'  =>  $this->input->post('category'),
    		'PostTime' => time(),
            'Active' => '1',
   		);

   		$this->db->insert('comments', $data); 

		// Insert comment into comments table				

		$data = '';		

   		$this->session->set_flashdata('message', $this->lang->line('messageNewTopicSuccess'));

    	redirect('forums/posts/'.$this->input->post('category').'/'.$TopicID.'/');
		}
	} // End of submitTopic
    
	/**
	 * Return the Topic's Name
	 *
	 * @access public
	 * @param $TopicID a string containing the topic's ID
	 * @return $row
	 */		
	public function get_topic_name($topic_id)
	{
		$this->db->select('TopicName');
		$options = array('TopicID'=>$topic_id);
		$q = $this->db->get_where('topics', $options);

		if($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		return $row['TopicName'];
	}
    
    public function get_topic_users($topic_id)
    {
        $emails = array();
        $this->db->select('users.email');
        $this->db->join('users', 'users.username = comments.CreatedBy');
        
        $options = array(
            'TopicID' => $topic_id,
        );
        
        $q = $this->db->get_where('comments', $options);
        
        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $emails['emails'][] = $row['email'];
            }
        }
        return $emails;
    }
    
    public function get_cat_id($topic_id)
    {
        $this->db->select('CategoryID');
        $options = array(
            'TopicID' => $topic_id,
        );
        
        $q = $this->db->get_where('topics', $options);
        
        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        return $row['CategoryID'];
    }

	 /**
	 * Return all the posts in a category 
	 *
	 * @access public
	 * @param $category a string contaning the category
	 * @param $limit a string containing the limit
	 * @param $offset a string containing the offset
	 * @param $TopicID a string containing the topic's ID
	 * @return $data
	 */	   
    public function get_posts($limit, $topic_id, $offset=NULL)
    {
		$data = array();
		$this->db->join('users', 'users.username = comments.CreatedBy');
		$this->db->join('topics', 'topics.TopicID = comments.TopicID');
		$this->db->order_by('comments.PostTime', 'asc'); 
		$this->db->limit($limit, $offset);   

		$options = array('comments.TopicID' => $topic_id, 'comments.Active'=>'1');

		$q = $this->db->get_where('comments', $options);

		if ($q->num_rows() > 0) 
		{
			foreach ($q->result_array() as $row) 
			{
				$data[] = $row;
			}
		}

		$q->free_result();
		return $data;
	}
    
    public function get_first_post($topic_id)
    {
        $data = array();
        $this->db->join('users', 'users.username = comments.CreatedBy');
        $this->db->join('topics', 'topics.TopicID = comments.TopicID');
        $this->db->order_by('comments.PostTime asc');
        $this->db->limit('1');
        
        $options = array('comments.TopicID' => $topic_id, 'comments.Active' => '1');
        
        $q = $this->db->get_where('comments', $options);
        
        if($q->num_rows() > 0)
        {
            foreach($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        
        $q->free_result();
        return $data;
    }

	public function get_settings()
	{
		$this->db->select('*');

		$this->db->join('themes', 'themes.themeID = settings.themeID');

		$q = $this->db->get('settings', 1);

		if($q->num_rows() > 0)
		{	
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}

		$q->free_result();

		return $data;
	}
    
    public function add_bookmark($topic_id, $topic_title)
    {
        // check and see if the user has already bookmarked this topic
        $user_id = $this->session->userdata('user_id');
        $check = $this->check_bookmark($topic_id, $user_id);

        if($check == false)
        {
            // The user already has this discussion bookmarked, let`s redirect them
            $this->session->set_flashdata('error', $this->lang->line('errorTopicBookmarked'));
            redirect($this->session->userdata('refered_from'));
        }
        else
        {
            $data = array(
                'bookmark_topic_title' => $topic_title,
                'bookmark_topic_id' => $topic_id,
                'bookmark_user_id' => $user_id,
            );
            
            $this->db->insert('bookmarks', $data);
            
            if($this->db->affected_rows() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    
    public function remove_bookmark($topic_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        $data = array(
            'bookmark_topic_id' => $topic_id,
            'bookmark_user_id' => $user_id,
        );
        
        $this->db->delete('bookmarks', $data);
        
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function remove_discussion($topic_id)
    {
        if($this->ion_auth->is_admin() || $this->ion_auth->is_group('moderators'))
        {
            // If the admin is tryring to delete a topic then delete it.
            $data = array(
                'TopicID' => $topic_id,
            );
            
            $this->db->delete('topics', $data);
            $this->db->delete('comments', $data);
            
            if($this->db->affected_rows() > 0)
            {
                return true;
            }else{
                return false;
            }
        }else{
            // Perform checks
            $options = array(
                'TopicID' => $topic_id,
                'CreatedBy' => $this->session->userdata('username'),
            );
            
            $q = $this->db->get_where('topics', $options);
            
            if($q->num_rows() > 0)
            {
                $data = array(
                    'TopicID' => $topic_id,
                );
                
                $this->db->delete('comments', $data); 
                $this->db->delete('topics', $data);
                return true;
                
            }else{
                
                return false;
                
            }

            if($this->db->affected_rows() > 0)
            {
                
                return true;
                
            }else{
                
                return false;
                
            }
        }
    }
    
    public function check_bookmark($topic_id, $user_id)
    {
        // check and see if the user has already bookmarked this topic
        $this->db->select('*');
        $options = array(
            'bookmark_topic_id' => $topic_id,
            'bookmark_user_id' => $user_id,
        );
        
        $q = $this->db->get_where('bookmarks', $options);
        
        if($q->num_rows() > 0)
        {
            return false;
        }
        else
        {
            return true;
        }        
    }
}