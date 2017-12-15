<?php

class Billing_model extends CI_Model

{
	var $table1='product';
	var $table2='customer';
	var $table='billing';
	var $table3='billing_item';

	public function get_purchase(){
		$this->db->from($this->table);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_billingitem1(){
		$this->db->from($this->table3);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}	public function purchase_payment_get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('b_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function addpay($phis1)
	{
		$this->db->insert("bhis",$phis1);
	}
	public function get_count()
	{
		$result = $this->db->get($this->table);
		return $result->result();
	}

	public function purchase_pay_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
		
    public function autocom($name)
    {
        $this->db->like('p_name' , $name , 'both');
        return $this->db->get('product')->result();
    }
    public function insert_data($data)
    {
	$this->db->insert("billing",$data);
	
	$id = $this->db->insert_id();
		
	// return (isset($id)) ? $id : FALSE;	
    }
    public function insert_purchase_item($data)
    {
	$this->db->insert("billing_item",$data);
    }
    public function fetchProductData($productId)
	{
		$this->db->from($this->table1);
		$this->db->where('id',$productId);
		$query = $this->db->get();

		return $query->row();
	}
	public function fetchSupplierData($SupplierID)
	{
		$this->db->from($this->table2);
		$this->db->where('id',$SupplierID);
		$query = $this->db->get();

		return $query->row();
	}
	public function getpro($ppid)
	{
		$this->db->from($this->table1);
		$this->db->where('id',$ppid);
		$query = $this->db->get();

		return $query->result();
	}

	public function update_product_stock($where, $data)
	{
		$this->db->update($this->table1, $data, $where);
		return $this->db->affected_rows();
	}

	

    public function get_autocomplete_results($search_term) { 
        $this->db->SELECT('id,name'); 
        $this->db->like('name',$search_term); 
        $query = $this->db->get('customer'); 
        return $query->result(); 
    }
    public function get_autocomplete_results1($search_term) { 
        $this->db->SELECT('id,p_name'); 
        $this->db->like('p_name',$search_term); 
        // $this->db->where('stock >',1);
        $query = $this->db->get('product'); 
        return $query->result(); 
        // $this->db->like('p_name',$search_term,'both');
        // $query = $this->db->get('product');
        // return $query->result_array();
    }



    public function get_report($date1 , $date2 ){
		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
    	$this->db->where('status',1);
    	$result = $this->db->get('billing');
    	return $result->result();
	}
	public function get_report1($date1 , $date2 ){
		$this->db->where('date >=', $date1);
		$this->db->where('date <=', $date2);
    	$this->db->where('status',1);
    	$result = $this->db->get('billing_item');
    	return $result->result();
	}






}
