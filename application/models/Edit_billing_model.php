<?php

class Edit_billing_model extends CI_Model

{
	var $table1='billing_item';
	var $table2='bhis';
	var $table3='product';
	var $table='billing';

	
	public function get_billing_lastid(){
		$result = $this->db->get('billing');
		return $result->result();
	}

public function edit_billing($id){
	$this->db->where("b_id",$id);
	$query = $this->db->get("billing");
	return $query->result();
}
public function edit_billing_item($id){
	$this->db->where("b_id",$id);
	$query = $this->db->get("billing_item");
	return $query->result();
}
public function edit_billing_item1($id){
	$this->db->select('product_id');
	$this->db->where("b_id",$id);
	$query = $this->db->get("billing_item");
	return $query->result_array();
}
	public function purchase_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function insert_purchase_item($data)
    {
	$this->db->insert("billing_item",$data);
    }
	public function delete_by_id_purchase_item($id)
	{
		$this->db->where('b_id', $id);
		$this->db->delete($this->table1);
	}
	public function delete_by_id_phis($id)
	{
		$this->db->where('b_id', $id);
		$this->db->delete($this->table2);
	}
	public function addpay($phis1)
	{
		$this->db->insert("bhis",$phis1);
	}
	public function getpurchase_item($ppid1)
	{
		$this->db->from($this->table1);
		$this->db->where('b_id',$ppid1);
		$query = $this->db->get();

		return $query->result();
	}
	public function getpro($ppid)
	{
		$this->db->from($this->table3);
		$this->db->where('id',$ppid);
		$query = $this->db->get();

		return $query->result();
	}
	public function getpro_qty($pr_id)
	{
		$this->db->from($this->table3);
		$this->db->where('id',$pr_id);
		$query = $this->db->get();

		return $query->result();
	}
	public function getpro_qty1($dat11)
	{
		$this->db->from($this->table3);
		$this->db->where('id',$dat11);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function update_product_stock($where, $data)
	{
		$this->db->update($this->table3, $data, $where);
		return $this->db->affected_rows();
	}
	public function update_product_stock1($where, $data)
	{
		$this->db->update($this->table3, $data, $where);
		return $this->db->affected_rows();
	}


	public function bill_cancel($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function bill_item_cancel($where, $data)
	{
		$this->db->update($this->table1, $data, $where);
		return $this->db->affected_rows();
	}
	public function bill_bhis_cancel($where, $data)
	{
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}


	// public function update_temp($where, $data)
	// {
	// 	$this->db->update($this->table1, $data, $where);
	// 	$this->db->affected_rows();
	// }
	// public function update_temp1($where, $data)
	// {
	// 	$this->db->update($this->table1, $data, $where);
	// 	$this->db->affected_rows();
	// }
	

}
