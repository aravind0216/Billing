<?php

class User_model extends CI_Model

{
	var $table = 'register';
	public function user($data)
	{
		$this->db->insert("register",$data);
	}

	public function get_user(){
		$result = $this->db->get('register');
		return $result->result();
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function user_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function filename_exists($user)
	{
    	$this->db->select('*'); 
     $this->db->from('register');
     $this->db->where('user', $user);
     $query = $this->db->get();
     if ($query->num_rows() == 0) {
         return true;
     } else {
         return false;
     }
	}
	public function get_single_user($username){

		$this->db->from($this->table);
		$this->db->where('user',$username);
		$query = $this->db->get();

		return $query->result();
	}

}