<?php

class Customer_model extends CI_Model

{
	var $table = 'customer';
	public function customer($data)
	{
		$this->db->insert("customer",$data);
	}

	public function get_customer(){
		$result = $this->db->get('customer');
		return $result->result();
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function customer_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}