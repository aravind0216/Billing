<?php 

class Login_model extends CI_Model{
	
	public function login($user,$pass){
		$this->db->where('user',$user);
		$this->db->where('pass',$pass);
		$query=$this->db->get('register');
		if($query->num_rows()>0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	public function forget_pass($email)
	{
		$this->db->SELECT('pass'); 
		$this->db->where('email',$email);
		$query = $this->db->get('register');

		return $query->result();
	}
}