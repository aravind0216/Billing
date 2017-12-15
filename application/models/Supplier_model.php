<?php

class Supplier_model extends CI_Model

{
	var $table = 'supplier';
	public function supplier($data)
	{
		$this->db->insert("supplier",$data);
	}

	public function get_supplier(){
		$result = $this->db->get('supplier');
		return $result->result();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function update($where, $data)
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