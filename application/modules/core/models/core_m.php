<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core_m extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	function get_settings()
	{
        // [HOOK] Run before settings are fetched
        do_action('pre.get.settings');
        
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
        
        // [HOOK] Settings array returned from database
        $data = do_action('get.settings', $data);
        
		return $data;
        
        // [HOOK] Run after everything is finished
        do_action('post.get.settings');  
	}
    
	function search($query_array, $limit, $offset='')
    {
        // [HOOK] Run before search is  fetched
        do_action('pre.get.search');
        
		$data = array(); 	
       	$this->db->select('topics.TopicID, topics.TopicName, topics.CreatedBy, topics.LastPost, topics.CategoryID, topics.CreatedTime, topics.LastPostTime, topics.Sticky, topics.Closed, topics.Flagged, users.id, users.username, users.email');
       	$this->db->join('users', 'users.username = topics.CreatedBy'); // Joins users
	   	$this->db->order_by('topics.Sticky desc, topics.LastPostTime desc'); // Ordered by latest reply
	   	$this->db->limit($limit, $offset); // For pagination
		$this->db->like('topics.TopicName', $query_array['search']);
		$options = array('topics.Active'=>'1'); // Only get active topics
	   	$q = $this->db->get_where('topics', $options);

		if($q->num_rows() >0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
            
            // [HOOK] Search array returned from database
            $data = do_action('get.search', $data);
            
			return $data;
		}
		else
		{
			return false;
		}
        
        // [HOOK] Run after everything is finished
        do_action('post.get.search'); 
        	
	}
    
    public function install_plugin($name)
    {
        // Store the page the user came from.
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
                
        $this->db->select('plugin_system_name');
        $options = $this->db->options = array('plugin_system_name' => $name);
        $q = $this->db->get_where('plugins', $options);
        
        if($q->num_rows() >0)
        {
            $this->session->set_flashdata('error', 'The plugin has already being installed');
            redirect($this->session->userdata('refered_from'));
        }
        else
        {
            $data = array(
                'plugin_system_name' => $name,
            );
    
            $this->db->insert('plugins', $data);
            $this->session->set_flashdata('message', 'The plugin has being installed');
            redirect($this->session->userdata('refered_from'));      
        }
    }
    
    public function uninstall_plugin($name)
    {
 
         // Store the page the user came from.
        $this->session->set_userdata('refered_from', $_SERVER['HTTP_REFERER']);
           
        $options = array(
            'plugin_system_name' => $name,
        );
        $q = $this->db->delete('plugins', $options);
        
        $this->plugins->trigger_uninstall_plugin($name);
        
        $this->session->set_flashdata('message', 'The plugin has being removed');
        redirect($this->session->userdata('refered_from'));            
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
                
                if ( file_exists($this->plugins_dir.$name."/".$name.".php") )
                {
                   $data[]['name'] = $name;
                }
            }
            return $data;
        }
    }
	
}
