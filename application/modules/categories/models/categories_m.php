<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
    public function get_categories()
    {
        // [HOOK] Run before categories are fetched
        do_action('pre.get.categories');
        
        $data = array();
        $this->db->select('CategoryID, parentID, type, Name, Description, Active');
        $options = array('type' => 'forums', 'Active' => '1', 'parentID' => '0');
        
        $q = $this->db->get_where('category', $options);
        
        if ($q->num_rows() >0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
        
        $q->free_result();
        
        // [HOOK] Categories array returned from database
        $data = do_action('get.categories', $data);
        
        return $data;
        
        // [HOOK] Run after everything is finished
        do_action('post.get.categories');
    }
	
    function get_sub_categories($categoryID)
    {
        // [HOOK] Run before subcategories are fetched
        do_action('pre.get.subcategories');
        
		$data = array();
    	$this->db->select('CategoryID, parentID, Name, Description, type, Active');
    	$options = array('Active' => '1', 'parentId' => $categoryID);
		
    	$q = $this->db->get_where('category', $options);
		
        if ($q->num_rows() >0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }
		
        $q->free_result();
        
        // [HOOK] Subcategories array returned from database
        $data = do_action('get.subcategories', $data);
		
        return $data; 

        // [HOOK] Run after everything is finished
        do_action('post.get.subcategories');     	
    }
	
	public function count_topics($CategoryID)
    {
    	$options = array('CategoryID'=>$CategoryID, 'Active'=>'1');
    	$query = $this->db->get_where('topics', $options);
    	return $query->num_rows();
    }
    
	public function count_posts($CategoryID)
	{
		$options = array('CategoryID'=>$CategoryID, 'Active'=>'1');
		$query = $this->db->get_where('comments', $options);
		return $query->num_rows();
	}
	
    public function get_current_cat($id='') 
    {
		$data = array();
		$this->db->select('Name');
		$options = array('CategoryID' => $id);
		$q = $this->db->get_where('category', $options, 1);
			   
	   	if($q->num_rows() > 0)
	   	{
			foreach ($q->result_array() as $row) 
			{
				$data[] = $row;
			}

            $name = $row['Name'];
    		
    		if(!$name)
    		{
    			return '0';			
    		}		
    		else		
    		{
    			return $row['Name'];		
    		}
		}
        

		
		$q->free_result();
    }
}