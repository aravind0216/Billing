<?php

class Edit_purchase_model extends CI_Model

{
	var $table1='purchase_item';
	var $table2='phis';
	var $table3='product';
	var $table='purchase';

	
	public function get_purchase_lastid(){
		$result = $this->db->get('purchase');
		return $result->result();
	}

public function edit_purchase($id){
	$this->db->where("p_id",$id);
	$query = $this->db->get("purchase");
	return $query->result();
}
public function edit_purchase_item($id){
	$this->db->where("p_id",$id);
	$query = $this->db->get("purchase_item");
	return $query->result();
}
public function purchase_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function insert_purchase_item($data)
    {
	$this->db->insert("purchase_item",$data);
    }
	public function delete_by_id_purchase_item($id)
	{
		$this->db->where('p_id', $id);
		$this->db->delete($this->table1);
	}
	public function delete_by_id_phis($id)
	{
		$this->db->where('p_id', $id);
		$this->db->delete($this->table2);
	}
	public function addpay($phis1)
	{
		$this->db->insert("phis",$phis1);
	}
	public function getpurchase_item($ppid1)
	{
		$this->db->from($this->table1);
		$this->db->where('p_id',$ppid1);
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

	public function purchase_cancel($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function purchase_item_cancel($where, $data)
	{
		$this->db->update($this->table1, $data, $where);
		return $this->db->affected_rows();
	}
	public function purchase_phis_cancel($where, $data)
	{
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}
	

}