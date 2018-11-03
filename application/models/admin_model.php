<?php
	
class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'admin_users';
    }
   
    
    public function check_email($email, $id)
    {
			$param_selfold = array('email'=>$email);
            $this->db->select();
            $this->db->from($this->table_name);
            $this->db->where($param_selfold);
			$this->db->where('id !=',$id);
            $query= $this->db->get();
		    return $query->result_array();
	}
    
   
    public function get_user($getfields='', $match_values = '',$condition ='', $compare_type = '', $count = '',$num = '',$offset='',$orderby='',$sort='')
    {
        $fields =  $getfields ? implode(',', $getfields) : '';
        $sql = 'SELECT ';
        
        $sql .= $fields ? $fields : '*';
        $sql .= ' FROM '.$this->table_name;
        $where='';
        
        if($match_values)
        {
            $keys = array_keys($match_values);
            $compare_type = $compare_type ? $compare_type : 'like';
            if($condition!='')
                $and_or=$condition;
            else 
                $and_or = ($compare_type == 'like') ? ' OR ' : ' AND '; 
          
            $where = 'WHERE ';
            switch ($compare_type)
            {
                case 'like':
                    $where .= $keys[0].' '.$compare_type .'"%'.$match_values[$keys[0]].'%" ';
                    break;

                case '=':
                default:
                    $where .= $keys[0].' '.$compare_type .'"'.$match_values[$keys[0]].'" ';
                    break;
            }
            $match_values = array_slice($match_values, 1);
            
            foreach($match_values as $key=>$value)
            {                
                $where .= $and_or.' '.$key.' ';
                switch ($compare_type)
                {
                    case 'like':
                        $where .= $compare_type .'"%'.$value.'%"';
                        break;
                    
                    case '=':
                    default:
                        $where .= $compare_type .'"'.$value.'"';
                        break;
                }
            }
        }
        $orderby = ($orderby !='')?' order by '.$orderby.' '.$sort.' ':'';
        if($offset=="" && $num=="")
            $sql .= ' '.$where.$orderby;
        elseif($offset=="")
            $sql .= ' '.$where.$orderby.' '.'limit '.$num;
        else
             $sql .= ' '.$where.$orderby.' '.'limit '.$offset .','.$num;
        
        $query = ($count) ? 'SELECT count(*) FROM '.$this->table_name.' '.$where.$orderby : $sql;        
        $query = $this->db->query($query);
        return $query->result_array();
    } 
   
    
    function insert_user($data)
    {
        $this->db->insert($this->table_name,$data);	
	}
   
    public function update_user($data)
    {
        $this->db->where('id',$data['id']);
        $query = $this->db->update($this->table_name,$data); 
    }
    
    public function delete_user($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->table_name);            
    }    
}