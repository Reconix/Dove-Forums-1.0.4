<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmarks_m extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
    
    public function get_bookmarks($userID)
    {
        $data = array();
        $this->db->select('*');
        
        $options = array(
            'bookmark_user_id' => $userID,
            'bookmark_replys' => '1',
        );
        
        $q = $this->db->get_where('bookmarks', $options);
        
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
 }