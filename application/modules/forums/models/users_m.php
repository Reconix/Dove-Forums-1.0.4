<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Users Model for the users module
 * 
 * @author 		Chris Baines - Dove Forums Dev Team
 * @package 	DoveForums
 * @subpackage 	Users Module
 * @category	Modules
 * @copyright © 2010 - 2011 Dove Forums 
 */
class Users_m extends CI_Model{
	
    public function __construct()
    {
        parent::__construct();
    }
    	
	public function gravatar( $email, $rating = 'X', $size = '50', $default = 'http://gravatar.com/avatar.php' ) 
	{
		# Hash the email address
		$email = md5( $email );
        
		# Return the generated URL
		return "http://gravatar.com/avatar.php?gravatar_id="
			.$email."&amp;rating="
			.$rating."&amp;size="
			.$size."&amp;default="
			.$default;
	} 
    
    public function build_avatar($email, $username)
    {
        $this->sSettings = $this->topics_m->get_settings();
        
        if($this->sSettings[0]['useGravatars'] == '0')
        {
            // Build the users avatar from a file.
            $avatar = '<img src="'.base_url().'assets/images/avatars/users/'.$email.'.jpeg" alt="'.$this->lang->line('avatarAltText').'" title="'.$username.''.$this->lang->line('avatarTitle').'" height="45px" width="45px"/>';
        }else{
            // build the users gravatar avatar.
            $avatar = '<img src="'.$this->gravatar($email, "x", "45").'" alt="'.$this->lang->line('avatarAltText').'" title="'.$username.''.$this->lang->line('avatarTitle').'" height="45px" width="45px"/>';
        }
        return $avatar;
    }		
	
	public function get_username($id)	
	{		
        // [HOOK] before everything else is run
        do_action('pre.get.username');
        
        // [HOOK] allow plugins to modify / get the ID
        $id = do_action('get.username.id', $id);
        
		$this->db->select('username');		
		$options = array('id' => $id);		
		$q = $this->db->get_where('users', $options, 1);				
		
		if ($q->num_rows() > 0) 
		{
			foreach ($q->result_array() as $row) 
			{				
				$data[] = $row;			
			}		
		}				
		
		$q->free_result();
        
        // [HOOK] modify the returned username
        $returned = do_action('get.username', $row['username']);		
		
		return $returned;
        
        // [HOOK] run after everything else
        do_action('post.get.username');        	
	}

	public function get_email($username)
	{
        // [HOOK] before everything else is run
        do_action('pre.get.email');
        
        // [HOOK] allow plugins to modify / get the username
        $username = do_action('get.email.username', $username);
        
		$this->db->select('email');
		$options = array('username' => $username);
		$q = $this->db->get_where('users', $options, 1);
		
		if($q->num_rows() > 0)
		{	
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		
		$q->free_result();
		
        // [HOOK] modify the returned email
        $returned = do_action('get.email', $row['email']);        
        
        return $returned;
        
        // [HOOK] run after everything else
        do_action('post.get.email');           
	}
    
    public function get_userid($username)
    {
        $this->db->select('id');
        $options = array('username' => $username);
        $q = $this->db->get_where('users', $options, 1);
        
        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        
        $q->free_result();
        return $row['id'];
    }
		
	public function user_profile($username)	
	{		
        // [HOOK] before everything else is run
        do_action('pre.get.userprofile');
        
		$data = array();				
		$this->db->join('meta', 'meta.user_id = users.id');		
		$options = array('username' => $username);		
		$q = $this->db->get_where('users', $options, 1);				
			
		if($q->num_rows() > 0) 		
		{			
			foreach ($q->result_array() as $row)
			{				
				$data[] = $row;			
			}		
		}				
		
		$q->free_result();
        
        // [HOOK] the returned user profile data
        $data = do_action('get.userprofile', $data);	
        	
		return $data;
        
        // [HOOK] run after everything else
        do_action('post.get.userprofile');           	
	}
		
	public function update_settings($username)
	{
        // [HOOK] before everything else is run
        do_action('pre.update.user.settings');
				
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'location' => $this->input->post('location'),
			'interests' => $this->input->post('interests'),
			'occupation' => $this->input->post('occupation'),
			'gender' => $this->input->post('gender'),
		);
        
        // [HOOK] the array of data to be manipulated before insertion
        $data = do_action('update.user.settings.meta', $data);
		
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('meta', $data);
        
        // [HOOK] run after updating the user meta
        do_action('post.update.user.settings.meta.insert');    
		
		$this->session->set_flashdata('message', $this->lang->line('messageAccountUpdated'));
        
        // [HOOK] run after everything else
        do_action('post.update.user.settings');
        
		redirect('forums/settings/'.$username.'');	
	}
}