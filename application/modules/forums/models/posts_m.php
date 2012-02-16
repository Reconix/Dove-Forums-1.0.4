<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
        $this->sSettings = $this->topics_m->get_settings();
	}		
	
	public function submit_post()
	{	
        // [HOOK] Before any other functions are run	
        do_action('pre.submit.post');
        
		$this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);		    	
		$this->form_validation->set_rules('comments_box', 'Comment', 'required|htmlspecialchars');
        		        
		$TopicID = $this->input->post('TopicID');        
		$CategoryID = $this->input->post('CategoryID');				
	
		if ($this->form_validation->run() == FALSE) 		
		{			
			redirect($this->session->userdata('refered_from'));		
		}		
		else 		
		{								
			$data = array(						
				'username' => $this->session->userdata('username'),						
				'date' => time(),						
				'activity' => 'post',						
				'topic_id' => $TopicID,						
				'category_id' => $CategoryID,				
			);				
            
            // [HOOK] Allow plugins to modify post submit array before it's saved
            $data = do_action('pre.submit.post.insert.activity', $data);
            		
			$this->db->insert('activity', $data);
            
            // [HOOK] Activity data has been inserted
            do_action('post.submit.post.insert.activity');
			
			$data = array(        	
				'LastPost' => $this->session->userdata('username'),        	
				'LastPostTime' => time(),    	
			);        
			$this->db->where('TopicID', $TopicID);    	
			
			$this->db->update('topics', $data); 			    	
			$data = '';				    	
			
			$data = array(    		
				'CommentID' => uniqid(),    		
				'TopicID' => $TopicID,  
				'CategoryID' => $CategoryID,
				'Title' => '',    		
				'Body' => $this->input->post('comments_box'),    		
				'CreatedBy' => $this->session->userdata('username'),    		
				'PostTime' => time(), 
                'Active' => '1',  		
			);
            
            // [HOOK] Data to be inserted into the comments table
            $data = do_action('pre.submit.post.insert.comments', $data);
            		   		
			$this->db->insert('comments', $data);
            
            // [HOOK] Run after comments are successfully inserted
            do_action('post.submit.post.insert.comments');
            
            // Update the bookmarks table for all users who have this topic bookmarked
            $data = array(
                'bookmark_replys' => '1',
            );
            
            $options = array(
                'bookmark_topic_id' => $TopicID,
            );
            
            $this->db->update('bookmarks', $data, $options);
            
            // Email all the users that are part of the discussion
            $data = array(
                'topicName' => $this->topics_m->get_topic_name($TopicID),
                'replyUsername' => $this->session->userdata('username'),
                'categoryID' => $CategoryID,
                'topicID' => $TopicID,
            );
            
            // Get the email template
            $message = $this->load->view('new_post', $data, true);
            
            $user_emails = $this->topics_m->get_topic_users($TopicID);
 
            $result = array_unique($user_emails['emails']);
            
            // Email config
            $config['mailtype'] = 'html';
            
            $this->email->clear();
            $this->email->initialize($config);
            $this->email->to($result);
            $this->email->from($this->sSettings[0]['adminEmail'], $this->sSettings[0]['sName']);
            $this->email->subject(''.$this->sSettings[0]['sName'].' - '.$this->session->userdata('username').' has replied to the discussion '.$this->topics_m->get_topic_name($TopicID).'');
            $this->email->message($message);
            $this->email->send();     
            
            // ** TODO - Add a filter so the user who submits the reply does not get the email **    
             		   		
			$this->session->set_flashdata('message', $this->lang->line('messageNewPostSuccess'));				
			
			redirect($this->session->userdata('refered_from'));
            
            // [HOOK] Post submit post
            do_action('post.submit.post');				
		}	
	}
	
	public function count_posts($TopicID)
    {
    	$options = array('TopicID'=>$TopicID, 'Active'=>'1');
    	$query = $this->db->get_where('comments', $options);
    	return $query->num_rows();
    }	    
	
	public function count_total_posts($CreatedBy)    
	{    	
		$options = array('CreatedBy'=>$CreatedBy, 'Active'=>'1');    	
		$query = $this->db->get_where('comments', $options);    	
		return $query->num_rows();    
	}
	
	public function get_latest_5_posts($TopicID)
	{
		$this->db->order_by('PostTime', 'desc');
		$this->db->limit('5'); 
		$options = array('TopicID'=>$TopicID, 'active'=>'1');
		$q = $this->db->get_where('comments', $options);
		if($q->num_rows() >0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}	
		}	
		return $data;	
	}

	public function get_post($postID)
	{
        // [HOOK] run before any post is fetched
        do_action('pre.get.post');
        
		$this->db->limit('1');
		$options = array('CommentID'=>$postID);
		$q = $this->db->get_where('comments', $options);
        
		if($q->num_rows() >0)
		{
			foreach($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
        
        // [HOOK] allow plugins to modify returned post data
        $data = do_action('get.post', $data);
        
		return $data;
        
        // [HOOK] run after all other stuff is done
        do_action('post.get.post');
        
	}
}