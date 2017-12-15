<?php

class Header_model extends CI_Model

{
	var $table = 'register';
	
	public function get_user($username){

		$this->db->from($this->table);
		$this->db->where('user',$username);
		$query = $this->db->get();

		return $query->result();
	}

}