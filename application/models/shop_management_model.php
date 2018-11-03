<?php

	

class shop_management_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'shop';
    }

    
   
    public function select_records($tablename,$getfields='', $match_values = '', $condition ='', $compare_type = '', $count = '',$num = '',$offset='',$orderby='',$sort='')
    {
        $fields =  $getfields ? implode(',', $getfields) : '';
        $sql = 'SELECT ';
        
        $sql .= $fields ? $fields : '*';
        $sql .= ' FROM '.$tablename;
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
		//echo $this->db->last_query();
        return $query->result_array();
    }
	
	
	 public function select_records_dynamic($tablename,$getfields='', $match_values = '', $condition ='', $compare_type = '', $count = '',$num = '',$offset='',$orderby='',$sort='')
    {
        $fields =  $getfields ? implode(',', $getfields) : '';
        $sql = 'SELECT ';
        
        $sql .= $fields ? $fields : '*';
        $sql .= ' FROM '.$tablename;
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
		//echo $this->db->last_query();
        return $query->result_array();
    }
    

    
	
    function insert_record($data)
    {
        $result =  $this->db->insert($this->table_name,$data);	
	  
		$lastId = mysql_insert_id();
		return $lastId;
    }

    
    public function update_record($data)
    {
        $this->db->where('id',$data['id']);
        $query = $this->db->update($this->table_name,$data); 
    }
    
    public function delete_record($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->table_name);
    }
	
	

	public function getuserpagingid($user_id='')
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('id','desc');
		$result = $this->db->get()->result_array();
		$op = 0;
		if(count($result) > 0)
		{
			foreach($result as $key=>$row)
			{
				if($row['id'] == $user_id)
				{
					$op = $key;
					$op1 = strlen($op);
					$op = substr($op,0,$op1-1)*10;
				}
			}
		}
		return $op;
		/*$total_record = count($result);
		if($total_record % 10 == 0)
			echo $total_record - 10;
		else
			echo $op;
	
		exit;*/
	}

}