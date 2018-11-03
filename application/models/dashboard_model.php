<?php



class dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'orders';
    }

   
   
    public function select_records($getfields='', $match_values = '', $condition ='', $compare_type = '', $count = '',$num = '',$offset='',$orderby='',$sort='')
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
       
    }
    
    function dash_data($user_id='')
    {
		
        $query = $this->db->query("SELECT um.first_name,um.last_name,um.status,tps.team_id,tm.team_name,tm.team_logo,pm.pool_color                                    
									FROM user_master um 
                                    LEFT JOIN team_player_trans tps ON tps.player_id = um.id
                                    LEFT JOIN team_master tm ON tm.id = tps.team_id
                                    LEFT JOIN pool_team_trans pt ON pt.team_id = tps.team_id
                                    LEFT JOIN pool_master pm ON pm.id = pt.pool_id
									LEFT JOIN championship_master cm on cm.id = pm.championship_id
                                    WHERE um.id = $user_id");
       // echo $this->db->last_query();exit;
        return $query->result_array();
		
		/*SELECT um.first_name,um.last_name,um.status,tps.team_id,tm.team_name,tm.team_logo,pm.pool_color                                    
									FROM user_master um 
                                    LEFT JOIN team_player_trans tps ON tps.player_id = um.id
                                    LEFT JOIN team_master tm ON tm.id = tps.team_id
                                    LEFT JOIN pool_team_trans pt ON pt.team_id = tps.team_id
                                    LEFT JOIN pool_master pm ON pm.id = pt.pool_id
									LEFT JOIN championship_master cm on cm.id = pm.championship_id
                                    WHERE um.id = $user_id*/
    }
    
    function dash_data1($user_id)
    {
        $query = $this->db->query("SELECT um.first_name,um.last_name,um.status,tps.team_id,tm.team_name,tm.team_logo                                        FROM user_master um 
                                    LEFT JOIN team_player_trans tps ON tps.player_id = um.id
                                    LEFT JOIN team_master tm ON tm.id = tps.team_id
                                    LEFT JOIN pool_team_trans pt ON pt.team_id = tps.team_id
                                    WHERE um.id = $user_id ");
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }   
    
    function get_score($team_id)
    {
        $query = $this->db->query("select * from game_score where team1 = $team_id OR team2 = $team_id group by game_id");
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    function get_winscore($team_id,$user_id)
    {

        //$query = $this->db->query("SELECT * FROM game WHERE (team1 = $team_id OR team2 = $team_id) AND winning_team = $team_id");
		
		$query = $this->db->query("SELECT cm.is_completed,cm.id,ctt.team_id,ctt.player1_id,ctt.player2_id,ctt.total_wins,ctt.total_loses,ctt.total_difference FROM championship_master cm 
JOIN championship_team_trans ctt ON ctt.championship_id = cm.id
WHERE cm.is_completed = '0' AND ctt.team_id = $team_id  AND ctt.player1_id = $user_id OR ctt.player2_id = $user_id");

        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
}   
    
    
   
