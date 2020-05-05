<?php 
class User_model extends CI_Model { 
	function __construct() { 
		parent::__construct(); 
	} 
	function get_user($users_id) { 
		return $this->db->query("SELECT users.* FROM users WHERE users.users_id = " . $users_id)->row_array(); 
	}
	function add_user($params) { 
		$this->db->insert('users',$params); return $this->db->insert_id(); 
	} 
	function update_user($users_id,$params) { 
		$this->db->where('users_id',$users_id); 
		return $this->db->update('users',$params); 
	} 
	function delete_user($users_id) { 
		return $this->db->delete('users',array('users_id'=>$users_id)); 
	}
}