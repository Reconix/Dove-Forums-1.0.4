<?php 

class MY_Input extends CI_Input{
	
    function __construct()
    {
        parent::__construct();
    }

	public function save_query($query_array)
	{
		$this->ci = get_instance();
		$this->ci->db->insert('search', array('query_string' => http_build_query($query_array)));
		
		return $this->ci->db->insert_id();
	}
	
	public function load_query($query_id)
	{
		$this->ci = get_instance();
		$rows = $this->ci->db->get_where('search', array('id' => $query_id))->result();
		if($rows[0])
		{
			parse_str($rows[0]->query_string, $_GET);
		}
	}
}