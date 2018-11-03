<?php

class home_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
	
    function insert_record($table_name,$data)
    {
        $result =  $this->db->insert($table_name,$data);	
	  
		$lastId = $this->db->insert_id();
		return $lastId;
    }

   
    public function update_record($table_name,$data)
    {
        $this->db->where('id',$data['id']);
        $query = $this->db->update($table_name,$data); 
    }
   
    public function delete_record($table_name,$id)
    {
        $this->db->where('id',$id);
        $this->db->delete($table_name);
    }
}